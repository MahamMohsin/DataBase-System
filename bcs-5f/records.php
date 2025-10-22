<?php
require 'connection.php';
$stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #f2f2f2; }
        form { margin-top: 20px; }
        input, select { padding: 6px; margin: 4px; }
        .btn { padding: 6px 12px; background: #007bff; color: white; border: none; cursor: pointer; }
        .btn:hover { background: #0056b3; }
        .delete { background: #dc3545; }
        .delete:hover { background: #a71d2a; }
    </style>
</head>
<body>
<h2>Student Management System</h2>

<form action="query.php" method="POST">
    <input type="text" name="student_id" placeholder="Student ID" required>
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="program" placeholder="Program" required>
    <input type="text" name="semester" placeholder="Semester" required>
    <input type="number" step="0.01" name="gpa" placeholder="GPA" required>
    <button type="submit" name="add" class="btn">Add Student</button>
</form>

<table>
    <tr>
        <th>ID</th><th>Student ID</th><th>Name</th><th>Email</th><th>Program</th>
        <th>Semester</th><th>GPA</th><th>Actions</th>
    </tr>
    <?php foreach ($students as $s): ?>
        <tr>
            <td><?= $s['id'] ?></td>
            <td><?= htmlspecialchars($s['student_id']) ?></td>
            <td><?= htmlspecialchars($s['name']) ?></td>
            <td><?= htmlspecialchars($s['email']) ?></td>
            <td><?= htmlspecialchars($s['program']) ?></td>
            <td><?= htmlspecialchars($s['semester']) ?></td>
            <td><?= htmlspecialchars($s['gpa']) ?></td>
            <td>
                <a href="details.php?id=<?= $s['id'] ?>">Edit</a> | 
                <a class="delete" href="query.php?delete=<?= $s['id'] ?>" onclick="return confirm('Delete this record?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
