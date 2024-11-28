<?php
// Include config file
require_once "admin_headder.php";

// Initialize variables
$search = "";
$search_query = "";

// Handle search request
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
    // Prepare a search query that includes the id field
    $search_query = "WHERE id LIKE ? OR username LIKE ? ";
}

// Prepare the SQL query to fetch log entries
$sql = "SELECT * FROM logdata $search_query";
$stmt = mysqli_prepare($con, $sql);

if ($search_query != "") {
    $search_param = "%" . $search . "%";
    mysqli_stmt_bind_param($stmt, "ss", $search_param, $search_param);
}

// Execute the prepared statement
mysqli_stmt_execute($stmt);

// Get the result set
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<a href="admin_page.php" style="
        display: inline-block;
        position: absolute;
        top: 20px; 
        left: 20px;
        padding: 10px 20px;
        background-color: #007bff; 
        color: white; 
        text-decoration: none; 
        border-radius: 5px; 
        font-size: 16px;
        transition: background-color 0.3s ease;
    " onmouseover="this.style.backgroundColor='#0056b3';" onmouseout="this.style.backgroundColor='#007bff';">
        Home
    </a>


    <div class="container mt-5">
        <h2>Log Management</h2>

        <!-- Search Form -->
        <form method="get"  class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search logs..." value="<?php echo htmlspecialchars($search); ?>">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0) : ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="log_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-center">No log entries found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Handle delete request
if (isset($_POST['delete'])) {
    $log_id = $_POST['log_id'];
    
    // Prepare a delete statement
    $sql = "DELETE FROM logdata WHERE id = ?";
    
    if ($stmt = mysqli_prepare($con, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $log_id);
        
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Log entry deleted successfully.";
        } else {
            echo "Error deleting log entry.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

// Close connection
mysqli_close($con);
?>
