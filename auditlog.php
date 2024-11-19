<?php
// Include the database connection file
include 'connection.php';  // Assuming this file contains the correct DB connection code

// Fetch product log data from the database
$product_sql = "SELECT * FROM product_log ORDER BY created_at DESC";
$product_result = $conn->query($product_sql);

// Fetch customer log data from the database
$customer_sql = "SELECT * FROM customer_log ORDER BY created_at DESC";
$customer_result = $conn->query($customer_sql);

// Fetch lorry log data from the database
$lorry_sql = "SELECT * FROM lorry_log ORDER BY created_at DESC";
$lorry_result = $conn->query($lorry_sql);

// Fetch bill log data from the database
$bill_log_sql = "SELECT * FROM bill_log ORDER BY created_at DESC";
$bill_log_result = $conn->query($bill_log_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Log Viewer</title>
    <style>
        /* General Body Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container for the Log Table */
        .container {
            width: 100%;
            height: 100%;
            max-width: 1200px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
             /* Allow horizontal scrolling on small screens */
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Make Table Responsive */
        @media (max-width: 768px) {
            th, td {
                padding: 8px;
                font-size: 14px;
            }

            /* Horizontal Scrolling on Small Screens */
            .container {
                padding: 10px;
            }
        }

        /* Header Styling */
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Section Styling */
        section {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Product Log Section -->
        <section>
            <h1>Product Audit Log</h1>
            <table>
                <thead>
                    <tr>
                        <th>Log ID</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Product Price</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are results for product log
                    if ($product_result->num_rows > 0) {
                        // Loop through each row of the result for product log
                        while($log = $product_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($log['log_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['Product_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['Product_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['Product_code']) . "</td>";
                            echo "<td>" . "Rs:-" . number_format($log['Product_price'], 2) . "</td>";
                            echo "<td>" . htmlspecialchars($log['created_at']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // No product logs found
                        echo "<tr><td colspan='6'>No product audit logs found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <!-- Customer Log Section -->
        <section>
            <h1>Customer Audit Log</h1>
            <table>
                <thead>
                    <tr>
                        <th>Log ID</th>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Shop Name</th>
                        <th>Customer Outstanding</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are results for customer log
                    if ($customer_result->num_rows > 0) {
                        // Loop through each row of the result for customer log
                        while($log = $customer_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($log['log_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['Customer_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['Customer_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['Shop_name']) . "</td>";
                            echo "<td>" . "Rs:-" . number_format($log['Customer_outstanding'], 2) . "</td>";
                            echo "<td>" . htmlspecialchars($log['created_at']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // No customer logs found
                        echo "<tr><td colspan='6'>No customer audit logs found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <!-- Lorry Log Section -->
        <section>
            <h1>Lorry Audit Log</h1>
            <table>
                <thead>
                    <tr>
                        <th>Log ID</th>
                        <th>Lorry ID</th>
                        <th>Registration Number</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Load Capacity</th>
                        <th>Action</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are results for lorry log
                    if ($lorry_result->num_rows > 0) {
                        // Loop through each row of the result for lorry log
                        while($log = $lorry_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($log['log_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['lorry_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['registration_number']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['make']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['model']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['load_capacity']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['action_type']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['created_at']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // No lorry logs found
                        echo "<tr><td colspan='8'>No lorry audit logs found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <!-- Bill Log Section (Audit Log) -->
        <section>
            <h1>Bill Audit Log</h1>
            <table>
                <thead>
                    <tr>
                        <th>Log ID</th>
                        <th>Action</th>
                        <th>Bill No</th>
                        <th>Customer ID</th>
                        <th>Bill Amount</th>
                        <th>Customer Paid</th>
                        <th>Bill Balance</th>
                        <th>Created At</th>
                        <th>Changed By</th>
                        <th>Old Values</th>
                        <th>New Values</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are results for bill log
                    if ($bill_log_result->num_rows > 0) {
                        // Loop through each row of the result for bill log
                        while($log = $bill_log_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($log['log_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['action_type']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['bill_no']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['customer_id']) . "</td>";
                            echo "<td>" . "Rs:-" . number_format($log['bill_amount'], 2) . "</td>";
                            echo "<td>" . "Rs:-" . number_format($log['customer_paid'], 2) . "</td>";
                            echo "<td>" . "Rs:-" . number_format($log['bill_balance'], 2) . "</td>";
                            echo "<td>" . htmlspecialchars($log['created_at']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['changed_by']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['old_values']) . "</td>";
                            echo "<td>" . htmlspecialchars($log['new_values']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // No bill logs found
                        echo "<tr><td colspan='11'>No bill audit logs found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

    </div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
