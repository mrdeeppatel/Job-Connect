<?php
// Include config file
require "admin_headder.php";

// Initialize variables to store counts
$total_user_entries = 0;
$total_log_entries = 0;

// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Query to count entries in userdata table
$sql_user = "SELECT COUNT(*) as total FROM userdata";
if ($result_user = mysqli_query($con, $sql_user)) {
    $row_user = mysqli_fetch_assoc($result_user);
    $total_user_entries = $row_user['total'];
} else {
    die("Error counting entries in userdata table: " . mysqli_error($con));
}

// Query to count entries in logdata table
$sql_log = "SELECT COUNT(*) as total FROM logdata";
if ($result_log = mysqli_query($con, $sql_log)) {
    $row_log = mysqli_fetch_assoc($result_log);
    $total_log_entries = $row_log['total'];
} else {
    die("Error counting entries in logdata table: " . mysqli_error($con));
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <!-- Link or add your CSS here -->
    <style>
        /* New CSS is added here */
        /* Basic styling for the entire page */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f2f5;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Container for the admin panel */
.admin-container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    border: 2px solid #007bff;
    max-width: 500px;
    width: 100%;
    text-align: center;
    transition: box-shadow 0.3s ease;
}

.admin-container:hover {
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

/* Admin title styling */
.admin-title {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
}

/* Admin stats section with box effects */
.admin-stats {
    margin-bottom: 30px;
    font-size: 18px;
    color: #555;
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #ced4da;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Links for the admin actions */
.admin-links {
    display: flex;
    flex-direction: column;
}

.admin-link {
    font-size: 16px;
    color: #007bff;
    text-decoration: none;
    margin: 10px 0;
    padding: 10px;
    border: 1px solid #007bff;
    border-radius: 5px;
    background-color: #f8f9fa;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.admin-link:hover {
    color: #ffffff;
    background-color: #007bff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

/* Responsive design */
@media (max-width: 768px) {
    .admin-container {
        padding: 20px;
    }

    .admin-title {
        font-size: 20px;
    }

    .admin-stats {
        font-size: 16px;
    }

    .admin-link {
        font-size: 14px;
    }
}

    </style>
</head>
<body>
    <div class="admin-container">
        <h1 class="admin-title">Welcome to the Admin Panel</h1>
        <div class="admin-stats">
            <p>Total Entries in Userdata Table: <?php echo $total_user_entries; ?></p>
            <p>Total Entries in Logdata Table: <?php echo $total_log_entries; ?></p>
        </div>

        <div class="admin-links">
            <a href="admin_userlist.php" class="admin-link">User List</a><br>
            <a href="admin_loglist.php" class="admin-link">Login List</a><br>
            <a href="admin_feedback.php" class="admin-link">Feedback List</a><br>
            <a href="adminCatInsert.php" class="admin-link">Category</a><br>
        </div>
    </div>
</body>
</html>
