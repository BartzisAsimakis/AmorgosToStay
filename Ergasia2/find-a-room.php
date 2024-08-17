<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amorgos-rooms</title>
    <link rel="stylesheet" href="styles/gridContainer.css">
</head>
<body>
    <div class="searchDataList-container">
        <div class="search">
            <input type="search" name="search bar" id="searchInput" placeholder="search" style="height: 45px;">
        </div>
        <div class="datalist">
            <select id="searchSelect" dir="ltr" style="height: 45px;">
                <option value="Όλες οι περιοχές">Όλες οι περιοχές</option>
                <option value="Χώρα">Χώρα</option>
                <option value="Αιγιάλη">Αιγιάλη</option>
                <option value="Κατάπολα">Κατάπολα</option>
                <option value="Κάτω μεριά">Κάτω μεριά</option>
            </select>
        </div>
    </div>

    <div id="results-container">
<?php
// Στοιχεία σύνδεσης στη βάση δεδομένων
require("scripts/credentials.php");

$con = new mysqli($host, $username, $password, $db_name);

// Έλεγχος σύνδεσης
if ($con->connect_error) {
    die("Σφάλμα σύνδεσης: " . $con->connect_error);
}




// Ερώτημα για την ανάκτηση δεδομένων από τον πίνακα
$sql = "SELECT pages.accomName, area, tel, email, `url`, photo FROM pages,accommodations,users
        WHERE pages.accomName = accommodations.accomName
        AND users.username = accommodations.username";



$result = mysqli_query($con,$sql);

// Έλεγχος αν υπάρχουν αποτελέσματα
if ($result->num_rows > 0) {
    // Διατρέχουμε τα αποτελέσματα και τα προσθέτουμε στον πίνακα HTML
    while($row = $result->fetch_assoc()) {
        echo "<div class='grid-container'>
            <div class='details'>
                <div id='title'>" . htmlspecialchars($row["accomName"]) . "</div>

                <p>" . htmlspecialchars($row["area"]) . "</p>
                <p>Τηλ.: " . htmlspecialchars($row["tel"]) . "</p>
                <p><a href='mailto:" . htmlspecialchars($row["email"]) . "'>email: " . htmlspecialchars($row["email"]) . "</a></p>
                <p><a href='" . 'contact.html' . "'>Επικοινωνήστε απευθείας</a></p>
            </div>";
            if (!empty($row['photo'])) {
                $imagePath = htmlspecialchars($row["photo"]);
            echo "<div class='thumbnail'>
                <img src='$imagePath' alt='εικόνα' onclick='window.location.href=\"" . htmlspecialchars($row["url"]) . "\"'>
            </div>";
        } else {
            echo "<div class='thumbnail'>
                <a href='" . htmlspecialchars($row["url"]) . "'>more..</a>
            </div>";
        }

        echo "</div>";

    }
} else {
    echo "Δεν βρέθηκαν αποτελέσματα";
}

// Κλείσιμο σύνδεσης
$con->close();
?>
    </div>

    <div class="footer">&#169; Copyright 2024
        <span style="float: right;">Project by     Mirakian - Bartzis - Poulitsis</span>
    </div>
    <script src='scripts/filter.js'></script>
</body>
</html>
