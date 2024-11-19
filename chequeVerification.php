<?php
require_once 'connection.php';

// Get customer details and cheque info
if (isset($_GET['customer_id'])) {
    $customerId = $_GET['customer_id'];
    
    // Fetch the cheque details
    $query = "SELECT * FROM cheque WHERE shop_id = ? ORDER BY cheque_id DESC LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $customerId);
    $stmt->execute();
    $result = $stmt->get_result();
    $cheque = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];
    $chequeId = $_POST['cheque_id'];
    
    if ($status === 'pass') {
        // Update the outstanding balance if cheque is passed
        $updateQuery = "UPDATE customer SET Customer_Outstanding = Customer_Outstanding - ? WHERE Customer_id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("di", $cheque['cheque_amount'], $customerId);
        $stmt->execute();
        $stmt->close();
    } elseif ($status === 'reject') {
        // Insert into rejected_cheque table
        $rejectionReason = $_POST['rejection_reason'];
        $insertRejectQuery = "INSERT INTO rejected_cheque (customer_name, shop_id, cheque_amount, bank, branch, cheque_date, rejection_reason) 
                              SELECT Customer_Name, Customer_id, cheque_amount, bank, branch, cheque_date, ? 
                              FROM cheque WHERE cheque_id = ?";
        $stmt = $conn->prepare($insertRejectQuery);
        $stmt->bind_param("si", $rejectionReason, $chequeId);
        $stmt->execute();
        $stmt->close();
    }

    // Redirect to a confirmation page or back to the list of cheques
    header("Location: chequeVerification.php?customer_id=$customerId");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cheque Verification</title>
    <style>
        /* Add styling for this page */
    </style>
</head>
<body>
    <div class="container">
        <h2>Cheque Verification</h2>
        <p>Customer: <?= htmlspecialchars($cheque['customer_name']) ?></p>
        <p>Amount: <?= htmlspecialchars($cheque['cheque_amount']) ?></p>
        <p>Bank: <?= htmlspecialchars($cheque['bank']) ?></p>
        <p>Branch: <?= htmlspecialchars($cheque['branch']) ?></p>
        <p>Cheque Date: <?= htmlspecialchars($cheque['cheque_date']) ?></p>

        <form action="chequeVerification.php" method="POST">
            <input type="hidden" name="cheque_id" value="<?= $cheque['cheque_id'] ?>">
            <label for="status">Cheque Status:</label>
            <select name="status" id="status" required>
                <option value="">Select Status</option>
                <option value="pass">Pass</option>
                <option value="reject">Reject</option>
            </select>
            <div id="rejectionReason" style="display: none;">
                <label for="rejection_reason">Reason for Rejection:</label>
                <textarea name="rejection_reason" id="rejection_reason"></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById('status').addEventListener('change', function() {
            if (this.value === 'reject') {
                document.getElementById('rejectionReason').style.display = 'block';
            } else {
                document.getElementById('rejectionReason').style.display = 'none';
            }
        });
    </script>
</body>
</html>
