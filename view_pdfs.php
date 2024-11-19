<?php
session_start();
/*if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to login page if not logged in
    header("Location: index.php");
    exit;
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .folder {
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .folder-name {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 18px;
            color: #4CAF50;
        }
        .pdf-list {
            list-style-type: none;
            padding: 0;
        }
        .pdf-list li {
            margin-bottom: 5px;
            padding: 8px;
            background-color: #e7e7e7;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .pdf-list li:hover {
            background-color: #ccc;
        }
        .pdf-link {
            text-decoration: none;
            color: #333;
            font-size: 16px;
        }
        .pdf-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>PDF Files Viewer</h1>
        <?php
        function listPdfFiles($dir) {
            $files = [];
            if ($handle = opendir($dir)) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        $fullPath = $dir . '/' . $entry;
                        if (is_dir($fullPath)) {
                            $files[] = ['type' => 'dir', 'path' => $fullPath, 'name' => $entry];
                        } elseif (pathinfo($entry, PATHINFO_EXTENSION) == 'pdf') {
                            $files[] = ['type' => 'file', 'path' => $fullPath, 'name' => $entry];
                        }
                    }
                }
                closedir($handle);

                // Sort files by modification time (newest first)
                usort($files, function($a, $b) {
                    return filemtime($b['path']) - filemtime($a['path']);
                });

                // Display files
                foreach ($files as $file) {
                    if ($file['type'] == 'dir') {
                        echo "<div class='folder-name'>{$file['name']}</div>";
                        listPdfFiles($file['path']);
                    } elseif ($file['type'] == 'file') {
                        echo "<ul class='pdf-list'><li><a class='pdf-link' href='{$file['path']}' target='_blank'>{$file['name']}</a></li></ul>";
                    }
                }
            }
        }

        $reportDir = 'report';
        listPdfFiles($reportDir);
        ?>
    </div>
</body>
</html>
