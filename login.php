<?php
session_start();
require_once 'config.php';

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectDB();
    
    // Use mysqli_real_escape_string to sanitize username input.
    $username_input = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    
    // Update the SQL query to also fetch the is_admin field.
    $sql = "SELECT id, username, password_hash, is_admin FROM users WHERE username = ? OR email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username_input, $username_input);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password_hash'])) {
            // Set common session variables.
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            
            // Check if the user is an admin.
            if (isset($row['is_admin']) && $row['is_admin'] == 1) {
                $_SESSION['admin_logged_in'] = true;
                header("Location: admin.php");
                exit();
            } else {
                header("Location: dashboard.php");
                exit();
            }
        } else {
            $error_message = "Invalid username or password";
        }
    } else {
        $error_message = "Invalid username or password";
    }
    
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="auth-container">
      <div class="auth-header">
          <h1>Login</h1>
          <p>Welcome back</p>
      </div>
      
      <?php if ($error_message): ?>
          <div class="error-message">
              <?php echo htmlspecialchars($error_message); ?>
          </div>
      <?php endif; ?>

      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="form-group">
              <label for="username">Username or Email</label>
              <input type="text" id="username" name="username" required>
          </div>
          
          <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" required>
          </div>
          
          <button type="submit" class="auth-button">Log In</button>
      </form>

      <div class="auth-links">
          Don't have an account? <a href="signup.php">Sign up here</a>
      </div>
  </div>
</body>
</html>