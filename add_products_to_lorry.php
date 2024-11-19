<?php
// Database connection
$host = 'localhost';
$dbname = 'rapsol';
$user = 'root';
$pass = '2000';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Function to get a new transfer ID
function getNewTransferId($pdo) {
    $stmt = $pdo->query("SELECT COALESCE(MAX(transfer_id), 0) AS last_id FROM transfer");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['last_id'] + 1; // Return the next ID
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $transfer_id = $_POST['transfer_id'];
    $lorry_id = $_POST['lorry_id'];
    $products = $_POST['products']; // Array of product data

    try {
        $pdo->beginTransaction();

        // Insert a new transfer record
        $stmt = $pdo->prepare("INSERT INTO transfer (transfer_id) VALUES (?)");
        $stmt->execute([$transfer_id]);

        // Prepare a statement for inserting or updating
        $stmt = $pdo->prepare("
            INSERT INTO lorry_products (transfer_id, lorry_id, product_id, quantity)
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)
        ");

        foreach ($products as $product) {
            $stmt->execute([$transfer_id, $lorry_id, $product['id'], $product['quantity']]);
        }

        $pdo->commit();
        echo "Products successfully added to the lorry with Transfer ID $transfer_id.";
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Failed to add products: " . $e->getMessage();
    }
}

// Get a new transfer ID to show on the form
$new_transfer_id = getNewTransferId($pdo);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Products to Lorry</title>
</head>
<body>
    <h1>Add Products to Lorry</h1>
    <form method="POST" action="">
        <label for="transfer_id">Transfer ID:</label>
        <input type="number" id="transfer_id" name="transfer_id" value="<?php echo htmlspecialchars($new_transfer_id); ?>" readonly><br><br>

        <label for="lorry_id">Lorry ID:</label>
        <input type="number" id="lorry_id" name="lorry_id" required><br><br>

        <div id="product-fields">
            <!-- Product fields will be added here -->
        </div>

        <button type="button" onclick="addProductField()">Add Product</button><br><br>
        <input type="submit" value="Submit">
    </form>

    <script>
        let productCount = 0;

        function addProductField() {
            productCount++;
            const container = document.getElementById('product-fields');
            const field = document.createElement('div');
            field.innerHTML = `
                <h3>Product ${productCount}</h3>
                <label for="product_${productCount}_id">Product ID:</label>
                <input type="number" id="product_${productCount}_id" name="products[${productCount}][id]" required>
                <label for="product_${productCount}_quantity">Quantity:</label>
                <input type="number" id="product_${productCount}_quantity" name="products[${productCount}][quantity]" required><br><br>
            `;
            container.appendChild(field);
        }
    </script>
</body>
</html>
