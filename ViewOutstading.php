<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Outstanding Balances</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #3498db;
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:hover {
            background-color: #f5f7fa;
        }
        .no-results {
            text-align: center;
            color: #7f8c8d;
            margin-top: 20px;
            font-style: italic;
        }
        @media (max-width: 600px) {
            table, tr, td {
                display: block;
            }
            tr {
                margin-bottom: 15px;
            }
            td {
                border: none;
                position: relative;
                padding-left: 50%;
            }
            td:before {
                content: attr(data-label);
                position: absolute;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                font-weight: bold;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Customer Outstanding Balances</h1>
        <?php
        // Include the database connection file
        include 'connection.php';

        // SQL query to select Customer Name, Shop Name, and Outstanding Balance from the view
        $sql = "SELECT Customer_Name, Shop_Name, Customer_Outstanding FROM customer_outstanding_view";
        $result = $conn->query($sql);

        // Check if there are any results
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<thead><tr><th>Customer Name</th><th>Shop Name</th><th>Outstanding Balance</th></tr></thead>";
            echo "<tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td data-label='Customer Name'>" . htmlspecialchars($row["Customer_Name"]) . "</td>";
                echo "<td data-label='Shop Name'>" . htmlspecialchars($row["Shop_Name"]) . "</td>";
                echo "<td data-label='Outstanding Balance'>Rs: " . number_format($row["Customer_Outstanding"], 2) . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p class='no-results'>No customer records found</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
