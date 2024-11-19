<?php
// Include the database connection file
include 'connection.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input values
    $supplierName = $_POST['supplierName'];
    $contactNumber = $_POST['contactNumber'];
    $address = $_POST['address'];
    $city = !empty($_POST['city']) ? $_POST['city'] : 'Unknown'; // Default to 'Unknown' if empty

    // Prepare SQL to call the stored procedure
    $stmt = $conn->prepare("CALL InsertSupplier(?, ?, ?, ?)");
    $stmt->bind_param("siss", $supplierName, $contactNumber, $address, $city);

    // Execute the query and check if successful
    if ($stmt->execute()) {
        echo "Supplier inserted successfully!";
    } else {
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
    <title>Insert Supplier</title>
</head>
<body>
    <h2>Insert Supplier</h2>
    <form action="insert_supplier.php" method="POST">
        <label for="supplierName">Supplier Name:</label>
        <input type="text" id="supplierName" name="supplierName" required><br><br>

        <label for="contactNumber">Contact Number:</label>
        <input type="number" id="contactNumber" name="contactNumber" required><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city"><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
