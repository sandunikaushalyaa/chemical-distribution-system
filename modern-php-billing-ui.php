<?php
// Include your database connection file
include('connection.php');

// Initialize variables
$latest_bill_no = 1;
$subtotal = 0;
date_default_timezone_set("Asia/Colombo");
$currentDateTime = date('Y-m-d H:i:s');

// Retrieve the latest Bill ID
$latest_bill_query = "SELECT MAX(Bill_No) AS latest_bill_no FROM bill";
$latest_bill_result = $conn->query($latest_bill_query);
if ($latest_bill_result) {
    $latest_bill_row = $latest_bill_result->fetch_assoc();
    $latest_bill_no = $latest_bill_row['latest_bill_no'] + 1;
}

// Query the view to get distinct shop names
$shop_query = "SELECT Shop_Name FROM distinct_shop_names";
$shop_result = $conn->query($shop_query);

// Check if there are any results


// Fetch products from the products table
$product_query = "SELECT Product_id, Product_name, Product_price FROM products";
$product_result = $conn->query($product_query);

// Handle form submission
if (isset($_POST['finish_button'])) {
    $shop_name = $_POST['shop_name'];
    $customer_paid = $_POST['customer_paid'];
    $subtotal = $_POST['subtotal_value']; // Retrieve subtotal value from the form
    $bill_balance = 0;

    // Retrieve Customer ID based on shop name
    $customer_id_query = "SELECT Customer_id FROM customer WHERE Shop_Name = ?";
    $customer_id_stmt = $conn->prepare($customer_id_query);
    $customer_id_stmt->bind_param('s', $shop_name);
    $customer_id_stmt->execute();
    $customer_id_result = $customer_id_stmt->get_result();
    $customer_id_row = $customer_id_result->fetch_assoc();
    $customer_id = $customer_id_row['Customer_id'];

    // Calculate Bill Balance
    $bill_balance = $subtotal - $customer_paid;

// Assuming you have the necessary variables defined above like $latest_bill_no, $customer_id, $subtotal, $customer_paid, $bill_balance, and $currentDateTime

// Prepare the query to call the stored procedure
$insert_bill_query = "CALL InsertBill(?, ?, ?, ?, ?, ?)";
$insert_bill_stmt = $conn->prepare($insert_bill_query);

// Bind the parameters
$insert_bill_stmt->bind_param('iiddds', $latest_bill_no, $customer_id, $subtotal, $customer_paid, $bill_balance, $currentDateTime);

// Execute the statement
$insert_bill_stmt->execute();

// Check if the execution was successful
if ($insert_bill_stmt->affected_rows > 0) {
    echo "Bill inserted successfully!";
} else {
    echo "Failed to insert bill.";
}

// Close the prepared statement
$insert_bill_stmt->close();


    // Insert into bill_details table
    if (isset($_POST['product_name'])) {
        $product_names = $_POST['product_name'];
        $product_prices = $_POST['product_price'];
        $product_qtys = $_POST['product_qty'];
        $total_amounts = $_POST['total_amount'];

        $insert_details_query = "INSERT INTO bill_details (Bill_No, Product_name, Product_price, Quantity, Total_amount) VALUES (?, ?, ?, ?, ?)";
        $insert_details_stmt = $conn->prepare($insert_details_query);

        for ($i = 0; $i < count($product_names); $i++) {
            $product_name = $product_names[$i];
            $product_price = $product_prices[$i];
            $quantity = $product_qtys[$i];
            $total_amount = $total_amounts[$i];

            $insert_details_stmt->bind_param('isdid', $latest_bill_no, $product_name, $product_price, $quantity, $total_amount);
            $insert_details_stmt->execute();
        }
    }

    // Clear the order_details table (if applicable)
    $clear_order_query = "DELETE FROM order_details";
    $conn->query($clear_order_query);

    // Update customer outstanding balance
    if ($bill_balance > 0) {
        $update_outstanding_query = "UPDATE customer SET Customer_Outstanding = COALESCE(Customer_Outstanding, 0) + ? WHERE Customer_id = ?";
        $update_outstanding_stmt = $conn->prepare($update_outstanding_query);
        $update_outstanding_stmt->bind_param('di', $bill_balance, $customer_id);
        $update_outstanding_stmt->execute();
    }

    // Prepare product details to pass to generatePdf.php
    $product_details = [];
    if (isset($_POST['product_name'])) {
        for ($i = 0; $i < count($_POST['product_name']); $i++) {
            $product_details[] = [
                'name' => $_POST['product_name'][$i],
                'price' => $_POST['product_price'][$i],
                'qty' => $_POST['product_qty'][$i],
                'amount' => $_POST['total_amount'][$i]
            ];
        }
    }

    // Serialize the product details for passing to the PDF generator
    $product_details_json = urlencode(json_encode($product_details));

    // Redirect to generatePdf.php with parameters
    $query_string = http_build_query([
        'bill_no' => $latest_bill_no,
        'customer_id' => $customer_id,
        'subtotal' => $subtotal,
        'customer_paid' => $customer_paid,
        'bill_balance' => $bill_balance,
        'date_time' => $currentDateTime,
        'products' => $product_details_json
    ]);

    // Redirect to generatePdf.php
    header("Location: generatePdf.php?$query_string");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Order</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script>
        let subtotal = 0;

        function updateProductDetails() {
            const productSelect = document.getElementById('product');
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const productPrice = parseFloat(selectedOption.getAttribute('data-price'));
            document.getElementById('product_price').value = productPrice.toFixed(2);
        }

        function addProduct() {
            const productSelect = document.getElementById('product');
            const productName = productSelect.options[productSelect.selectedIndex].text;
            const productPrice = parseFloat(productSelect.options[productSelect.selectedIndex].getAttribute('data-price'));
            const productQty = parseInt(document.getElementById('product_qty').value);
            const amount = productPrice * productQty;

            if (productName && !isNaN(productPrice) && !isNaN(productQty)) {
                // Add product to table
                const table = document.getElementById('product_table').getElementsByTagName('tbody')[0];
                const row = table.insertRow();
                row.innerHTML = `
                    <td class="py-2 px-4">${productName}</td>
                    <td class="py-2 px-4 text-right">Rs ${productPrice.toFixed(2)}</td>
                    <td class="py-2 px-4 text-right">${productQty}</td>
                    <td class="py-2 px-4 text-right">Rs ${amount.toFixed(2)}</td>
                    <td class="py-2 px-4 text-right">
                        <button onclick="removeProduct(this)" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                `;

                // Update subtotal
                subtotal += amount;
                document.getElementById('subtotal').textContent = subtotal.toFixed(2);

                // Update hidden subtotal input
                document.getElementById('subtotal_value').value = subtotal.toFixed(2);

                // Append product details to hidden inputs
                appendHiddenInput('product_name[]', productName);
                appendHiddenInput('product_price[]', productPrice.toFixed(2));
                appendHiddenInput('product_qty[]', productQty);
                appendHiddenInput('total_amount[]', amount.toFixed(2));

                // Clear the dropdown and quantity input field
                productSelect.selectedIndex = 0;
                document.getElementById('product_qty').value = '';
            }
        }

        function appendHiddenInput(name, value) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = name;
            input.value = value;
            document.forms[0].appendChild(input);
        }

        function removeProduct(button) {
            const row = button.closest('tr');
            const amount = parseFloat(row.cells[3].textContent.replace('Rs ', ''));
            subtotal -= amount;
            document.getElementById('subtotal').textContent = subtotal.toFixed(2);
            document.getElementById('subtotal_value').value = subtotal.toFixed(2);
            row.remove();
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Product Order</h1>
        
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <!-- Bill ID Display -->
            <p class="text-lg font-semibold mb-4">Bill No: <?php echo $latest_bill_no; ?></p>

            <form method="POST" action="">
                <!-- Lorry Selection Dropdown -->
<div class="mb-4">
    <label for="lorry_name" class="block text-sm font-medium text-gray-700">Select Lorry:</label>
    <select id="lorry_name" name="lorry_name" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="">Select a lorry</option>
        <?php
        // Fetch lorries from the database
        $lorry_query = "SELECT lorry_id, registration_number FROM lorries";
        $lorry_result = $conn->query($lorry_query);
        while ($lorry_row = $lorry_result->fetch_assoc()) {
            echo "<option value='" . $lorry_row['lorry_id'] . "'>" . $lorry_row['registration_number'] . "</option>";
        }
        ?>
    </select>
</div>
                <!-- Shop Name Dropdown -->
                <div class="mb-4">
                    <label for="shop_name" class="block text-sm font-medium text-gray-700">Select Shop:</label>
                    <select id="shop_name" name="shop_name" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <?php while ($shop_row = $shop_result->fetch_assoc()) { ?>
                            <option value="<?php echo $shop_row['Shop_Name']; ?>"><?php echo $shop_row['Shop_Name']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Product Dropdown -->
                <h2 class="text-xl font-semibold mb-4">Add Products</h2>
                <div class="flex space-x-2 mb-4">
                    <select id="product" name="product" onchange="updateProductDetails()" class="flex-grow py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select a product</option>
                        <?php while ($product_row = $product_result->fetch_assoc()) { ?>
                            <option value="<?php echo $product_row['Product_id']; ?>" data-price="<?php echo $product_row['Product_price']; ?>">
                                <?php echo $product_row['Product_name']; ?> - Rs <?php echo $product_row['Product_price']; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <input type="number" id="product_qty" name="product_qty" placeholder="Qty" step="1" min="1" class="w-20 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <button type="button" onclick="addProduct()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-plus"></i> Add
                    </button>
                </div>

                <table id="product_table" class="min-w-full divide-y divide-gray-200 mb-4">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Products will be added here -->
                    </tbody>
                </table>

                <!-- Subtotal -->
                <div class="flex justify-between items-center mb-4">
                    <p class="text-lg font-semibold">Subtotal: Rs <span id="subtotal">0.00</span></p>
                    <input type="hidden" id="subtotal_value" name="subtotal_value" value="0">
                    
                    <!-- Customer Paid Input -->
                    <div class="flex items-center space-x-2">
                        <label for="customer_paid" class="text-sm font-medium text-gray-700">Customer Paid:</label>
                        <input type="number" id="customer_paid" name="customer_paid" step="0.01" min="0" required class="py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>

                <!-- Finish Button -->
                <button type="submit" name="finish_button" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-check"></i> Finish Order
                </button>
            </form>
        </div>
    </div>
</body>
</html>
