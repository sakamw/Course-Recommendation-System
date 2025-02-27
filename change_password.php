<?php
session_start();
require_once 'config.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = connectDB();
$user_id = $_SESSION['user_id'];
$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $current_password = $_POST['current_password'];
    $new_password     = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Retrieve the current password hash from the database
    $stmt = mysqli_prepare($conn, "SELECT password_hash FROM users WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user   = mysqli_fetch_assoc($result);

    if ($user && password_verify($current_password, $user['password_hash'])) {
        if ($new_password === $confirm_password) {
            $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt2 = mysqli_prepare($conn, "UPDATE users SET password_hash = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt2, "si", $new_hash, $user_id);
            if (mysqli_stmt_execute($stmt2)) {
                $message = "Password updated successfully.";

                // Log the action into activity_log table
                $logStmt = mysqli_prepare($conn, "INSERT INTO activity_log (user_id, action, details) VALUES (?, ?, ?)");
                $action = "Password Changed";
                $details = "User changed their password successfully.";
                mysqli_stmt_bind_param($logStmt, "iss", $user_id, $action, $details);
                mysqli_stmt_execute($logStmt);
            } else {
                $message = "Error updating password.";
            }
        } else {
            $message = "New password and confirmation do not match.";
        }
    } else {
        $message = "Current password is incorrect.";
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
  <div class="form-container">
    <h1>Change Password</h1>
    <?php if ($message): ?>
      <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form method="POST" action="">
      <label for="current_password">Current Password:</label>
      <input type="password" id="current_password" name="current_password" required>
      
      <label for="new_password">New Password:</label>
      <input type="password" id="new_password" name="new_password" required>
      
      <label for="confirm_password">Confirm New Password:</label>
      <input type="password" id="confirm_password" name="confirm_password" required>
      
      <button type="submit">Change Password</button>
    </form>
    <p><a href="dashboard.php">Back to Dashboard</a></p>
  </div>
</body>
</html>