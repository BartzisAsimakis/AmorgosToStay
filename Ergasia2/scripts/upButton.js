 // JavaScript για την εμφάνιση/απόκρυψη του κουμπιού "Up"
 var scrollToTopButton = document.querySelector('.scroll-to-top');
    
 // Εμφανίζει ή αποκρύπτει το κουμπί "Up" ανάλογα με τη θέση της κύλισης
 window.addEventListener('scroll', function() {
   if (window.pageYOffset > 100) { // Εμφανίζει το κουμπί μόνο αν η κύλιση είναι πάνω από τα 100 pixels
     scrollToTopButton.style.display = 'block';
   } else {
     scrollToTopButton.style.display = 'none';
   }
 });
 
 // Κώδικας για το κλικ στο κουμπί "Up" για να μετακινηθεί ο χρήστης στην αρχή της σελίδας
 scrollToTopButton.addEventListener('click', function() {
   window.scrollTo({ top: 0, behavior: 'smooth' });
 });