<?php
// Include config file
require_once "admin_headder.php";

// Initialize variables
$search = "";
$search_query = "";

// Handle search request
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
    // Prepare a search query that includes all relevant fields
    $search_query = "WHERE id LIKE ? OR rating LIKE ? OR feedback_type LIKE ? OR recommend LIKE ? OR feedback LIKE ?";
}

// Prepare the SQL query to fetch feedback entries
$sql = "SELECT * FROM feedback $search_query ORDER BY submission_date DESC";
$stmt = mysqli_prepare($con, $sql);

if ($search_query != "") {
    $search_param = "%" . $search . "%";
    mysqli_stmt_bind_param($stmt, "sssss", $search_param, $search_param, $search_param, $search_param, $search_param);
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
    <title>Feedback Management</title>
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
        <h2>Feedback Management</h2>

        <!-- Search Form -->
        <form method="get"  class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search feedback..." value="<?php echo htmlspecialchars($search); ?>">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rating</th>
                    <th>Feedback Type</th>
                    <th>Recommend</th>
                    <th>Feedback</th>
                    <th>Submission Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0) : ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['rating']); ?></td>
                        <td><?php echo htmlspecialchars($row['feedback_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['recommend']); ?></td>
                        <td><?php echo htmlspecialchars($row['feedback']); ?></td>
                        <td><?php echo htmlspecialchars($row['submission_date']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">No feedback entries found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close connection
mysqli_close($con);
?>
