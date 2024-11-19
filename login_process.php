<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
// Retrieve the username from user input (this would be set earlier in the code)
$username = $_POST['username']; // or use other methods to get the username

// Prepare the call to the stored procedure
$stmt = $conn->prepare("CALL GetUserCredentials(?)");

// Bind the input parameter (the username) to the procedure
$stmt->bind_param("s", $username);

// Execute the statement
$stmt->execute();

// Bind the result to variables
$stmt->bind_result($user_id, $password_hash);

// Fetch the result
$stmt->fetch();

// Close the statement
$stmt->close();

    if ($user_id && password_verify($password, $password_hash)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>
