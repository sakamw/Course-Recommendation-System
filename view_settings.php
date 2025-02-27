<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// For demonstration, you could fetch user-specific settings from the database.
// Here, we simply display a static page.
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
  <div class="form-container">
    <h1>Account Settings</h1>
    <p>Here you can configure your account settings.</p>
    
    <!-- You can add forms or additional options as needed -->
    
    <p><a href="dashboard.php">Back to Dashboard</a></p>
  </div>
</body>
</html>
