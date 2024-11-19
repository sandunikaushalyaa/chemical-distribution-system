<!--

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product</title>
</head>
<body>
    <h1>Insert Product</h1>
    <form action="insert_product.php" method="post">
        <label for="Product_name">Product Name:</label>
        <input type="text" id="Product_name" name="Product_name" required><br><br>

        <label for="Product_code">Product Code:</label>
        <input type="text" id="Product_code" name="Product_code" required><br><br>

        <label for="Product_price">Product Price:</label>
        <input type="number" id="Product_price" name="Product_price" step="0.01" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>

-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            color: #333;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 0.5rem;
            color: #555;
        }
        input[type="text"],
        input[type="number"] {
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        
    </style>
</head>
<body>

    <div class="container">
        <h1>Insert Product</h1>
        <form action="insert_product.php" method="post">
            <label for="Product_name">Product Name</label>
            <input type="text" id="Product_name" name="Product_name" required>
            
            <label for="Product_code">Product Code</label>
            <input type="text" id="Product_code" name="Product_code" required>
            
            <label for="Product_price">Product Price</label>
            <input type="number" id="Product_price" name="Product_price" step="0.01" required>
            
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
