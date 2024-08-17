const Areas = Object.freeze({
    Chora: "Χώρα",
    Katapola: "Κατάπολα",
    Aigiali: "Αιγιάλη",
    Arkesini: "Αρκεσίνη",
    KatoMeria: "Κάτω Μεριά",
});

const entName = document.getElementById("name");
const area = document.getElementById("area");
const fname = document.getElementById("fname");
const lname = document.getElementById("lname");
const address = document.getElementById("address");
const tel = document.getElementById("tel");
const email = document.getElementById("email");
const mobile = document.getElementById("mob");
const username = document.getElementById("uname");
const password = document.getElementById("pwd");
const confirmPass = document.getElementById("cpwd");

entName.addEventListener("blur", () => {
    const entNameValue = entName.value;
    if (entNameValue.length == 0) {
        document.getElementById("name").value = "";
        document.getElementById("name").style.backgroundColor = "yellow";
        document.getElementById("name").focus();
        document.getElementById("name").placeholder =
            "Η επωνυμία της επιχείρησης πρέπει να περιέχει τουλάχιστον ένα χαρακτήρα.";
    } else {
        document.getElementById("name").style.backgroundColor = "white ";
        document.getElementById("name").placeholder = "";
    }
});

area.addEventListener("blur", () => {
    const areaValue = area.value;
    if (
        areaValue !== Areas.Chora &&
        areaValue !== Areas.Katapola &&
        areaValue !== Areas.Aigiali &&
        areaValue !== Areas.Arkesini &&
        areaValue !== Areas.KatoMeria
    ) {
        document.getElementById("area").value = "";
        document.getElementById("area").style.backgroundColor = "yellow";
        document.getElementById("area").focus();
        document.getElementById("area").placeholder = "Δώστε έγκυρο νομό.";
    } else {
        document.getElementById("lname").style.backgroundColor = "white ";
        document.getElementById("lname").placeholder = "";
    }
});

fname.addEventListener("blur", () => {
    const fnameValue = fname.value;
    if (hasNumber(fnameValue) || fnameValue.length == 0) {
        document.getElementById("fname").value = "";
        document.getElementById("fname").style.backgroundColor = "yellow";
        document.getElementById("fname").focus();
        document.getElementById("fname").placeholder = "Δώστε έγκυρο όνομα.";
    } else {
        document.getElementById("fname").style.backgroundColor = "white ";
        document.getElementById("fname").placeholder = "";
    }
});

lname.addEventListener("blur", () => {
    const lnameValue = lname.value;
    if (hasNumber(lnameValue) || lnameValue.length == 0) {
        document.getElementById("lname").value = "";
        document.getElementById("lname").style.backgroundColor = "yellow";
        document.getElementById("lname").focus();
        document.getElementById("lname").placeholder = "Δώστε έγκυρο επίθετο.";
    } else {
        document.getElementById("lname").style.backgroundColor = "white ";
        document.getElementById("lname").placeholder = "";
    }
});

address.addEventListener("blur", () => {
    const addressValue = address.value;
    if (addressValue < 1) {
        document.getElementById("address").value = "";
        document.getElementById("address").style.backgroundColor = "yellow";
        document.getElementById("address").focus();
        document.getElementById("address").placeholder =
            "Δώστε έγκυρη διεύθυνση.";
    } else {
        document.getElementById("address").style.backgroundColor = "white ";
        document.getElementById("address").placeholder = "";
    }
});

tel.addEventListener("blur", () => {
    const telValue = tel.value;
    if (telValue.length != 10) {
        document.getElementById("tel").value = "";
        document.getElementById("tel").style.backgroundColor = "yellow";
        document.getElementById("tel").focus();
        document.getElementById("tel").placeholder = "Δώστε έγκυρο τηλέφωνο.";
    } else {
        document.getElementById("tel").style.backgroundColor = "white ";
        document.getElementById("tel").placeholder = "";
    }
});

