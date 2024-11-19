<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .no-results {
            text-align: center;
            color: #666;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Customer List</h1>
        <?php
        // Include the database connection file
        include 'connection.php';

        // SQL query to select all data from the view
        $sql = "SELECT * FROM customer_view";
        $result = $conn->query($sql);

        // Check if there are any results
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Customer ID</th><th>Customer Name</th><th>Shop Name</th><th>Customer Address</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["Customer_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Customer_Name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Shop_Name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Address"]) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='no-results'>No customers found</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
