<?php
require 'connection.php';
if (!isset($_GET['id'])) {
    header("Location: records.php");
    exit;
}
$stmt = $pdo->prepare("SELECT * FROM students WHERE id=?");
$stmt->execute([$_GET['id']]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    die("Student not found!");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        input { padding: 6px; margin: 6px; width: 250px; }
        .btn { padding: 6px 12px; background: #28a745; color: white; border: none; cursor: pointer; }
        .btn:hover { background: #1e7e34; }
    </style>
</head>
<body>
<h2>Edit Student Information</h2>

<form action="query.php" method="POST">
    <input type="hidden" name="id" value="<?= $student['id'] ?>">
    <input type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>" required><br>
    <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" required><br>
    <input type="text" name="program" value="<?= htmlspecialchars($student['program']) ?>" required><br>
    <input type="text" name="semester" value="<?= htmlspecialchars($student['semester']) ?>" required><br>
    <input type="number" step="0.01" name="gpa" value="<?= htmlspecialchars($student['gpa']) ?>" required><br>
    <button type="submit" name="update" class="btn">Update</button>
</form>

<br>
<a href="records.php">← Back to Records</a>

</body>
</html>
