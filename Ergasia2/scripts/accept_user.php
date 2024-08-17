<?php
require("./credentials.php");

$con = mysqli_connect($host, $username, $password, $db_name);

if (!$con) {
    die("Connection Error: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "UPDATE users SET status='accepted' WHERE id=$id";
    $_SESSION['accepted'] = true;
    if (mysqli_query($con, $query)) {
        $userQuery = "SELECT email FROM users WHERE id=$id";
        $userResult = mysqli_query($con, $userQuery);
        if ($userResult && mysqli_num_rows($userResult) > 0) {
            $user = mysqli_fetch_assoc($userResult);
            $to = $user['email'];
            $subject = "Αποδοχή εγγραφής στην πλατφόρμα Amorgos-rooms";
            $message = "Αγαπητέ χρήστη,\n\nΗ εγγραφή σας στην πλατφόρμα Amorgos-rooms έχει πραγματοποιηθεί επιτυχώς.\n\nΜε εκτίμηση,\nΗ ομάδα του Amorgos-rooms";
            $headers = "From: no-reply@amorgos-rooms.com";

            mail($to, $subject, $message, $headers);
        }
        header('Location: ../admin_table.php');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
mysqli_close($con);
