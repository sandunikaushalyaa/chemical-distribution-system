<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D&S Marketing Dashboard</title>
    <style>
        :root {
            --primary-color: #3498db;
            --hover-color: #2980b9;
            --background-color: #f4f4f4;
            --card-background: #ffffff;
            --text-color: #333333;
            --sidebar-background: #2c3e50;
            --sidebar-text-color: #ecf0f1;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            color: var(--text-color);
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: var(--sidebar-background);
            color: var(--sidebar-text-color);
            position: fixed;
            height: 100vh;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            color: var(--sidebar-text-color);
            margin: 0;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .sidebar a {
            color: var(--sidebar-text-color);
            text-decoration: none;
            margin: 10px 0;
            display: block;
            font-size: 18px;
            transition: background-color 0.3s ease, padding-left 0.3s ease;
        }

        .sidebar a:hover {
            background-color: var(--primary-color);
            padding-left: 10px;
        }

        .container {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
        }

        h1 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 30px;
        }

        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: var(--card-background);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card h2 {
            color: var(--primary-color);
            margin-top: 0;
        }

        .card p {
            color: #666;
        }

        .card-icon {
            font-size: 48px;
            margin-bottom: 15px;
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .container {
                margin-left: 0;
                width: 100%;
            }
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                display: flex;
                flex-wrap: wrap;
            }
            .sidebar a {
                display: inline-block;
                margin: 5px 10px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>D&S Dashboard</h2>
        <a href="insert_form.php">Insert New Product</a>
        <a href="insert_customer.php">Insert Customer</a>
        <a href="ViewOutstading.php">View Outstanding</a>
        <a href="settlement.php">Bill Settlement</a>
        <a href="modern-php-billing-ui.php">Modern Billing</a>
        <a href="billing.php">Billing</a>
        <a href="backup.php">Backup</a>
        <a href="view_pdfs.php">View PDF Files</a>
    </div>
    

    <script>
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('click', () => {
                window.location.href = card.getAttribute('data-url');
            });
        });
    </script>
</body>
</html>