email.addEventListener("blur", () => {
    const emailValue = email.value;
    if (!isValidEmail(emailValue)) {
        document.getElementById("email").value = "";
        document.getElementById("email").style.backgroundColor = "yellow";
        document.getElementById("email").focus();
        document.getElementById("email").placeholder = "Δώστε έγκυρο email.";
    } else {
        document.getElementById("email").style.backgroundColor = "white ";
        document.getElementById("email").placeholder = "";
    }
});

mobile.addEventListener("blur", () => {
    const mobileValue = mobile.value;
    if (mobileValue.length != 10) {
        document.getElementById("mob").value = "";
        document.getElementById("mob").style.backgroundColor = "yellow";
        document.getElementById("mob").focus();
        document.getElementById("mob").placeholder =
            "Ο αριθμός κινητού σας θα πρέπει να έχει 10 ψηφία.";
    } else {
        document.getElementById("mob").style.backgroundColor = "white ";
        document.getElementById("mob").placeholder = "";
    }
});

username.addEventListener("blur", () => {
    const usernameValue = username.value;
    if (!isUserNameValid(usernameValue)) {
        document.getElementById("uname").value = "";
        document.getElementById("uname").style.backgroundColor = "yellow";
        document.getElementById("uname").focus();
        document.getElementById("uname").placeholder =
            "Μη έγκυρο όνομα χρήστη.";
    } else {
        document.getElementById("uname").style.backgroundColor = "white ";
        document.getElementById("uname").placeholder = "";
        fetch("http://localhost/Ergasia2/scripts/check-user.php", {
           method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `uname=${encodeURIComponent(usernameValue)}`,
        }).then((response) => {
                if (!response.ok) {
                    throw new Error(
                        "Network response was not ok " + response.statusText
                    );
                }
                return response.json();
            })
            .then((data) => {
                if (data.exists) {
                    document.getElementById("uname").value = "";
                    document.getElementById("uname").style.backgroundColor =
                        "yellow";
                    document.getElementById("uname").focus();
                    document.getElementById("uname").placeholder =
                        "Ο χρήστης ήδη υπάρχει.";
                }
            })
            .catch((error) => {
                console.error(
                    "There was a problem with the fetch operation:",
                    error
                );
            });

    }
});

password.addEventListener("blur", () => {
    const passwordValue = password.value;
    if (!hasNumber(passwordValue)) {
        document.getElementById("cpwd").value = "";
        document.getElementById("cpwd").style.backgroundColor = "yellow";
        document.getElementById("cpwd").focus();
        document.getElementById("cpwd").placeholder =
            "Το συνθηματικό σας πρέπει να περιέχει τουλάχιστον έναν αριθμό.";
    } else {
        document.getElementById("cpwd").style.backgroundColor = "white ";
        document.getElementById("cpwd").placeholder = "";
    }
});

confirmPass.addEventListener("blur", () => {
    const passwordValue = password.value;
    const confirmPassValue = confirmPass.value;
    if (passwordValue !== confirmPassValue) {
        document.getElementById("cpwd").value = "";
        document.getElementById("cpwd").style.backgroundColor = "yellow";
        document.getElementById("cpwd").focus();
        document.getElementById("cpwd").placeholder =
            "Επιβεβαιώστε το σωστό συνθηματικό.";
    } else {
        document.getElementById("cpwd").style.backgroundColor = "white ";
        document.getElementById("cpwd").placeholder = "";
    }
});

function isValidEmail(email) {
    // Regular expression for validating an Email
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // Test the email against the regular expression
    return emailRegex.test(email);
}

function hasNumber(myString) {
    return /\d/.test(myString);
}

function isUserNameValid(username) {
    /*
      Usernames can only have:
      - Lowercase Letters (a-z)
      - Numbers (0-9)
      - Dots (.)
      - Underscores (_)
    */
    const res = /^[a-z0-9_\.]+$/.exec(username);
    const valid = !!res;
    return valid;
}
