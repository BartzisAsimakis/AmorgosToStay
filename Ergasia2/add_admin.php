<?php
session_start();
require("scripts/credentials.php");

$con = mysqli_connect($host, $username, $password, $db_name);

if (!$con) {
    die("connection Error");
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Check for the uniqueness of the username
    $check_query = "SELECT * FROM admins WHERE username='$username' OR email = '$email'";;
    $check_result = mysqli_query($con, $check_query);

    // check if the username already exists in the users table
    $check_query_users = "SELECT * FROM users WHERE username='$username' OR email = '$email'";
    $check_result_users = mysqli_query($con, $check_query_users);

    if (mysqli_num_rows($check_result) > 0 || mysqli_num_rows($check_result_users) > 0) {
        echo "Username or Email already exists as a user. Please use a different one.";
    } else if (mysqli_num_rows($check_result) > 0) {
        echo "Username or Email already exists as an admin. Please use a different one.";
    } else {
        // Insert the new admin into the database
        $insert_query = "INSERT INTO admins (fname, lname, username, passwd, email) VALUES ('$fname', '$lname', '$username', '$password', '$email')";
        $insert_result = mysqli_query($con, $insert_query);
        if ($insert_result) {
            // Send email notification
            $subject = "New Administrator Account Created";
            $message = "Dear $fname,\n\nYour administrator account has been successfully created with the following details:\n\nUsername: $username\nPassword: $password\nEmail: $email\n\nBest regards,\nYour Team";
            $headers = "From: no-reply@amorgos-rooms.com";

            mail($email, $subject, $message, $headers);

            echo "<script>alert('Administrator added successfully.');</script>";
            header("Location: admin_table.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/add_admin.css">
    <title>Add Administrator</title>
</head>

<body>

    <div class="container">

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">
                 <a href="admin_table.php"><img src="media/images/cancel-icon.svg" alt=""></a>
                 <h2 class="display-6">Add Administrator</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Administrator</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
