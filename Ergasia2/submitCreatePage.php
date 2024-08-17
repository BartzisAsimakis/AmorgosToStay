<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim(htmlspecialchars($_POST['name']));
    $greeklishName = trim(htmlspecialchars($_POST['greeklishName']));
    $message = trim(htmlspecialchars($_POST['message']));
    $tel = trim(htmlspecialchars($_POST['tel']));
    $email = trim(htmlspecialchars($_POST['email']));
    $mob = trim(htmlspecialchars($_POST['mob']));

    // Έλεγχος αν έχει ανέβει αρχείο
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $uploadDir = 'media/images/';
        $uploadFile = $uploadDir . $imageName;

        // Δημιουργία του καταλόγου αν δεν υπάρχει
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Μετακίνηση του αρχείου στον προορισμό
        if (move_uploaded_file($imageTmpName, $uploadFile)) {
            $imageURL = $uploadFile;
        } else {
            echo "Error uploading the image.";
            exit;
        }
    } else {
        $imageURL = '';
    }
    $imageURL = "../" . $imageURL;

    // Δημιουργία του περιεχομένου του νέου αρχείου HTML
    $newHtmlContent = "<!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>$greeklishName</title>
        <link rel='stylesheet' href='../styles/roomPages.css'>
    </head>
    <body>
        <header id='greekTitle'>$name</header>
        <p id='text'><img src='$imageURL' alt='Εικόνα' id='image'>
        <b></b>$message</p>
        <p id='text'>Η Αμοργός είναι κυκλαδίτικο νησί του Αιγαίου πελάγους. Πήρε το όνομά της από το φυτό αμοργίς, ένα είδος λιναριού από το οποίο φτιάχνονταν οι «άλικοι αμοργίδες», χιτώνες της Αμοργού. Βρίσκεται στο νοτιοανατολικό άκρο των Κυκλάδων, νοτιοανατολικά της Νάξου και σε απόσταση 136 ναυτικών μιλίων από τον Πειραιά. Η επιφάνειά της εκτιμάται στα 121,464 τ.χλμ., ενώ έχει μήκος ακτών 126 χιλιόμετρα. Είναι μακρόστενο νησί που εκτείνεται από ΝΔ προς ΒΑ με απότομη ορεινή μορφολογία εδάφους. Διαθέτει δύο φυσικά λιμάνια, τα Κατάπολα και την Αιγιάλη. Πρωτεύουσα είναι η Χώρα Αμοργού με κύριο λιμάνι τα Κατάπολα.
        Ολόκληρος ο δήμος της Αμοργού είχε πληθυσμό 1.961 άτομα[1] στην απογραφή του 2021. Οι κάτοικοι ασχολούνται παραδοσιακά με τη γεωργία, την κτηνοτροφία, την αλιεία καθώς και με τα ναυτικά επαγγέλματα. Πολλοί κάτοικοι ασχολούνταν από τα παλιά χρόνια με τον κλάδο της μελισσουργίας. Τα τελευταία χρόνια ασχολούνται και με τον τομέα του τουρισμού ο οποίος αναπτύσσεται με ραγδαίο ρυθμό.
        Η Αμοργός αποτελεί ιδανικό προορισμό για πεζοπορία. Υπάρχουν μονοπάτια που ξεκινούν ή/και καταλήγουν σε κάποιον οικισμό και προσφέρουν στον επισκέπτη εκπληκτικές εικόνες φυσικού τοπίου.</p>
        <p id='text'>Από τα τέλη της 4ης χιλιετίας π.Χ. υπάρχουν ίχνη ανθρώπινης παρουσίας στην Αμοργό. Κατά την αρχαιότητα η Αμοργός γίνεται ένα από τα σημαντικότερα κέντρα του κυκλαδικού πολιτισμού. Αργότερα, κατά τη μινωική εποχή, καταφθάνουν στο νησί πολλοί Μινωίτες ιδρύοντας μία από τις πρώτες πόλεις του νησιού, τη Μινώα. Αργότερα, Ναξιώτες ιδρύουν την Αρκεσίνη, στη σημερινή περιοχή Καστρί και την ίδια εποχή Μιλήσιοι εγκαθίστανται στην Αιγιάλη, κοντά στο σημερινό χωριό Θολάρια. Αυτές ήταν κατά την αρχαιότητα οι σπουδαιότερες πόλεις του νησιού. Στους ρωμαϊκούς χρόνους θα είναι τόπος εξορίας: επί Τιβερίου, το 23 μ.Χ. θα εξοριστεί ο Βέβιος Σειρήνος, ανθύπατος της Ισπανίας.[2][3] Τα βυζαντινά χρόνια δέχεται επιδρομές Πειρατών ενώ ιδρύεται η μονή της Παναγίας της Χοζοβιώτισσας. Το 1207 την καταλαμβάνει ο Μάρκος Σανούδος και ξεκινά η περίοδος της λατινοκρατίας έως το 1537 οπότε επέδραμε ο Χαϊρεντίν Μπαρμπαρόσα και την έθεσε υπό οθωμανική κυριαρχία (1537-1824). Οι Αμοργιανοί ασκούσαν την πειρατεία συστηματικά. Το νησί έχει την ιδιαιτερότητα να διατηρεί μεγάλο πλήθος επιφανών βυζαντινών επωνύμων. Μετά την επανάσταση του 1821 ενσωματώθηκε στο νεοσύστατο ελληνικό κράτος ενώ λίγα χρόνια αργότερα η Αμοργός χρησιμοποιήθηκε πάλι ως τόπος εξορίας. Την περίοδο της κατοχής από τις δυνάμεις του Άξονα εντάσσεται αρχικά στην ιταλική διοίκηση ενώ από το 1943 τη διαδέχεται η γερμανική έως την απελευθέρωση το 1944. Η φήμη του νησιού εκτοξεύτηκε με την προβολή της ταινίας Απέραντο γαλάζιο (Le Grand Bleu) σε σκηνοθεσία του Λικ Μπεσόν η οποία γυρίστηκε κατά μεγάλο μέρος στην Αμοργό. Η Αμοργός αποτέλεσε και το πρώτο μέρος στην Ευρώπη που φιλοξένησε διεθνή κινηματογραφική παραγωγή, μετά την παγκόσμια πανδημία του κορονοϊού το 2020.[4]</p>
        <div id='bar'><img src='./media/images/bar1b.gif' alt='' width='100%'></div>
        <div class='section-container'>
          <div class='section'>
            <img src='../media/images/tel.gif' alt='Εικόνα 1'>$tel</div>
          <div class='section'>
            <img src='../media/images/mob.gif' alt='Εικόνα 2'>$mob</div>
          <div class='section'>
            <img src='../media/images/mail.gif' alt='Εικόνα 3'>$email</div>
        </div>
        <div class='footer'>&#169; Copyright 2024
        <span style='float: right;'>Project by Mirakian - Bartzis - Poulitsis</span>
    </div>
    </body>
    </html>";

    // Ορισμός του ονόματος του νέου αρχείου σε Greeklish
    $newFileName = "roomsPages/" . $greeklishName . ".html";

    // Αποθήκευση του περιεχομένου σε ένα νέο αρχείο HTML
    file_put_contents($newFileName, $newHtmlContent);

    echo "New HTML file has been created: <a href='$newFileName'>" . $newFileName . "</a>";

    $imageURL = trim(str_replace("../", "", $imageURL));
    // Στοιχεία σύνδεσης στη βάση δεδομένων
    require("scripts/credentials.php");

    $con = mysqli_connect($host, $username, $password);
    if (!$con) {
        echo "Πρόβλημα στη σύνδεση: " . mysqli_connect_error();
        exit();
    } else {
        mysqli_select_db($con, $db_name);

        // Διαφυγή ειδικών χαρακτήρων στις εισαγόμενες τιμές για την αποτροπή SQL injection
        $name = mysqli_real_escape_string($con, $name);
        $url = mysqli_real_escape_string($con, $imageURL);

        // Διόρθωση του συντακτικού για το SQL query
        $query = "UPDATE pages
                  SET `url` = '$newFileName'
                  WHERE accomName = '$name';";
        mysqli_query($con, $query);

        $query2 = "UPDATE pages
                   SET `photo` = '$url'
                   WHERE accomName = '$name';";


        // Εκτέλεση του query και έλεγχος για λάθη
        if (mysqli_query($con, $query2)) {
            $message = "Γειά σου $name, η σελίδα σου έχει εγκριθεί!!!\n ;)";
            mail($email, "Έγκριση νέας σελίδας", $message);
            header("Location:create-page.php");
            exit();
        } else {
            echo "Σφάλμα: " . $query2 . "<br>" . mysqli_error($con);
        }

        // Κλείσιμο της σύνδεσης με τη βάση δεδομένων
        mysqli_close($con);
    }

    echo "New HTML file has been created: <a href='$newFileName'>".$newFileName."</a>";
}
?>


