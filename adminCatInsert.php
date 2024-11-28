<?php
// Include your database connection
// include 'db_connection.php';

// Check if the form was submitted
require "admin_headder.php";
// require_once "config.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['catName'])) {

        // Retrieve the category name
        $catName = $_POST['catName'];

        // Handle the file upload
        $targetDir = "assets/img/JobTypeIcon/"; // Directory where the image will be stored
        $targetFile = $targetDir . basename($_FILES["catPhoto"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES["catPhoto"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if the file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, the file already exists.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload the file
            if (move_uploaded_file($_FILES["catPhoto"]["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($_FILES["catPhoto"]["name"])) . " has been uploaded.";

                // Insert into the database
                $catPhotoPath = $targetFile; // Store the image path
                $sql = "INSERT INTO catagory (catName, catInameLink) VALUES ('$catName', '$catPhotoPath')";

                if (mysqli_query($con, $sql)) {
                    echo "Category successfully added!";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                }

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    if (isset($_POST['catNameDelete'])) {

        $catNameDelete = $_POST['catNameDelete'];

        // Create a query to delete the category from the database
        $sql = "DELETE FROM catagory WHERE catName = '$catNameDelete'";

        // Execute the query
        if (mysqli_query($con, $sql)) {
            if (mysqli_affected_rows($con) > 0) {
                echo "Category successfully deleted!";
            } else {
                echo "Category not found.";
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
    // Close the database connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
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

    <!-- First Form: Add Category -->
    <form action="" method="POST" enctype="multipart/form-data" style="
        display: table;
        margin: 50px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    ">
        <div style="display: table-row;">
            <label for="catName" style="
                display: table-cell;
                padding: 10px;
                font-weight: bold;
            ">Category Name:</label>
            <input type="text" id="catName" name="catName" required style="
                display: table-cell;
                padding: 10px;
                width: 100%;
                border: 1px solid #ccc;
                border-radius: 5px;
            ">
        </div>
        <div style="display: table-row;">
            <label for="catPhoto" style="
                display: table-cell;
                padding: 10px;
                font-weight: bold;
            ">Category Photo:</label>
            <input type="file" id="catPhoto" name="catPhoto" accept="image/*" required style="
                display: table-cell;
                padding: 10px;
                width: 100%;
                border: 1px solid #ccc;
                border-radius: 5px;
            ">
        </div>
        <div style="display: table-row;">
            <div style="display: table-cell;"></div>
            <button type="submit" style="
                display: table-cell;
                padding: 10px 20px;
                margin-top: 10px;
                background-color: #28a745;
                color: white;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            " onmouseover="this.style.backgroundColor='#218838';" onmouseout="this.style.backgroundColor='#28a745';">
                Submit
            </button>
        </div>
    </form>

    <!-- Second Form: Delete Category -->
    <form action="" method="POST" enctype="multipart/form-data" style="
        display: table;
        margin: 50px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    ">
        <div style="display: table-row;">
            <label for="catNameDelete" style="
                display: table-cell;
                padding: 10px;
                font-weight: bold;
                
            ">Enter Category <br>Name to Delete:</label>
            <input type="text" id="catNameDelete" name="catNameDelete" required style="
                display: table-cell;
                padding: 10px;
                width: 100%;
                border: 1px solid #ccc;
                border-radius: 5px;
            ">
        </div>
        <div style="display: table-row;">
            <div style="display: table-cell;"></div>
            <button type="submit" style="
                display: table-cell;
                padding: 10px 20px;
                margin-top: 10px;
                background-color: #dc3545;
                color: white;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            " onmouseover="this.style.backgroundColor='#c82333';" onmouseout="this.style.backgroundColor='#dc3545';">
                Delete Category
            </button>
        </div>
    </form>

</body>

</html>