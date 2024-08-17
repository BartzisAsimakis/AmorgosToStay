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
<link href="styles/user.css" rel="stylesheet">
<title>Amorgos-rooms</title>
<link href="https://fonts.cdnfonts.com/css/vag-handwritten" rel="stylesheet">
</head>
<body>
<header>
            <h1><a href="index.php" class="logo">Amorgos Rooms</a></h1>
            <h2>ΕΠΕΞΕΡΓΑΣΙΑ ΣΤΟΙΧΕΙΩΝ ΧΡΗΣΤΗ</h2>
        </header>
<form name="userForm" id="userForm" action="./scripts/change-data.php" method="post">
    <label for="firstName">Όνομα:</label>
    <input type="text" id="firstName" name="firstName" required>

    <label for="lastName">Επίθετο:</label>
    <input type="text" id="lastName" name="lastName" required>

    <label for="businessName">Επωνυμία Επιχείρησης:</label>
    <input type="text" id="businessName" name="businessName" required>

    <label for="telephone">Τηλέφωνο:</label>
    <input type="text" id="telephone" name="telephone" required>

    <label for="username">Όνομα Χρήστη:</label>
    <input type="text" id="username" name="username" readonly>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Συνθηματικό:</label>
    <input type="password" id="password" name="password" required>

    <label for="password">Επιβεβαίωση Συνθηματικού:</label>
    <input type="password" id="confpassword" name="confpassword" required>

    <input type="submit" id="submit" value="Επιβεβαίωση Αλλαγών">
</form>
<script src="scripts/user.js"></script>
</body>
</html>
