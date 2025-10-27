<?php
require 'db_connection.php';
if (!isset($_GET['id'])) {
    header("Location: inventory_records.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$_GET['id']]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Product not found!");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        input { padding: 6px; margin: 6px; width: 250px; }
        .btn { padding: 6px 12px; background: #28a745; color: white; border: none; cursor: pointer; }
        .btn:hover { background: #1e7e34; }
    </style>
</head>
<body>

<h2>Edit Product Details</h2>

<form action="inventory_query.php" method="POST">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required><br>
    <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>" required><br>
    <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($product['price']) ?>" required><br>
    <input type="number" name="quantity" value="<?= htmlspecialchars($product['quantity']) ?>" required><br>
    <button type="submit" name="update" class="btn">Update</button>
</form>

<br>
<a href="inventory_records.php">← Back to Inventory</a>

</body>
</html>
