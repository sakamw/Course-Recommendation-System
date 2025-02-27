<?php
include 'config.php';

try {
  $pdo = new PDO("mysql:host=localhost;dbname=recdss", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="select.css">
<head>
    <title>Student Grade Entry</title>
</head>
<body>
    <h2>Enter Your Grades</h2>
    <form action="process_grades.php" method="POST">
        <?php
        $subjects = $pdo->query("SELECT id, subject_name FROM subjects")->fetchAll();
        foreach ($subjects as $subject) {
            echo "<label>{$subject['subject_name']}</label>";
            echo "<select name='grades[{$subject['id']}]' required>
                    <option value=''>Select Grade</option>
                    <option value='12'>A</option>
                    <option value='11'>A-</option>
                    <option value='10'>B+</option>
                    <option value='9'>B</option>
                    <option value='8'>B-</option>
                    <option value='7'>C+</option>
                    <option value='6'>C</option>
                    <option value='5'>C-</option>
                    <option value='4'>D+</option>
                    <option value='3'>D</option>
                    <option value='2'>D-</option>
                    <option value='1'>E</option>
                </select><br><br>";
        }
        ?>
        <input type="submit" value="Submit Grades">
    </form>
</body>
</html>