<?php
// users.php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

require_once 'config.php';
$conn = connectDB();

// Retrieve all users (ordered by registration date, newest first)
$sql = "SELECT id, username, email, is_admin, created_at FROM users ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Management - Admin Panel</title>
  <link rel="stylesheet" href="admin.css"/>
  <style>
    /* Additional styles for the user management interface */
    .user-management {
      padding: 2rem;
    }
    .user-management h2 {
      margin-bottom: 1rem;
      color: #0078d7;
    }
    .user-search {
      margin-bottom: 1rem;
    }
    .user-search input {
      padding: 0.5rem;
      width: 300px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    table.user-table {
      width: 100%;
      border-collapse: collapse;
    }
    table.user-table th, table.user-table td {
      padding: 0.75rem;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    table.user-table th {
      background-color: #f4f4f4;
    }
    .action-buttons button {
      padding: 0.4rem 0.8rem;
      margin-right: 0.5rem;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    .action-buttons .edit-btn {
      background-color: #4a90e2;
      color: white;
    }
    .action-buttons .delete-btn {
      background-color: #e74c3c;
      color: white;
    }
    .action-buttons button:hover {
      opacity: 0.8;
    }
  </style>
</head>
<body>
  <div class="admin-container">
    <!-- Include header and sidebar from your admin panel -->
    <?php include 'admin_header.php'; ?>
    <?php include 'admin_sidebar.php'; ?>

    <!-- Main content area -->
    <main class="admin-main">
      <div class="user-management">
        <h2>User Management</h2>
        <div class="user-search">
          <input type="text" id="searchInput" placeholder="Search users..." />
        </div>
        <table class="user-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Username</th>
              <th>Email</th>
              <th>Role</th>
              <th>Registered</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="userTableBody">
            <?php foreach($users as $user): ?>
              <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo ($user['is_admin'] == 1 ? 'Admin' : 'User'); ?></td>
                <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                <td class="action-buttons">
                  <button class="edit-btn" onclick="editUser(<?php echo $user['id']; ?>)">Edit</button>
                  <button class="delete-btn" onclick="deleteUser(<?php echo $user['id']; ?>)">Delete</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>

  <script>
    // Simple JavaScript search functionality for filtering the table
    document.getElementById('searchInput').addEventListener('keyup', function() {
      let filter = this.value.toLowerCase();
      let rows = document.querySelectorAll('#userTableBody tr');
      rows.forEach(row => {
        let username = row.cells[1].textContent.toLowerCase();
        let email = row.cells[2].textContent.toLowerCase();
        if (username.includes(filter) || email.includes(filter)) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      });
    });

    // Placeholder functions for editing and deleting users
    function editUser(id) {
      alert('Edit user with ID: ' + id);
      // Implement actual edit functionality (e.g., redirect to an edit form page)
    }
    function deleteUser(id) {
      if (confirm('Are you sure you want to delete the user with ID: ' + id + '?')) {
        alert('User ' + id + ' deleted.');
        // Implement actual delete functionality
      }
    }
  </script>
</body>
</html>