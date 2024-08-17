<?php
$uname = $_POST['uname'];
$pass = $_POST['pwd'];
$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$bname = $_POST['name'];
$tel = $_POST['tel'];

$accomName = $_POST['name'];
$mobile = $_POST['mob'];
$addr = $_POST['address'];
$area = $_POST['area'];

require("./credentials.php");

$con = mysqli_connect($host, $username, $password);
if (!$con) {
    echo "problem in the connection" . mysqli_connect_error();
    exit();
} else {
    mysqli_select_db($con, $db_name);
    $query = "INSERT INTO users(username, passwd, email, fname, lname, bname, tel, `status`)
VALUES ('$uname', '$pass', '$email', '$fname', '$lname', '$bname', '$tel', 'pending')";
    mysqli_query($con, $query);

    $query = "INSERT INTO accommodations(username, accomName, mobile, `address`, area)
VALUES ('$uname', '$accomName', '$mobile', '$addr', '$area')";
    mysqli_query($con, $query);

    $query = "INSERT INTO pages(accomName)
    VALUES ('$accomName')";
        mysqli_query($con, $query);

    $message = "Hello '$fname' your registration has been approved!!!\n Keep browsing 😉";
    mail($email, "Registration Approval", $message);
    header("Location: ../index.php");
}
mysqli_close($con);
