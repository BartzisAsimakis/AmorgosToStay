document.getElementById("fname").onblur = function () {
    let fnameString = document.getElementById("fname").value;
    if (fnameString.length <= 2 && fnameString.length > 0) {
        document.getElementById("fname").value = "";
        document.getElementById("fname").style.backgroundColor = "yellow";
        document.getElementById("fname").focus();
        document.getElementById("fname").placeholder =
            "Περισσότεροι από δύο (2) χαρακτήρες.";
        //document.getElementById('lname').disabled = true;
    } else {
        document.getElementById("fname").style.backgroundColor = "white ";
        document.getElementById("fname").placeholder = "Το όνομα σου..";
        // document.getElementById('lname').disabled = false;
    }
};

document.getElementById("lname").onblur = function () {
    let lnameString = document.getElementById("lname").value;
    if (lnameString.length <= 2 && lnameString.length > 0) {
        document.getElementById("lname").value = "";
        document.getElementById("lname").style.backgroundColor = "yellow";
        document.getElementById("lname").focus();
        document.getElementById("lname").placeholder =
            "Περισσότεροι από δύο (2) χαρακτήρες.";
    } else {
        document.getElementById("lname").style.backgroundColor = "white ";
        document.getElementById("lname").placeholder = "Το επίθετο σου..";
    }
};
document.getElementById("tel").onblur = function () {
    let numOfDigits = document.getElementById("tel").value;
    if (numOfDigits.length < 10 || numOfDigits.length > 15) {
        document.getElementById("tel").value = "";
        document.getElementById("tel").style.backgroundColor = "yellow";
        document.getElementById("tel").focus();
        document.getElementById("tel").placeholder = "10-15 ψηφία";
    } else {
        document.getElementById("tel").style.backgroundColor = "white ";
        document.getElementById("tel").placeholder = "Το τηλέφωνο σου..";
    }
};

document.getElementById("email").onblur = function () {
    let emailString = document.getElementById("email").value;
    var english = /^[A-Za-z0-9]*$/;

    if (!isValidEmail(emailString)) {
        document.getElementById("email").value = "";
        document.getElementById("email").style.backgroundColor = "yellow";
        document.getElementById("email").focus();
        document.getElementById("email").placeholder = "Εισάγετε έγκυρο email";
    } else {
        document.getElementById("email").style.backgroundColor = "white ";
        document.getElementById("email").placeholder = "Το email σου..";
    }
};

//Return the duration between two dates, in number of days.
function diffDates(date1, date2) {
    const startDate = new Date(date1);
    const endDate = new Date(date2);

    const differenceInMilliseconds = endDate - startDate;

    const differenceInDays = differenceInMilliseconds / (1000 * 60 * 60 * 24);

    return Math.floor(differenceInDays);
}

document.getElementById("date2").onblur = function () {
    if (
        diffDates(
            document.getElementById("date1").value,
            document.getElementById("date2").value
        ) < 3
    ) {
        //document.getElementById('date1').value="";
        document.getElementById("date2").style.backgroundColor = "yellow";
        document.getElementById("date2").focus();
        // document.getElementById('date1'). placeholder= "Εισάγετε έγκυρο email";
    } else {
        document.getElementById("date2").style.backgroundColor = "white ";
        //document.getElementById('date1'). placeholder= "Το email σου..";
    }
};

function isValidEmail(email) {
    // Regular expression for validating an Email
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // Test the email against the regular expression
    return emailRegex.test(email);
}

function hasNumber(myString) {
    return /\d/.test(myString);
}

function totalAdultsAndChildren() {
    document.getElementById("people").value =
        document.getElementById("people").value + Number(adults);
}

var sum = 0;
document.getElementById("adults").addEventListener("input", (event) => {
    document.getElementById("people").value = 0;
    sum =
        Number(document.getElementById("adults").value) +
        Number(document.getElementById("children").value);
    document.getElementById("people").value = sum;
});

document.getElementById("children").addEventListener("input", (event) => {
    document.getElementById("people").value = 0;
    sum =
        Number(document.getElementById("adults").value) +
        Number(document.getElementById("children").value);
    document.getElementById("people").value = sum;
    //totalAdultsAndChildren();
});
