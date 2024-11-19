<?php
require_once 'connection.php';

// Fetch rejected cheques
$query = "SELECT * FROM rejected_cheque";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejected Cheques</title>
</head>
<body>
    <h2>Rejected Cheques</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Cheque ID</th>
                <th>Customer Name</th>
                <th>Shop Name</th>
                <th>Cheque Amount</th>
                <th>Rejection Reason</th>
                <th>Rejection Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['rejected_cheque_id']) ?></td>
                    <td><?= htmlspecialchars($row['customer_name']) ?></td>
                    <td><?= htmlspecialchars($row['shop_name']) ?></td>
                    <td><?= htmlspecialchars($row['cheque_amount']) ?></td>
                    <td><?= htmlspecialchars($row['rejection_reason']) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
