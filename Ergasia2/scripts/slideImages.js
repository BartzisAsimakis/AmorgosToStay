// Κώδικας JavaScript για το slideshow
let slideIndex = 1;
showSlides();

function showSlides(n) {
let slides = document.getElementsByClassName("mySlides");
if (n < 1) {slideIndex = slides.length}
if (n > slides.length) {slideIndex = 1}
for (let i = 0; i < slides.length; i++) {
  slides[i].style.display = "none";  
}
slides[slideIndex-1].style.display = "block";  
}

function plusSlides(n) {
showSlides(slideIndex += n);
}