<?php
// Include the database connection file
include 'connection.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and escape special characters to prevent SQL injection
    $product_name = $conn->real_escape_string(trim($_POST['Product_name']));
    $product_code = $conn->real_escape_string(trim($_POST['Product_code']));
    $product_price = (float)$_POST['Product_price']; // Cast to float for safety

    // Input validation
    if (empty($product_name) || empty($product_code) || $product_price <= 0) {
        echo "Error: All fields must be filled and product price must be greater than zero.";
        exit();
    }

    // Prepare the SQL statement to call the stored procedure
    $sql = "CALL InsertProduct(?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $product_name, $product_code, $product_price);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New product added successfully.";
        header('Location: dashboard.php'); // Redirect to dashboard on success
        exit();  // Make sure no further code is executed after redirection
    } else {
        // Handle errors (like a duplicate entry, which will raise an exception from the stored procedure)
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
