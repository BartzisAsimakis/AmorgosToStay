<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amorgos-rooms</title>

    <link rel="stylesheet" href="./styles/gridRes.css">
    <link href="https://fonts.cdnfonts.com/css/vag-handwritten" rel="stylesheet">


</head>

<body>



    <header>
        <div class="row">
            <div class="col-s-12 col-m-12 col-l-12">
                <div class="bg-image"><img src="../media/images/mainPic2.jpg" alt=""></div>
                <h1>Amorgos Rooms</h1>
                <div class="poem">..."Nα βρεις μιαν άλλη θάλασσα μιαν άλλη απαλοσύνη<br>
                    Nα πιάσεις από τα λουριά του Aχιλλέα τ' άλογα"...</br><br>Νίκος Γκάτσος (1987) "Αμοργός"</div>
            </div>
        </div>
    </header>

<!--sdfsdfdsfdsfdsf-->

    <div class="row">
        <div class="col-s-12 col-m-3 col-l-3 menu">
            <ul id="list">
                <li><a href="login.html">ΕΙΣΟΔΟΣ</a></li>
                <li><a href="find-a-room.php">ΒΡΕΣ ΚΑΤΑΛΥΜΑ</a></li>
                <li><a href="sign-up.html">ΝΕΟ ΚΑΤΑΛΥΜΑ - ΕΓΓΡΑΦΗ</a></li>
                <li><a href="more.html">ΠΕΡΙΣΣΟΤΕΡΑ</a></li>
            </ul>
        </div>


        <div class="col-s-12 col-m-5 col-l-5">
            <div id="text">


                <p>
                <h2>Διαμονή στην Αμοργό - Καταλύματα</h2>Οργανώστε το ταξίδι σας επιλέγοντας από τα καλύτερα καταλύματα στην Αμοργό. Εδώ έχετε την ευκαιρία να ενημερωθείτε για τις διαθέσιμες επιλογές
                καταλυμάτων ανά περιοχή, αλλά και για τις παροχές τους. Στη σελίδα μας μπορείτε να σχεδιάσετε το ταξίδι σας με κάθε λεπτομέρεια καθώς έχετε την
                ευκαιρία, εκτός από τα καταλύματα, να ανακαλύψετε δραστηριότητες και πολιτιστικά δρώμενα, μέρη για διασκέδαση, εστίαση κτλ. Επίσης εάν είστε
                ιδιοκτήτης καταλύματος μπορείτε να διαφημίσετε την επιχείρησή σας κάνοντας χρήση της σχετικής φόρμας που σας παρέχουμε.</p>
            </div>

            <div id="side-img">
                <img src="media/images/fotoBar1.gif" id="caseImg" alt="amor45">
            </div>
        </div>

        <div class="col-s-12 col-m-4 col-l-4">
            <div id="side-img">
                <img src="media/images/amorgosMain.jpg" alt="amorgosMain">
            </div>
        </div>
    </div>


    <div class="footer">&#169; Copyright 2024
        <span style="float: right;">Project by     Mirakian - Bartzis - Poulitsis</span>
    </div>

    <?php
    if (isset($_SESSION['username']) && isset($_SESSION['accepted'])) {
        $user = $_SESSION['username'];
        echo    "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var ul = document.getElementById('list');
                        if (ul) {
                            var li = document.createElement('li');
                            var a = document.createElement('a');
                            a.href = 'create-page.php';
                            a.textContent = 'ΔΗΜΙΟΥΡΓΙΑ ΣΕΛΙΔΑΣ';
                            li.appendChild(a);
                            ul.appendChild(li);
                        } else {
                            console.error('Element with ID \'list\' not found.');
                        }
                        var li = document.createElement('li');
                        var a = document.createElement('a');
                        a.href = 'user.php';
                        a.textContent = 'ΕΠΕΞΕΡΓΑΣΙΑ ΠΡΟΦΙΛ: $user';
                        li.appendChild(a);
                        ul.appendChild(li);

                        var li = document.createElement('li');
                        var a = document.createElement('a');
                        a.href = 'scripts/logout.php';
                        a.textContent = 'ΕΞΟΔΟΣ';
                        li.appendChild(a);
                        ul.appendChild(li);
                    });
                </script>";
    }
    if (isset($_SESSION['admin'])) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var ul = document.getElementById('list');
                    if (ul) {
                        var li = document.createElement('li');
                        var a = document.createElement('a');
                        a.href = 'admin_table.php';
                        a.textContent = 'ΔΙΑΧΕΙΡΙΣΗ';
                        li.appendChild(a);
                        ul.appendChild(li);

                        var li = document.createElement('li');
                        var a = document.createElement('a');
                        a.href = 'scripts/logout.php';
                        a.textContent = 'ΕΞΟΔΟΣ';
                        li.appendChild(a);
                        ul.appendChild(li);
                    } else {
                        console.error('Element with ID \'list\' not found.');
                    }
                });
            </script>";
    }
    ?>
</body>

</html>

