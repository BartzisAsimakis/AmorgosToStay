<?php
session_start();
require("scripts/credentials.php");
$con = mysqli_connect($host, $username, $password, $db_name);

if (!$con) {
    die("connection Error");
}

$user = null;
$error = null;
$success = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $query = "SELECT * FROM admins WHERE  username = '$username'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
    } else {
        $error = "Username not found or does not match your profile.";
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fname'])) {
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $username = mysqli_real_escape_string($con, $_POST['username_hidden']); // Hidden field to store the username

    $update_query = "UPDATE admins SET fname='$fname', lname='$lname', passwd='$password', email='$email' WHERE username = '$username'";
    $update_result = mysqli_query($con, $update_query);

    if ($update_result) {
        // Send email notification
        $to = $email;
        $subject = "Profile Updated";
        $message = "Dear $fname,\n\nYour profile has been successfully updated.\n\nBest regards,\nYour Team";
        $headers = "From: no-reply@yourdomain.com";

        mail($to, $subject, $message, $headers);

        $success = "Your profile has been updated successfully.";
        header("Location: admin_table.php");
        exit();
    } else {
        $error = "Error updating profile: " . mysqli_error($con);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/edit_profile.css">
    <title>Edit Profile</title>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card mt-5 mx-auto"   style="width: 120%;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="admin_table.php"><img src="media/images/cancel-icon.svg" alt=""></a>
                        <p><h2 class="display-6">Edit Profile</h2></p>
                    </div>
                    <div class="card-body">
                        <?php if ($error) : ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <?php if ($success) : ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>
                        <?php if (!$user) : ?>
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label for="username">Enter Username</label>
                                    <input type="text" id="username" name="username" class="form-control" style="width: 93%;" required>
                                </div>
                                <button type="submit"  class="btn-primary"  style="margin-left: 36%;">Submit</button>
                            </form>
                        <?php else : ?>
                            <form method="POST" action="">
                                <input type="hidden" name="username_hidden" value="<?php echo $user['username']; ?>">
                                <div class="form-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" id="fname" name="fname" class="form-control" value="<?php echo $user['fname']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" id="lname" name="lname" class="form-control" value="<?php echo $user['lname']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" value="<?php echo $user['passwd']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
