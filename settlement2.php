<?php
// Include database connection
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture form inputs
    $customerId = $_POST['customer_id'];
    $paidAmount = $_POST['paid_amount'];
    $paymentType = $_POST['payment_type'];

    // Handle Cash Payment
    if ($paymentType === 'cash') {
        // Update the customer's outstanding balance
        $updateQuery = "UPDATE customer SET Customer_Outstanding = Customer_Outstanding - ? WHERE Customer_id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("di", $paidAmount, $customerId);
        $stmt->execute();
        $stmt->close();

        // Insert payment into settlement table
        $insertQuery = "INSERT INTO settlement (Customer_id, paid_amount, date & time) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("id", $customerId, $paidAmount);
        $stmt->execute();

        // Get the last inserted settlement_id
        $settlementId = $stmt->insert_id;
        $stmt->close();
    }

    // Handle Cheque Payment
    elseif ($paymentType === 'cheque') {
        // Get additional cheque details from the form
        $chequeNumber = $_POST['cheque_number'];
        $bank = $_POST['bank'];
        $branch = $_POST['branch'];
        $chequeDate = $_POST['cheque_date'];

        // Debugging: Check the received values
        error_log("Cheque Payment - Customer ID: $customerId, Cheque Number: $chequeNumber, Amount: $paidAmount, Bank: $bank, Branch: $branch, Cheque Date: $chequeDate");

        // Call the stored procedure to insert cheque details
        $query = "CALL insert_cheque(?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        
        // Bind the parameters for the procedure
        if (!$stmt) {
            error_log("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("ssdsds", $customerId, $chequeNumber, $paidAmount, $bank, $branch, $chequeDate);

        if (!$stmt->execute()) {
            error_log("Error executing stored procedure: " . $stmt->error);
        } else {
            // Debugging: Check if the procedure ran successfully
            error_log("Cheque data inserted successfully.");
        }
        
        $stmt->close();

        // Insert payment into settlement table
        $insertQuery = "INSERT INTO settlement (Customer_id, paid_amount, date & time) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("id", $customerId, $paidAmount);
        $stmt->execute();

        // Get the last inserted settlement_id
        $settlementId = $stmt->insert_id;
        $stmt->close();
    }

    // Redirect to generate PDF with the settlement_id
   // header("Location: generateSettlementPdf.php?settlement_id=$settlementId");
    exit();
}

// Get customer details for dropdown
$query = "SELECT Customer_id, Customer_Name, Shop_Name FROM customer";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settlement</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: 600;
            color: #555;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #007bff;
            outline: none;
        }

        #chequeFields {
            display: none;
        }

        button {
            padding: 15px;
            background-color: #28a745;
            border: none;
            color: #fff;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 20px;
            }

            h2 {
                font-size: 24px;
            }

            .form-group label,
            .form-group input,
            .form-group select {
                font-size: 14px;
            }

            button {
                font-size: 16px;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Record Payment</h2>
        <form action="settlement2.php" method="POST" id="settlementForm">
            <div class="form-group">
                <label for="customer_id">Select Shop Name:</label>
                <select name="customer_id" id="customer_id"  >
                    <option value="">Select Shop</option>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <option value="<?= $row['Customer_id'] ?>">
                            <?= htmlspecialchars($row['Shop_Name']) ?> (<?= htmlspecialchars($row['Customer_Name']) ?>)
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="paid_amount">Amount Paid:</label>
                <input type="number" name="paid_amount" id="paid_amount" step="0.01"  >
            </div>
            <div class="form-group">
                <label for="payment_type">Payment Type:</label>
                <select name="payment_type" id="payment_type"  >
                    <option value="">Select Payment Type</option>
                    <option value="cash">Cash</option>
                    <option value="cheque">Cheque</option>
                </select>
            </div>

            <!-- Cheque Fields (Initially Hidden) -->
            <div id="chequeFields">
                <div class="form-group">
                    <label for="cheque_number">Cheque Number:</label>
                    <input type="text" name="cheque_number" id="cheque_number"  >
                </div>
                <div class="form-group">
                    <label for="bank">Bank Name:</label>
                    <input type="text" name="bank" id="bank" >
                </div>
                <div class="form-group">
                    <label for="branch">Branch Name:</label>
                    <input type="text" name="branch" id="branch"  >
                </div>
                <div class="form-group">
                    <label for="cheque_date">Cheque Date:</label>
                    <input type="date" name="cheque_date" id="cheque_date"  >
                </div>
            </div>

            <button type="submit">Submit Payment</button>
        </form>
    </div>

    <script>
        document.getElementById('payment_type').addEventListener('change', function() {
            const chequeFields = document.getElementById('chequeFields');
            if (this.value === 'cheque') {
                chequeFields.style.display = 'block'; // Show cheque fields
            } else {
                chequeFields.style.display = 'none'; // Hide cheque fields
            }
        });

        document.getElementById('settlementForm').addEventListener('submit', function(e) {
            const customerId = document.getElementById('customer_id').value;
            const paidAmount = document.getElementById('paid_amount').value;
            const paymentType = document.getElementById('payment_type').value;

            if (!customerId || !paidAmount || !paymentType) {
                e.preventDefault();
                alert('Please fill in all fields');
            } else if (parseFloat(paidAmount) <= 0) {
                e.preventDefault();
                alert('Please enter a valid amount');
            }
        });
    </script>
</body>
</html>