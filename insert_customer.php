<?php
include ('connection.php');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$customer_name = $shop_name = $address = $phone_number = $customer_outstanding = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $customer_name = $conn->real_escape_string(trim($_POST["customer_name"]));
    $shop_name = $conn->real_escape_string(trim($_POST["shop_name"]));
    $address = $conn->real_escape_string(trim($_POST["address"]));
    $phone_number = $conn->real_escape_string(trim($_POST["phone_number"]));
    $customer_outstanding = isset($_POST["customer_outstanding"]) ? (float)$_POST["customer_outstanding"] : NULL;

    // Prepare the SQL statement to call the stored procedure
    $sql = "CALL InsertCustomer(?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $customer_name, $shop_name, $address, $phone_number, $customer_outstanding);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New customer record created successfully.";
        header('Location: dashboard.php');  // Redirect to dashboard on success
        exit();  // Make sure no further code is executed after redirection
    } else {
        // Handle errors (like duplicate entry, which will raise an exception from the stored procedure)
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Customer</title>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --background-color: #f4f4f4;
            --text-color: #333;
            --error-color: #e74c3c;
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
            max-width: 600px;
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

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #27ae60;
        }

        .error {
            color: var(--error-color);
            font-size: 14px;
            margin-top: 5px;
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
        <h2>Insert Customer Information</h2>
        <form action="insert_customer.php" method="post" id="customerForm">
            <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" id="customer_name" name="customer_name" required>
                <span class="error" id="customer_name_error"></span>
            </div>
            <div class="form-group">
                <label for="shop_name">Shop Name</label>
                <input type="text" id="shop_name" name="shop_name" required>
                <span class="error" id="shop_name_error"></span>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
                <span class="error" id="address_error"></span>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" required>
                <span class="error" id="phone_number_error"></span>
            </div>
            <input type="submit" value="Submit">
        </form>
    </div>

    <script>
        document.getElementById('customerForm').addEventListener('submit', function(e) {
            let isValid = true;
            const fields = ['customer_name', 'shop_name', 'address', 'phone_number'];
            
            fields.forEach(field => {
                const input = document.getElementById(field);
                const error = document.getElementById(`${field}_error`);
                if (input.value.trim() === '') {
                    isValid = false;
                    error.textContent = 'This field is required';
                } else {
                    error.textContent = '';
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
