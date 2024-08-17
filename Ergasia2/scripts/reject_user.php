<?php
require("./credentials.php");

$con = mysqli_connect($host, $username, $password, $db_name);

if (!$con) {
    die("connection Error");
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "UPDATE users SET status='rejected' WHERE id=$id";
    if (mysqli_query($con, $query)) {
        $userQuery = "SELECT email FROM users WHERE id=$id";
        $userResult = mysqli_query($con, $userQuery);
        $user = mysqli_fetch_assoc($userResult);
        $to = $user['email'];
        $subject = "Απόρριψη εγγραφής στην πλατφόρμα Amorgos-rooms";
        $message = "Αγαπητέ χρήστη,\n\nΛυπούμαστε να σας ενημερώσουμε ότι η εγγραφή σας στην πλατφόρμα Amorgos-rooms δεν έγινε αποδεκτή.\n\nΜε εκτίμηση,\nΗ ομάδα του Amorgos-rooms";
        $headers = "From: no-reply@amorgos-rooms.com";

        mail($to, $subject, $message, $headers);
        header('Location: ../admin_table.php');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
