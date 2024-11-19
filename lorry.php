<?php
// Include the database connection file
include 'connection.php';

// Initialize success/error message
$message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize the form data
    $registration_number = trim($_POST['registration_number']);
    $make = trim($_POST['make']);
    $model = trim($_POST['model']);
    $load_capacity = $_POST['load_capacity'];

    // Basic validation
    if (empty($registration_number) || empty($make) || empty($model) || empty($load_capacity) || !is_numeric($load_capacity) || $load_capacity <= 0) {
        $message = "<p class='error'>Error: All fields must be filled and load capacity must be a positive number.</p>";
    } else {
        // Prepare the SQL statement to call the stored procedure
        $sql = "CALL InsertLorry(?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $registration_number, $make, $model, $load_capacity); // 's' for strings, 'i' for integer

        // Execute the query and check if it's successful
        if ($stmt->execute()) {
            $message = "<p class='success'>Lorry registered successfully!</p>";
            header("location:dashboard.php");
        } else {
            $message = "<p class='error'>Error: " . $stmt->error . "</p>";
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the connection after the operation
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lorry Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .success {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lorry Registration Form</h2>
        <!-- Display success or error message -->
        <?php if ($message) { echo $message; } ?>

        <!-- Registration form -->
        <form action="lorry.php" method="POST">
            <label for="registration_number">Registration Number:</label>
            <input type="text" id="registration_number" name="registration_number" required>

            <label for="make">Make:</label>
            <input type="text" id="make" name="make" required>

            <label for="model">Model:</label>
            <input type="text" id="model" name="model" required>

            <label for="load_capacity">Load Capacity (kg):</label>
            <input type="number" id="load_capacity" name="load_capacity" required>

            <input type="submit" value="Register Lorry">
        </form>
    </div>
</body>
</html>
