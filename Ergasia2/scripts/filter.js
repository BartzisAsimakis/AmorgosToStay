// Αποθηκεύει την αρχική λίστα των grid-containers
const originalGridContainers = Array.from(
    document.querySelectorAll(".grid-container")
);

document
    .getElementById("searchSelect")
    .addEventListener("input", function (event) {
        const searchTerm = event.target.value.toLowerCase();
        console.log(searchTerm);
        const resultsContainer = document.getElementById("results-container");

        // Καθαρίζει τα αποτελέσματα πριν από την εμφάνιση των φιλτραρισμένων
        resultsContainer.innerHTML = "";

        // Προσθέτει τα φιλτραρισμένα αποτελέσματα
        originalGridContainers.forEach(function (container) {
            const text = container.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                resultsContainer.appendChild(container);
            } else if (searchTerm.includes("όλες οι περιοχές")) {
                for (let i = 0; originalGridContainers.length; i++) {
                    resultsContainer.appendChild(originalGridContainers[i]);
                }
            }
        });
    });

// Εφαρμόζει και στο search input
document
    .getElementById("searchInput")
    .addEventListener("input", function (event) {
        const searchTerm = event.target.value.toLowerCase();
        const resultsContainer = document.getElementById("results-container");

        // Καθαρίζει τα αποτελέσματα πριν από την εμφάνιση των φιλτραρισμένων
        resultsContainer.innerHTML = "";

        // Προσθέτει τα φιλτραρισμένα αποτελέσματα
        originalGridContainers.forEach(function (container) {
            const text = container.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                resultsContainer.appendChild(container);
            }
        });
    });
