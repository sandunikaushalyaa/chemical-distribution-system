<?php
// Include database connection
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerId = $_POST['customer_id'];
    $paidAmount = $_POST['paid_amount'];

    // Update the customer's outstanding balance
    $stmt = $conn->prepare("CALL update_customer_outstanding(?, ?)");

    // Bind the parameters to the statement
    $stmt->bind_param("di", $paidAmount, $customerId);
    
    // Execute the stored procedure
    $stmt->execute();
    
    // Check if the execution was successfu
    
    // Close the prepared statement
    $stmt->close();

    // Insert payment into settlement table
    $stmt = $conn->prepare("CALL insert_settlement(?, ?)");

    // Bind the parameters to the statement
    $stmt->bind_param("id", $customerId, $paidAmount);
    
    // Execute the stored procedure
    $stmt->execute();

    // Close the prepared statement
    $stmt->close();
    // Get the last inserted settlement_id
    $settlementId = $stmt->insert_id;
    $stmt->close();

    // Redirect to generate PDF with settlement_id
    header("Location: generateSettlementPdf.php?settlement_id=$settlementId");
    exit();
}

// Get customer details for dropdown
$query = "SELECT Customer_id, Customer_Name, Shop_Name FROM customer_views";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settlement</title>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --background-color: #f4f4f4;
            --text-color: #333;
            --border-color: #ddd;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: var(--primary-color);
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            display: grid;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        select, input[type="number"] {
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 16px;
        }

        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
        }

        button {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #27ae60;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Record Payment</h2>
        <form action="settlement.php" method="POST" id="settlementForm">
            <div class="form-group">
                <label for="customer_id">Select Shop Name:</label>
                <select name="customer_id" id="customer_id" required>
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
                <input type="number" name="paid_amount" id="paid_amount" step="0.01" required>
            </div>
            <button type="submit">Submit Payment</button>
        </form>
    </div>

    <script>
        document.getElementById('settlementForm').addEventListener('submit', function(e) {
            const customerId = document.getElementById('customer_id').value;
            const paidAmount = document.getElementById('paid_amount').value;

            if (!customerId || !paidAmount) {
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
