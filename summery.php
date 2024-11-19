<?php
session_start();
/*if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to login page if not logged in
    header("Location: index.php");
    exit;
}
*/
// Include the database connection file
include 'connection.php';

// Get today's date
date_default_timezone_set("Asia/Colombo");
$today = date('Y-m-d');

// Initialize variables for date range
$from_date = $to_date = '';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
}

// If no date range is provided, default to today's date
if (empty($from_date)) {
    $from_date = $today;
}
if (empty($to_date)) {
    $to_date = $today;
}

// Query to get sales data using the SQL function
$sql = "SELECT get_sales_data('$from_date', '$to_date') AS sales_data";
$result = $conn->query($sql);

// Check if the query was successful and fetch the result
if ($result) {
    $row = $result->fetch_assoc();
    $sales_data = json_decode($row['sales_data']);
    
    // Extract the values from the JSON object
    $total_sales_range = number_format($sales_data->total_sales, 2);
    $outstanding_balance_range = number_format($sales_data->outstanding_balance, 2);
    $cash_sales_range = number_format($sales_data->cash_sales, 2);
} else {
    // Handle errors
    echo "Error retrieving sales data: " . $conn->error;
    exit;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Dashboard</title>
    <style>
        /* Basic CSS styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1, h3 {
            color: #2c3e50;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card h3 {
            margin-top: 0;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .stat {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .stat-label {
            font-weight: bold;
        }
        .date-range-form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }
        .date-range-form h3 {
            margin-top: 0;
        }
        .form-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }
        input[type="date"], input[type="submit"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #2980b9;
        }
        @media (max-width: 600px) {
            .dashboard {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <h2>Sales Dashboard</h2>
    <h4>From: <?php echo $from_date; ?> To: <?php echo $to_date; ?></h4>

    <div class="dashboard">
        <!-- Today's Summary -->
        <div class="card">
            <h3>Custom Date Range Summary</h3>
            <div class="stat">
                <span class="stat-label">Total Sale:</span>
                <span><?php echo $total_sales_range; ?></span>
            </div>
            <div class="stat">
                <span class="stat-label">Cash Sale:</span>
                <span><?php echo $cash_sales_range; ?></span>
            </div>
            <div class="stat">
                <span class="stat-label">Outstanding Balance:</span>
                <span><?php echo $outstanding_balance_range; ?></span>
            </div>
        </div>
    </div>

    <!-- Filter by Date Range Form -->
    <div class="date-range-form">
        <h3>Filter by Date Range:</h3>
        <form method="post" action="">
            <div class="form-group">
                <label for="from_date">From Date:</label>
                <input type="date" id="from_date" name="from_date" value="<?php echo $from_date; ?>">
                <label for="to_date">To Date:</label>
                <input type="date" id="to_date" name="to_date" value="<?php echo $to_date; ?>">
                <input type="submit" value="Filter">
            </div>
        </form>
    </div>
</body>
</html>
