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

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and sanitize the posted values
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    
    
    // Update the user record
    $stmt = mysqli_prepare($conn, "UPDATE users SET username = ?, email = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssi", $username, $email, $user_id);
    if (mysqli_stmt_execute($stmt)) {
        $message = "Profile updated successfully.";
        
        // Log the update profile action in the activity_log table
        $logStmt = mysqli_prepare($conn, "INSERT INTO activity_log (user_id, action, details) VALUES (?, ?, ?)");
        $action = "Profile Updated";
        $details = "User updated their profile information.";
        mysqli_stmt_bind_param($logStmt, "iss", $user_id, $action, $details);
        mysqli_stmt_execute($logStmt);
        
    } else {
        $message = "Error updating profile. Please try again.";
    }
}

// Retrieve current user data
$stmt = mysqli_prepare($conn, "SELECT username, email FROM users WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Profile</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
  <div class="form-container">
    <h1>Update Profile</h1>
    <?php if ($message): ?>
      <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form method="POST" action="">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
      
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
      
      <button type="submit">Update Profile</button>
    </form>
    <p><a href="dashboard.php">Back to Dashboard</a></p>
  </div>
</body>
</html>