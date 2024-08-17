let currentDate = new Date();

let currentDay = currentDate.getDate();
let currentMonth = currentDate.getMonth() + 1; // Month is zero-indexed
let currentYear = currentDate.getFullYear();

console.log(currentYear);

if (currentDay < 10) {
    currentDay = "0" + currentDay; // Adding a leading zero
}

if (currentMonth < 10) {
    currentMonth = "0" + currentMonth; // Adding a leading zero
}

let wholeDate = currentYear + "-" + currentMonth + "-" + currentDay;

setCurrentDate("date1", wholeDate);
setCurrentDate("date2", wholeDate);

function setCurrentDate(id, wholeDate) {
    let element = document.getElementById(id);

    if (element.hasAttribute("min")) {
        element.setAttribute("min", wholeDate);
    }
}
