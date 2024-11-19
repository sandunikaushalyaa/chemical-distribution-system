<?php
include 'connection.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lorry_id = $_POST['lorry_id'];
    $products_json = $_POST['products'];
    $products = json_decode($products_json, true); // Decode JSON string to array

    if (!$lorry_id || empty($products)) {
        die("Lorry ID and products are required.");
    }

    // Insert into GRN table
    $stmt = $conn->prepare("CALL InsertIntoGrn(?, @grn_id)");

    $stmt->bind_param("i", $lorry_id);
    
    // Execute the statement
    $stmt->execute();
    
    // Retrieve the value of grn_id from the session variable
    $result = $conn->query("SELECT @grn_id AS grn_id");
    $row = $result->fetch_assoc();
    $grn_id = $row['grn_id'];
    
    // Close the statement
    $stmt->close();
    
 

    foreach ($products as $product) {
        $product_id = $product['productId'];
        $quantity = $product['quantity'];

        // Insert into GRN details
        $stmt = $conn->prepare("INSERT INTO grn_details (grn_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $grn_id, $product_id, $quantity);
        $stmt->execute();
        $stmt->close();

        // Update stock table
        $stmt = $conn->prepare("
            INSERT INTO stock (product_id, lorry_id, quantity) 
            VALUES (?, ?, ?) 
            ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)
        ");
        $stmt->bind_param("iii", $product_id, $lorry_id, $quantity);
        $stmt->execute();
        $stmt->close();
    }

    echo "GRN created successfully.";
    header('Location: dashboard.php'); 
} else {
    echo ".";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Lorry GRN</title>
    <style>
        /* Root Colors */
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --background-color: #f4f4f4;
            --card-background: #ffffff;
            --text-color: #333;
            --border-radius: 8px;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: var(--card-background);
            padding: 20px;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 8px var(--shadow-color);
        }

        h2 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        select, input[type="number"], input[type="submit"], button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 16px;
        }

        input[type="submit"], button {
            background-color: var(--primary-color);
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            border: none;
        }

        input[type="submit"]:hover, button:hover {
            background-color: var(--secondary-color);
        }

        .product-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            box-shadow: 0 4px 6px var(--shadow-color);
        }

        .product-table th, .product-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .product-table th {
            background-color: var(--primary-color);
            color: white;
        }

        .remove-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: var(--border-radius);
            padding: 5px 10px;
            cursor: pointer;
        }

        .remove-btn:hover {
            background-color: #c0392b;
        }

        @media (max-width: 600px) {
            h2 {
                font-size: 1.5em;
            }

            .container {
                padding: 15px;
            }

            .product-table th, .product-table td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create Goods Receipt Note (GRN)</h2>
        <form action="grn.php" method="POST" onsubmit="prepareProducts()">
            <label for="lorry_id">Select Lorry:</label>
            <select id="lorry_id" name="lorry_id" required>
                <!-- PHP code to populate options -->
                <?php
                    include 'connection.php';
                    $result = $conn->query("SELECT lorry_id, registration_number FROM lorries");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['lorry_id']}'>{$row['registration_number']}</option>";
                    }
                    $conn->close();
                ?>
            </select>

            <label for="product_id">Select Product:</label>
            <select id="product_id" required>
                <!-- PHP code to populate options -->
                <?php
                    include 'connection.php';
                    $result = $conn->query("SELECT Product_id, Product_name FROM products");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['Product_id']}'>{$row['Product_name']}</option>";
                    }
                    $conn->close();
                ?>
            </select>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" required min="1">

            <button type="button" onclick="addProduct()">Add Product</button>

            <h3>Selected Products</h3>
            <table class="product-table" id="productTable">
                <tr>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Remove</th>
                </tr>
            </table>

            <!-- Hidden input to store products JSON -->
            <input type="hidden" name="products" id="products">
            <br>
            <br>
            <input type="submit" value="Create GRN">
        </form>
    </div>

    <script>
        let selectedProducts = [];

        function addProduct() {
            const productId = document.getElementById("product_id").value;
            const quantity = document.getElementById("quantity").value;
            
            if (!selectedProducts.find(item => item.productId === productId)) {
                selectedProducts.push({ productId, quantity });
                updateProductTable();
            } else {
                alert("Product already added. Adjust quantity if needed.");
            }
        }

        function updateProductTable() {
            const table = document.getElementById("productTable");
            table.innerHTML = `
                <tr>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Remove</th>
                </tr>`;
            
            selectedProducts.forEach((product, index) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${product.productId}</td>
                    <td>${product.quantity}</td>
                    <td><button type="button" class="remove-btn" onclick="removeProduct(${index})">Remove</button></td>`;
                table.appendChild(row);
            });
        }

        function removeProduct(index) {
            selectedProducts.splice(index, 1);
            updateProductTable();
        }

        function prepareProducts() {
            document.getElementById("products").value = JSON.stringify(selectedProducts);
        }
    </script>
</body>
</html>
