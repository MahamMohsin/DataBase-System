<?php
require 'connection.php';

// CREATE student
if (isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO students (student_id, name, email, program, semester, gpa) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['student_id'],
        $_POST['name'],
        $_POST['email'],
        $_POST['program'],
        $_POST['semester'],
        $_POST['gpa']
    ]);
    header("Location: records.php");
    exit;
}

// UPDATE student
if (isset($_POST['update'])) {
    $stmt = $pdo->prepare("UPDATE students 
                           SET name=?, email=?, program=?, semester=?, gpa=? 
                           WHERE id=?");
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['program'],
        $_POST['semester'],
        $_POST['gpa'],
        $_POST['id']
    ]);
    header("Location: records.php");
    exit;
}

// DELETE student
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM students WHERE id=?");
    $stmt->execute([$_GET['delete']]);
    header("Location: records.php");
    exit;
}
?>
