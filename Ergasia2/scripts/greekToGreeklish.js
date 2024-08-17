function greekToGreeklish(text) {
    var greekLetters = ['α', 'ά', 'β', 'γ', 'δ', 'ε', 'έ', 'ζ', 'η', 'ή', 'θ', 'ι', 'ί', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'ό', 'π', 'ρ', 'σ', 'ς', 'τ', 'υ', 'ύ', 'φ', 'χ', 'ψ', 'ω', 'ώ', 'Α', 'Ά', 'Β', 'Γ', 'Δ', 'Ε', 'Έ', 'Ζ', 'Η', 'Ή', 'Θ', 'Ι', 'Ί', 'Κ', 'Λ', 'Μ', 'Ν', 'Ξ', 'Ο', 'Ό', 'Π', 'Ρ', 'Σ', 'Τ', 'Υ', 'Ύ', 'Φ', 'Χ', 'Ψ', 'Ω', 'Ώ'];
    var greeklishLetters = ['a', 'a', 'v', 'g', 'd', 'e', 'e', 'z', 'i', 'i', 'th', 'i', 'i', 'k', 'l', 'm', 'n', 'x', 'o', 'o', 'p', 'r', 's', 's', 't', 'y', 'y', 'f', 'ch', 'ps', 'o', 'o', 'A', 'A', 'V', 'G', 'D', 'E', 'E', 'Z', 'I', 'I', 'Th', 'I', 'I', 'K', 'L', 'M', 'N', 'X', 'O', 'O', 'P', 'R', 'S', 'T', 'Y', 'Y', 'F', 'Ch', 'Ps', 'O', 'O'];

    var greeklishText = '';
    for (var i = 0; i < text.length; i++) {
        var index = greekLetters.indexOf(text[i]);
        if (index !== -1) {
            greeklishText += greeklishLetters[index];
        } else {
            greeklishText += text[i];
        }
        if (text[i] === " ") {
            greeklishText = greeklishText.replace(" ", "-");
        }
    }
    return greeklishText;
}

function convertTitleToGreeklish() {
    var greekTitle = document.getElementById('name').value;
    var greeklishTitle = greekToGreeklish(greekTitle);
    document.getElementById('greeklishName').value = greeklishTitle;
}
