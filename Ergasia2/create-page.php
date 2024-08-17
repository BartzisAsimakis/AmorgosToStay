<?php
session_start();

// Check if the redirection has already occurred
if (!isset($_SESSION['redirected'])) {
    // Set the session variable to indicate that redirection has occurred
    $_SESSION['redirected'] = true;

    // Check if the user is logged in and session exists
    if (isset($_SESSION['username'])) {
        // The user is logged in, session exists
        header("Location: create-page.php");
        die;
    } else {
        // The user is not logged in or session does not exist
        // Redirect to login page
        header("Location: login.html");
        die;
    }
}

// If redirection has already occurred, continue with the rest of the script
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amorgos-rooms</title>
    <link rel="stylesheet" href="styles/createPage.css">
    <link href="https://fonts.cdnfonts.com/css/vag-handwritten" rel="stylesheet">
    <script src="scripts/greekToGreeklish.js"></script>


    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set the initial value of roomsName to be the same as name
            document.getElementById('roomsName').value = document.getElementById('name').value;
        });
    </script>
</head>

<body>
    <div class="container bg-image">
        <header>
            <h1><a href="index.php" class="logo">Amorgos Rooms</a></h1>
            <h2>ΔΗΜΙΟΥΡΓΙΑ ΣΕΛΙΔΑΣ ΚΑΤΑΛΥΜΑΤΟΣ</h2>
        </header>
        <main>
            <section class="create-form">
                <form action="submitCreatePage.php" method="post" enctype="multipart/form-data" onsubmit="convertTitleToGreeklish()">
                    <label for="name">Επωνυμία Επιχείρησης:</label><br><br>
                    <input type="text" id="name" name="name" onchange = "document.getElementById('roomsName').value = this.value;">

                    <label for="message">Περιγραφή δωματίων:</label><br><br>
                    <textarea id="message" name="message" rows="10" placeholder = "Περιγραφή δωματίων" required></textarea>
                    <input type="hidden" id="greeklishName" name="greeklishName">

                    <label for="tel" class="required">Τηλέφωνο Επικοινωνίας</label><br><br>
                    <input type="tel" id="tel" name="tel" readonly >

                    <label for="email">Email:</label><br><br>
                    <input type="email" id="email" name="email" readonly>

                    <label for="mob" class="required">Κινητό Τηλέφωνο</label><br><br>
                    <input type="tel" id="mob" name="mob" required>

                    <label for="image">Φωτογραφία καταλύματος:</label><br><br>
                    <input type="file" id="image" name="image" accept="media/images/*" onchange = "document.getElementById('roomsPhoto').value = this.accept"><br><br>

                    <button type="submit"  id="buttForm"  style="margin-bottom: 1em;">Ready!</button>
                </form>
            </section>
            <section class="url-form">

                <div>
                    <h2>ΣΥΝΔΕΣΗ ΜΕ ΥΠΑΡΧΟΥΣΑ ΣΕΛΙΔΑ</h2>
                </div>
                <form action="storeUrl.php" method="post" enctype="multipart/form-data">
                    <input type="text" id="roomsName" name="roomsName" style="display: block;">
                    <input type="text" id="roomsPhoto" name="roomsPhoto" style="display: none;">

                    <label for="homepage">Επιλέξτε την σελίδα σας:</label><br>
                    <input type="url" id="url" name="url" disabled><br><br>

                    <label for="imageB" id="labelPhoto" style="display: none;">Επιλέξτε φωτογραφία (thumbnail) για τον σύνδεσμο σας: </label><br><br>
                    <input type="file" id="imageB" name="imageB" accept="media/images/*">

                    <input type="checkbox" id="urlBox" class="largerCheckbox" style="width: 10%;" name="checkbox" onchange="document.getElementById('url').disabled = !this.checked;
                        document.getElementById('buttonUrl').disabled = !this.checked;">
                    <label for="checkbox">Επιθυμώ σύνδεση στο παραπάνω URL</label><br><br>

                    <button type="submit" id="buttonUrl" disabled>Ready!</button>
                </form>
                <?php echo('<script>document.getElementById("imageB")</script>');?>
            </section>

        </main>
        <script src="scripts/createPage.js"></script>
        <script src="scripts/fillCreatePage.js"></script>
        <footer>© 2024 Create Form<span style="float: right;">Project by Bartzis Asimakis</span></footer>
    </div>

</body>

</html>

