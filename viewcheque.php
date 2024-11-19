<?php
// Include database connection
require_once 'connection.php';

// Fetch cheque details from the view
$query = "SELECT * FROM view_cheque";
$result = $conn->query($query);

if (!$result) {
    die("Error fetching data: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cheque Payments</title>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --background-color: #f4f4f4;
            --text-color: #333;
            --border-color: #ddd;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid var(--border-color);
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: var(--primary-color);
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Cheque Payment Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Cheque ID</th>
                    <th>Shop Name</th>
                    <th>Customer Name</th>
                    <th>Cheque Number</th>
                    <th>Cheque Amount</th>
                    <th>Bank</th>
                    <th>Branch</th>
                    <th>Cheque Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['cheque_id']) ?></td>
                        <td><?= htmlspecialchars($row['Shop_Name']) ?></td>
                        <td><?= htmlspecialchars($row['Customer_Name']) ?></td>
                        <td><?= htmlspecialchars($row['cheque_number']) ?></td>
                        <td><?= number_format($row['cheque_amount'], 2) ?></td>
                        <td><?= htmlspecialchars($row['bank']) ?></td>
                        <td><?= htmlspecialchars($row['branch']) ?></td>
                        <td><?= htmlspecialchars($row['cheque_date']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
