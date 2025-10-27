<?php
require 'db_connection.php';


if (isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO products (name, category, price, quantity) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_POST['name'],
        $_POST['category'],
        $_POST['price'],
        $_POST['quantity']
    ]);
    header("Location: inventory_records.php");
    exit;
}


if (isset($_POST['update'])) {
    $stmt = $pdo->prepare("UPDATE products SET name=?, category=?, price=?, quantity=? WHERE id=?");
    $stmt->execute([
        $_POST['name'],
        $_POST['category'],
        $_POST['price'],
        $_POST['quantity'],
        $_POST['id']
    ]);
    header("Location: inventory_records.php");
    exit;
}


if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM products WHERE id=?");
    $stmt->execute([$_GET['delete']]);
    header("Location: inventory_records.php");
    exit;
}
?>
