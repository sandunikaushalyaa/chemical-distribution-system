<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Backup</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container text-center mt-5">
        <h1>Backup Database</h1>
        <form method="post">
            <button type="submit" name="backup" class="btn btn-primary">Backup Now</button>
        </form>
        <?php
        // Include the database connection file
        include('connection.php');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_POST['backup'])) {
            backupDatabase($servername, $username, $password, $dbname);
        }

        function backupDatabase($servername, $username, $password, $dbname) {
            // Temporary file path for the backup
            $backupFile = 'backup_' . $dbname . '_' . date('Y-m-d_H-i-s') . '.sql';
            $errorFile = 'error.log'; // File to capture errors

            // Replace with the actual path to mysqldump
            $mysqldumpPath = '"C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin\\mysqldump.exe"'; // Note the quotes around the path
            $command = "$mysqldumpPath --host=$servername --user=$username --password=$password $dbname > $backupFile 2> $errorFile";

            // Execute the command and capture the output and return value
            exec($command, $output, $returnVar);

            // Check if the backup was successful
            if ($returnVar === 0) {
                // Force download the file
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($backupFile) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($backupFile));
                flush(); // Flush system output buffer
                readfile($backupFile);
                unlink($backupFile); // Delete the temporary file after download
                exit;
            } else {
                // Show detailed error information
                $errorOutput = file_get_contents($errorFile);
                echo '<div class="alert alert-danger mt-3">Error occurred during backup!</div>';
                echo '<div class="alert alert-danger mt-3">Return Code: ' . $returnVar . '</div>';
                echo '<div class="alert alert-danger mt-3">Error Output: <pre>' . htmlspecialchars($errorOutput) . '</pre></div>';
            }
        }
        ?>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
