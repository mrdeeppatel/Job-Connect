<?php


// Start session and include config file
session_start();


require_once "config.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}


// Initialize variables and error messages
$name = $surname = $address = $classification = $id = $photo = $email = $mobileno = "";
$name_err = $surname_err = $address_err = $classification_err = $mobileno_err = $email_err = $photo_err = "";

$id = (int) $_SESSION["id"];

$sqlF = "SELECT name, surname, address, classification, photo, email, phone_number FROM userdata WHERE id = ?";

if ($stmt = mysqli_prepare($con, $sqlF)) {
    // Bind the ID parameter to the SQL query
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Bind the result variables
    mysqli_stmt_bind_result($stmt, $name, $surname, $address, $classification, $photo, $email, $mobileno);

    // Fetch the results and assign them to variables
    mysqli_stmt_fetch($stmt);
    // Now the variables $name, $surname, $address, $classification, and $photo
    // contain the values from the database


}
mysqli_stmt_close($stmt);

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate surname
    if (empty(trim($_POST["surname"]))) {
        $surname_err = "Please enter your surname.";
    } else {
        $surname = trim($_POST["surname"]);
    }

    // Validate address
    if (empty(trim($_POST["address"]))) {
        $address_err = "Please enter your address.";
    } else {
        $address = trim($_POST["address"]);
    }

    if (empty(trim($_POST["mobileno"]))) {
        $mobileno_err = "Please enter your Phone No.";
    } else {
        $mobileno = trim($_POST["mobileno"]);
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your Email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate classification
    if (empty(trim($_POST["classification"]))) {
        $classification_err = "Please enter your classification.";
    } else {
        $classification = trim($_POST["classification"]);
    }

    // Validate photo upload

    if ($photo == "") {
        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

            if (!in_array($_FILES["photo"]["type"], $allowed_types)) {
                $photo_err = "Please upload a valid image file (JPG, PNG, GIF).";
            } else {
                // Extract the original file extension
                $photo_ext = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);

                // Generate a new photo name, ensuring uniqueness
                $photo_name = $id . "_" . $name . "." . $photo_ext;
                $photo_path = "uploads/" . $photo_name;

                // Move the uploaded file to the destination path
                if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $photo_path)) {
                    $photo_err = "Failed to upload photo.";
                }
            }
        } else {
            $photo_err = "Please upload a photo.";
        }
    } else {

        $photo_name = $photo;

    }


    /*  BELOW BLOCK IS USED TO CHECK IF USER HAVE ALREADY UPLODED A PHOTO AND IF 
        NEW PHOTO IS SELCTED IT WILL UPLODE.
    */
    if ($photo != "" && isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {

        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($_FILES["photo"]["type"], $allowed_types)) {
            $photo_err = "Please upload a valid image file (JPG, PNG, GIF).";
        } else {
            // Extract the original file extension
            $photo_ext = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);

            // Generate a new photo name, ensuring uniqueness
            $photo_name = $id . "_" . $name . "." . $photo_ext;
            $photo_path = "uploads/" . $photo_name;

            // Move the uploaded file to the destination path
            if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $photo_path)) {
                $photo_err = "Failed to upload photo.";
            }
        }


    }
    $sql_check = "SELECT id FROM userdata WHERE id = ?";

    if ($stmt_check = mysqli_prepare($con, $sql_check)) {
        // Bind the ID parameter
        mysqli_stmt_bind_param($stmt_check, "i", $id);

        // Execute the statement
        mysqli_stmt_execute($stmt_check);

        // Store the result
        mysqli_stmt_store_result($stmt_check);

        if (mysqli_stmt_num_rows($stmt_check) > 0) {
            // ID already exists
            // echo "This ID already exists in the database.";
            if (empty($name_err) && empty($surname_err) && empty($address_err) && empty($classification_err) && empty($photo_err) && empty($mobileno_err) && empty($email_err)) {
                // Prepare an insert statement
                $sql = "UPDATE userdata SET name = ?, surname = ?, address = ?, classification = ?, photo = ? ,email =?,phone_number=? WHERE id = ?";


                if ($stmt = mysqli_prepare($con, $sql)) {
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "sssssssi", $param_name, $param_surname, $param_address, $param_classification, $param_photo, $param_email, $param_PhoneNo, $id);

                    // Set parameters
                    $param_name = $name;
                    $param_surname = $surname;
                    $param_address = $address;
                    $param_classification = $classification;
                    $param_photo = $photo_name;
                    $param_email = $email;
                    $param_PhoneNo = $mobileno;

                    // Attempt to execute the prepared statement
                    if (mysqli_stmt_execute($stmt)) {
                        echo "Update successfully!";
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close statement
                    mysqli_stmt_close($stmt);
                    goto End;
                }
            }
        }
    }





    // Check input errors before inserting in database
    if (empty($name_err) && empty($surname_err) && empty($address_err) && empty($classification_err) && empty($photo_err) && empty($mobileno_err) && empty($email_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO userdata (id, name, surname, address, classification, photo, email, phone_number) VALUES (?, ?, ?, ?, ?, ?,?,?)";


        if ($stmt = mysqli_prepare($con, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isssssss", $id, $param_name, $param_surname, $param_address, $param_classification, $param_photo, $param_email, $param_PhoneNo);

            // Set parameters
            $param_name = $name;
            $param_surname = $surname;
            $param_address = $address;
            $param_classification = $classification;
            $param_photo = $photo_name;
            $param_email = $email;
            $param_PhoneNo = $mobileno;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                echo "Data uploaded successfully!";
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    End:
    mysqli_close($con);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            width: 100%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input[type="text"],
        .form-group input[type="file"],
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .form-group .invalid-feedback {
            color: #dc3545;
        }
    </style>
</head>

<body>
    <a href="index.php" style="
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


    <div class="form-container">
        <h2>Upload Your Data</h2>

        <div class="image-preview">
            <?php if ($photo == ""): ?>
                                                                    <img src="img/temp.jpg" alt="Photo Preview"
                                                                        style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">

            <?php else: ?>
                                                                    <img src="uploads/<?php echo $photo; ?>" alt="Photo Preview"
                                                                        style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">

            <?php endif; ?>
        </div>



        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            enctype="multipart/form-data">
            <div class="form-group" style="padding-top: 30px;">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $name; ?>"
                    class="<?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>">
                <div class="invalid-feedback"><?php echo $name_err; ?></div>
            </div>
            <div class="form-group">
                <label>Surname</label>
                <input type="text" name="surname" value="<?php echo $surname; ?>"
                    class="<?php echo (!empty($surname_err)) ? 'is-invalid' : ''; ?>">
                <div class="invalid-feedback"><?php echo $surname_err; ?></div>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $email; ?>"
                    class="<?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>">
                <div class="invalid-feedback"><?php echo $email_err; ?></div>
            </div>

            <div class="form-group">
                <label>Phone no.</label>
                <input type="text" name="mobileno" value="<?php echo $mobileno; ?>"
                    class="<?php echo (!empty($mobileno_err)) ? 'is-invalid' : ''; ?>">
                <div class="invalid-feedback"><?php echo $mobileno_err; ?></div>
            </div>

            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" value="<?php echo $address; ?>"
                    class="<?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>">
                <div class="invalid-feedback"><?php echo $address_err; ?></div>
            </div>
             <div class="form-group">
                <label for="classification">Classification</label>
                <select name="classification" id="classification"
                    class="form-control <?php echo (!empty($classification_err)) ? 'is-invalid' : ''; ?>">
                    <option value="">Select Classification</option>

                        <?php
                        // Query to fetch data from the 'catagory' table
                        $sqlcat = "SELECT * FROM catagory";
                        $resultCat = mysqli_query($con, $sqlcat);

                        // Check if there are any records
                        if (mysqli_num_rows($resultCat) > 0) {
                            while ($rowCat = mysqli_fetch_assoc($resultCat)) {
                                // Output each option with the value from the database
                                $catName = $rowCat['catName'];

                                // Check if the current category is selected
                                $selected = ($classification == $catName) ? 'selected' : '';

                                echo '<option value="' . $catName . '" ' . $selected . '>' . $catName . '</option>';
                            }
                        } else {
                            echo '<option value="">No categories available</option>';
                        }
                        ?>
                    <option value="NotActive" <?php echo ($classification == 'NotActive') ? 'selected' : ''; ?>>NotActive
                    </option>
                </select>
                <div class="invalid-feedback"><?php echo $classification_err; ?></div>
            </div>

            <div class="form-group">
                <label>Photo</label>
                <input type="file" name="photo" class="<?php echo (!empty($photo_err)) ? 'is-invalid' : ''; ?> "
                    value="uploads/<?php echo $photo ?>">
                <div class="invalid-feedback"><?php echo $photo_err; ?></div>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit"><a href="Logout.php" class="btn btn-primary"
                    style="float: right;">Logout</a>

            </div>
        </form>
    </div>
</body>

</html>