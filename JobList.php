<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session only if it isn't already started
}

if (isset($_GET['action']) && $_GET['action'] == 'saveValue') {
    if (isset($_GET['value'])) {
        // Save the value from the query string in the session
        $_SESSION['savedValue'] = $_GET['value'];

        $typeSelected = $_SESSION['savedValue'];
    }
}
?>

<!-- Rest of your HTML/PHP code -->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/price_rangs.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

</body>

</html>

<?php
// Include your database connection
include 'headder.php';

// Query to fetch data from the database
$sql = "SELECT id, name, surname, address, classification, photo ,email,phone_number FROM userdata WHERE classification = '$typeSelected' ";
$result = mysqli_query($con, $sql);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Generate the HTML block for each record that meets the condition
        echo '<div class="container">';
        echo '<div class="single-job-items mb-30">';
        echo '    <div class="job-items">';
        echo '        <div class="company-img">';
        echo '            <a href="#"><img src="uploads/' . $row['photo'] . '" alt="" style="width: 100px; height: 100px; object-fit: cover;"></a>';
        echo '        </div>';
        echo '        <div class="job-tittle job-tittle2">';
        echo '            <a href="#">';
        echo '                <h4>' . $row['name'] . ' ' . $row['surname'] . '</h4>';
        echo '            </a>';
        echo '            <ul>';
        echo '                <li>' . $row['classification'] . '</li><br>';
        echo '                <li><i class="fas fa-map-marker-alt"></i>' . $row['address'] . '</li> <br>';
        echo '                <li><i class="fas fa-envelope"></i> ' . $row['email'] . '</li><br>';
        echo '                <li><i class="fas fa-phone"></i> ' . $row['phone_number'] . '</li><br>';
        echo '            </ul>';
        echo '        </div>';
        echo '    </div>';
        echo '    <div class="items-link items-link2 f-right">';
        echo '        <a href="job_details.html">View Details</a>';
        echo '        <span>' . date('F j, Y, g:i a') . '</span>'; // Adjust date/time as needed
        echo '    </div>';
        echo '</div>';
        echo '</div>';

    }
} else {
    echo 'No records found.';
}

// Close the database connection
mysqli_close($con);
?>