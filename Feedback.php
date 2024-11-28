<?php
// Include your database connection file
include 'config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session only if it isn't already started
}
$id = (int) $_SESSION["id"];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and assign form inputs to variables
    $rating = mysqli_real_escape_string($con, $_POST['rating']);
    
    // Ensure feedback-type is set and sanitize it
    $feedback_type = isset($_POST['feedback-type']) ? mysqli_real_escape_string($con, $_POST['feedback-type']) : 'Not Specified';
    
    // Handle the 'recommend' field correctly
    $recommend = isset($_POST['recommend']) ? $_POST['recommend'] : "Not selected";
    // if (is_array($recommend)) {
    //     $recommend = implode(', ', $recommend);
    // } else {
    //     $recommend = 'no';
    // }
    
    $feedback = mysqli_real_escape_string($con, $_POST['feedback']);

    // Check if a record with the given id already exists
    $check_sql = "SELECT id FROM feedback WHERE id = ?";
    if ($check_stmt = mysqli_prepare($con, $check_sql)) {
        mysqli_stmt_bind_param($check_stmt, "i", $id);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        if (mysqli_stmt_num_rows($check_stmt) > 0) {
            // Record exists, update it
            $sql = "UPDATE feedback SET rating = ?, feedback_type = ?, recommend = ?, feedback = ? WHERE id = ?";
            if ($stmt = mysqli_prepare($con, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssssi", $rating, $feedback_type, $recommend, $feedback, $id);

                if (mysqli_stmt_execute($stmt)) {
                    echo "Feedback updated successfully!";
                } else {
                    echo "Error: Could not execute the query: " . mysqli_error($con);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Error: Could not prepare the query: " . mysqli_error($con);
            }
        } else {
            // Record does not exist, insert a new one
            $sql = "INSERT INTO feedback (id, rating, feedback_type, recommend, feedback) VALUES (?, ?, ?, ?, ?)";
            if ($stmt = mysqli_prepare($con, $sql)) {
                mysqli_stmt_bind_param($stmt, "issss", $id, $rating, $feedback_type, $recommend, $feedback);

                if (mysqli_stmt_execute($stmt)) {
                    echo "Feedback submitted successfully!";
                } else {
                    echo "Error: Could not execute the query: " . mysqli_error($con);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Error: Could not prepare the query: " . mysqli_error($con);
            }
        }

        mysqli_stmt_close($check_stmt);
    } else {
        echo "Error: Could not prepare the query: " . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($con);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/price_rangs.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 10vh;
            padding: 20px;
            box-sizing: border-box;
        }

        .feedback-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
            /* Center horizontally */
        }

        .feedback-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .feedback-container form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .feedback-container label {
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }

        .feedback-container select,
        .feedback-container input[type="text"],
        .feedback-container textarea {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
            color: #333;
        }

        .feedback-container textarea {
            resize: vertical;
        }

        .feedback-container .radio-group,
        .feedback-container .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 5px;
        }

        .feedback-container .radio-group label,
        .feedback-container .checkbox-group label {
            color: #555;
            font-weight: normal;
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        .feedback-container .radio-group input,
        .feedback-container .checkbox-group input {
            margin-right: 8px;
        }

        .feedback-container button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .feedback-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

        

    <?php include 'headder.php'; ?>
    <div class="center-container">
        <div class="feedback-container">
            <h2>Feedback Form</h2>
            <form method="post" action="feedback.php">
                <!-- Rating -->
                <div>
                    <label for="rating">Rating:</label>
                    <select id="rating" name="rating" required>
                        <option value="excellent">Excellent</option>
                        <option value="good">Good</option>
                        <option value="average">Average</option>
                        <option value="poor">Poor</option>
                    </select>
                </div>

                <!-- Feedback Type -->
                <div class="radio-group">
                    <label><input type="radio" id="complaint" name="feedback-type" value="complaint" required> Complaint</label>
                    <label><input type="radio" id="suggestion" name="feedback-type" value="suggestion" required>
                        Suggestion</label>
                    <label><input type="radio" id="question" name="feedback-type" value="question" required> Question</label>
                    <label><input type="radio" id="praise" name="feedback-type" value="praise" required> Praise</label>
                </div>

                <!-- Would you recommend us? -->
                <div class="checkbox-group">
                    <label><input type="radio" name="recommend" value="yes" required> Yes</label>
                    <label><input type="radio" name="recommend" value="no" required> No</label>
                </div>

                <!-- Feedback -->
                <div>
                    <label for="feedback">Feedback:</label>
                    <textarea id="feedback" name="feedback" rows="4" placeholder="Your feedback" required></textarea>
                </div>

                <!-- Submit Button -->
                <div style="text-align: center;">
                    <button type="submit">Submit</button>
                </div>
            </form>
</body>

</html>