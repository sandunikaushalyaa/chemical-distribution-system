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
        <h1>Product List</h1>
        <?php
        // Include the database connection file
        include 'connection.php';

        // SQL query to select all products
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        // Check if there are any results
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Product ID</th><th>Product Name</th><th>Product Code</th><th>Product Price</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["Product_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Product_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Product_code"]) . "</td>";
                echo "<td>Rs: " . number_format($row["Product_price"], 2) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='no-results'>No products found</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>