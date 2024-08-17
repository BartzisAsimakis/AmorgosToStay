<?php
require("scripts/credentials.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomsName = $_POST['roomsName'];
    $url = $_POST['url'];
    $photo = '';

    if (isset($_FILES['imageB']) && $_FILES['imageB']['error'] == UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['imageB']['tmp_name'];
        $imageName = basename($_FILES['imageB']['name']);
        $uploadDir = 'media/images/';
        $uploadFile = $uploadDir . $imageName;

        // Δημιουργία του καταλόγου αν δεν υπάρχει
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Μετακίνηση του αρχείου στον προορισμό
        if (move_uploaded_file($imageTmpName, $uploadFile)) {
            $photo = $uploadFile;
        } else {
            echo "Error uploading the image.";
            exit;
        }
    } else {
        $photo = '';
    }
    //$photo = "../" . $photo;


    $con = mysqli_connect($host, $username, $password, $db_name);

    if (!$con) {
        echo "Πρόβλημα στη σύνδεση: " . mysqli_connect_error();
        exit();
    }

    // Διαφυγή ειδικών χαρακτήρων στις εισαγόμενες τιμές για την αποτροπή SQL injection
    $roomsName = mysqli_real_escape_string($con, $roomsName);
    $url = mysqli_real_escape_string($con, $url);
    $photo = mysqli_real_escape_string($con, $photo);

    // Ενημέρωση της βάσης δεδομένων
    $query1 = "UPDATE pages SET `url` = '$url' WHERE accomName = '$roomsName';";
    $query2 = "UPDATE pages SET `photo` = '$photo' WHERE accomName = '$roomsName';";

    if (mysqli_query($con, $query1) && mysqli_query($con, $query2)) {
        header("Location: create-page.php");
        exit();
    } else {
        echo "Σφάλμα: " . mysqli_error($con);
    }

    // Κλείσιμο της σύνδεσης με τη βάση δεδομένων
    mysqli_close($con);
}
?>
