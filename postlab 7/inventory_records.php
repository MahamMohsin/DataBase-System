<?php
require 'db_connection.php';
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Inventory</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #f8f8f8; }
        input { padding: 6px; margin: 4px; }
        .btn { padding: 6px 12px; background: #007bff; color: white; border: none; cursor: pointer; }
        .btn:hover { background: #0056b3; }
        .delete { background: #dc3545; }
        .delete:hover { background: #a71d2a; }
        .low-stock { background-color: #fff3cd; color: #856404; font-weight: bold; }
    </style>
</head>
<body>

<h2>🛒 Product Inventory Management</h2>

<form action="inventory_query.php" method="POST">
    <input type="text" name="name" placeholder="Product Name" required>
    <input type="text" name="category" placeholder="Category" required>
    <input type="number" step="0.01" name="price" placeholder="Price" required>
    <input type="number" name="quantity" placeholder="Quantity" required>
    <button type="submit" name="add" class="btn">Add Product</button>
</form>

<table>
    <tr>
        <th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>Quantity</th><th>Status</th><th>Actions</th>
    </tr>
    <?php foreach ($products as $p): ?>
        <?php $lowStock = $p['quantity'] < 10; ?>
        <tr class="<?= $lowStock ? 'low-stock' : '' ?>">
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= htmlspecialchars($p['category']) ?></td>
            <td>$<?= htmlspecialchars($p['price']) ?></td>
            <td><?= htmlspecialchars($p['quantity']) ?></td>
            <td><?= $lowStock ? 'Low Stock ⚠️' : 'In Stock' ?></td>
            <td>
                <a href="inventory_edit.php?id=<?= $p['id'] ?>">Edit</a> | 
                <a href="inventory_query.php?delete=<?= $p['id'] ?>" class="delete" onclick="return confirm('Delete this product?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
