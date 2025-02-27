<?php
include 'config.php';

try {
  $pdo = new PDO("mysql:host=localhost;dbname=recdss", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grades = $_POST['grades'];
    $student_id = 1; // Placeholder, replace with session user ID if needed

    foreach ($grades as $subject_id => $grade) {
        $stmt = $pdo->prepare("INSERT INTO student_grades (student_id, subject_id, grade) VALUES (?, ?, ?)");
        $stmt->execute([$student_id, $subject_id, $grade]);
    }
    header("Location: recommend.php?student_id=$student_id");
    exit();
}
?>