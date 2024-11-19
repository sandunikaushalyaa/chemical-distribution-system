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
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
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
            .dashboard {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
    <div style="display: flex; justify-content: flex-end;">
        <form action="index.php" method="post">
            <button type="submit" style="background-color: var(--primary-color); color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                Logout
            </button>
        </form>
    </div>
        <h1>D&S Marketing Dashboard</h1>
        <div class="dashboard">

            <div class="card" data-url="productView.php">
                <div class="card-icon">🔎</div>
                <h2>View Product</h2>
                <p>View products in the inventory</p>
            </div>
            <div class="card" data-url="insert_customer.php">
                <div class="card-icon">👤</div>
                <h2>Insert Customer</h2>
                <p>Register new customers</p>
            </div>
            <div class="card" data-url="customerView.php">
                <div class="card-icon">🔎</div>
                <h2>View Customer</h2>
                <p>View Customers in the inventory</p>
            </div>
            <div class="card" data-url="ViewOutstading.php">
                <div class="card-icon">📊</div>
                <h2>View Outstanding</h2>
                <p>Check outstanding balances</p>
            </div>
            <div class="card" data-url="settlement2.php">
                <div class="card-icon">💰</div>
                <h2>Bill Settlement</h2>
                <p>Process bill payments</p>
            </div>
            <div class="card" data-url="modern-php-billing-ui.php">
                <div class="card-icon">📄</div>
                <h2>Billing</h2>
                <p>Modern billing operations</p>
            </div>
            <div class="card" data-url="view_pdfs.php">
                <div class="card-icon">📋</div>
                <h2>View PDF Files</h2>
                <p>View Invoice, Settlement Reports</p>
            </div>



            
        </div>
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