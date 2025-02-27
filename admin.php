<?php
// Start session and check admin authentication
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="admin.css">  
</head>
<body>
  <div class="admin-container">
    <!-- Header -->
    <header class="admin-header">
      <div class="logo">Admin Panel</div>
      <div class="header-right">
        <button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>
        <span>Welcome, Admin!</span>
        <!-- Replace the form with your logout logic -->
        <form action="logout.php" method="post">
          <button type="submit">Logout</button>
        </form>
      </div>
    </header>
    
    <!-- Sidebar -->
    <aside class="admin-sidebar" id="sidebar">
      <nav>
        <ul>
          <li><a href="admin.php" class="active">Dashboard</a></li>
          <li><a href="users.php">Users</a></li>
          <li><a href="settings.php">Settings</a></li>
          <li><a href="reports.php">Reports</a></li>
          <li><a href="logs.php">Activity Logs</a></li>
        </ul>
      </nav>
    </aside>
    
    <!-- Main Content -->
    <main class="admin-main">
      <h1>Dashboard</h1>
      <div class="cards-container">
        <div class="card">
          <h3>Total Users</h3>
          <p>125</p>
        </div>
        <div class="card">
          <h3>New Registrations</h3>
          <p>12</p>
        </div>
        <div class="card">
          <h3>Active Sessions</h3>
          <p>8</p>
        </div>
        <div class="card">
          <h3>Pending Tasks</h3>
          <p>5</p>
        </div>
      </div>
      <section class="content-section">
        <h2></h2>
        <p></p>
      </section>
    </main>
  </div>
  
  <script>
    // Sidebar toggle function for mobile devices
    function toggleSidebar() {
      var sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('collapsed');
    }
  </script>
</body>
</html>