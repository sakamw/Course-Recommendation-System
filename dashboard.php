<?php
session_start();
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Additional GET logout check for auto logout via JavaScript
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Get user information
$conn = connectDB();
$user_id = $_SESSION['user_id'];
$stmt = mysqli_prepare($conn, "SELECT username, email FROM users WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// Fetch recent activity for this user (e.g., last 5 actions)
$activityStmt = mysqli_prepare($conn, "SELECT action, details, created_at FROM activity_log WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
mysqli_stmt_bind_param($activityStmt, "i", $user_id);
mysqli_stmt_execute($activityStmt);
$activityResult = mysqli_stmt_get_result($activityStmt);

$recentActivities = [];
while ($row = mysqli_fetch_assoc($activityResult)) {
    $recentActivities[] = $row;
}

// Handle logout via POST (manual logout button)
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- head content remains the same -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="dashboard.css">
  <script src="script.js"></script>
</head>
<body>
    <nav class="navbar">
      <div class="logo">Dashboard</div>
      <div class="user-info">
        <span>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</span>
        <form class="logout-form" method="POST">
          <button type="submit" name="logout" class="logout-button">Logout</button>
        </form>
      </div>
    </nav>

    <!-- Countdown display element -->
    <div id="countdown"></div>

    <div class="dashboard-container">
      <section class="welcome-section">
        <h1>Welcome to Your Dashboard</h1>
        <p>Here's an overview of your account and activities.</p>
      </section>

      <div class="stats-grid">
        <div class="stat-card">
          <h3>Profile Info</h3>
          <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
          <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        </div>
        
        <div class="stat-card">
          <h3>Account Status</h3>
          <p><strong>Status:</strong> Active</p>
          <p><strong>Member Since:</strong> <?php echo date('F Y'); ?></p>
        </div>
        
        <div class="stat-card">
          <h3>Quick Actions</h3>
          <ul>
            <li><a href="update_profile.php">Update Profile</a></li>
            <li><a href="change_password.php">Change Password</a></li>
            <li><a href="view_settings.php">View Settings</a></li>
          </ul>
        </div>
      </div>

      <section class="recent-activity">
        <h2>Recent Activity</h2>
        <div class="activity-list">
          <?php if (!empty($recentActivities)): ?>
              <?php foreach ($recentActivities as $activity): ?>
                  <div class="activity-item">
                    <p><?php echo htmlspecialchars($activity['action']); ?></p>
                    <?php if (!empty($activity['details'])): ?>
                        <p><?php echo htmlspecialchars($activity['details']); ?></p>
                    <?php endif; ?>
                    <small><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($activity['created_at']))); ?></small>
                  </div>
              <?php endforeach; ?>
          <?php else: ?>
              <p>No recent activities recorded.</p>
          <?php endif; ?>
        </div>
      </section>
    </div>
</body>
</html>