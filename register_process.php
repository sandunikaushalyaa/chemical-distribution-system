<?php
include 'connection.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the stored procedure
    $stmt = $conn->prepare("CALL insert_user(?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "User registered successfully.";
    } else {
        echo "Error: Could not register user.";
    }

    $stmt->close();
    $conn->close();
}
?>
