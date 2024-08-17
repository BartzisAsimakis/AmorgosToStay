var userData = null;
var disableSubmit = null;

function fetchUserData() {
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Initialize the request
    xhr.open("GET", "http://localhost/Ergasia2/scripts/fetch-data.php", true);

    // Send the request
    xhr.send();

    // Set up a function to handle the response data when the request completes
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            // Check if the request is complete
            if (xhr.status === 200) {
                // Check if the request was successful
                try {
                    userData = JSON.parse(xhr.responseText); // Parse the JSON response
                    fillForm(userData); // Call the function to fill the form with the user data
                } catch (e) {
                    console.error(
                        "Failed to parse JSON response: " + e.message
                    );
                }
            } else {
                console.error(
                    "Failed to fetch data: " + xhr.status + " " + xhr.statusText
                );
                // Optionally handle the error in the UI
            }
        }
    };
}

// Example function to fill the form with user data
function fillForm(userData) {
    // Assume userData is an object with keys corresponding to form field IDs
    for (var key in userData) {
        if (userData.hasOwnProperty(key)) {
            var field = document.getElementById(key);
            if (field) {
                field.value = userData[key];
            }
        }
    }
}

function fillForm(userData) {
    document.getElementById("firstName").value = userData[0].fname;
    document.getElementById("lastName").value = userData[0].lname;
    document.getElementById("businessName").value = userData[0].bname;
    document.getElementById("telephone").value = userData[0].tel;
    document.getElementById("username").value = userData[0].username;
    document.getElementById("email").value = userData[0].email;
    document.getElementById("password").value = userData[0].passwd;
    document.getElementById("confpassword").value = userData[0].passwd;
    disableSubmit = new Array(6).fill(true);
    //document.getElementById("submit").setAttribute("disabled", "true");
}

function haveFieldsChanged() {
    for (let i = 0; i < disableSubmit.length; i++) {
        if (disableSubmit[i] === false) {
            return true;
        }
    }
    return false;
}

// Call fetchUserData when the page loads
window.onload = fetchUserData;

document.getElementById("firstName").addEventListener("blur", (event) => {
    const fname = document.getElementById("firstName").value;
    if (fname != userData[0].fname) {
        disableSubmit[0] = false;
        if (hasNumber(fname) || fname.length == 0) {
            document.getElementById("firstName").value = "";
            document.getElementById("firstName").style.backgroundColor =
                "yellow";
            document.getElementById("firstName").focus();
            document.getElementById("firstName").placeholder =
                "Δώστε έγκυρο όνομα.";
        } else {
            document.getElementById("firstName").style.backgroundColor =
                "white ";
            document.getElementById("firstName").placeholder = "";
        }
    }
});

document.getElementById("lastName").addEventListener("blur", (event) => {
    const lname = document.getElementById("lastName").value;
    if (lname !== userData[0].lname) {
        disableSubmit[1] = false;
        if (hasNumber(lname) || lname.length == 0) {
            document.getElementById("lastName").value = "";
            document.getElementById("lastName").style.backgroundColor =
                "yellow";
            document.getElementById("lastName").focus();
            document.getElementById("lastName").placeholder =
                "Δώστε έγκυρο επίθετο.";
        } else {
            document.getElementById("lastName").style.backgroundColor =
                "white ";
            document.getElementById("lastName").placeholder = "";
        }
    }
});

document.getElementById("businessName").addEventListener("blur", (event) => {
    const bname = document.getElementById("businessName").value;
    if (bname !== userData[0].bname) {
        disableSubmit[2] = false;
        if (bname.length == 0) {
            document.getElementById("businessName").value = "";
            document.getElementById("businessName").style.backgroundColor =
                "yellow";
            document.getElementById("businessName").focus();
            document.getElementById("businessName").placeholder =
                "Δώστε έγκυρο όνομα επιχείρησης.";
        } else {
            document.getElementById("businessName").style.backgroundColor =
                "white ";
            document.getElementById("businessName").placeholder = "";
        }
    }
});

document.getElementById("telephone").addEventListener("blur", (event) => {
    const tel = document.getElementById("telephone").value;
    if (tel !== userData[0].tel) {
        disableSubmit[3] = false;
        if (tel.length != 10) {
            document.getElementById("telephone").value = "";
            document.getElementById("telephone").style.backgroundColor =
                "yellow";
            document.getElementById("telephone").focus();
            document.getElementById("telephone").placeholder =
                "Δώστε έγκυρο τηλέφωνο.";
        } else {
            document.getElementById("telephone").style.backgroundColor =
                "white ";
            document.getElementById("telephone").placeholder = "";
        }
    }
});

document.getElementById("email").addEventListener("blur", (event) => {
    const email = document.getElementById("email").value;
    if (email !== userData[0].email) {
        disableSubmit[4] = false;
        if (!isValidEmail(email)) {
            document.getElementById("email").value = "";
            document.getElementById("email").style.backgroundColor = "yellow";
            document.getElementById("email").focus();
            document.getElementById("email").placeholder =
                "Δώστε έγκυρο email.";
        } else {
            document.getElementById("email").style.backgroundColor = "white ";
            document.getElementById("email").placeholder = "";
        }
    }
});

document.getElementById("password").addEventListener("blur", (event) => {
    const pass = document.getElementById("password").value;
    if (pass !== userData[0].pass) {
        disableSubmit[5] = false;
        if (!hasNumber(pass)) {
            document.getElementById("password").value = "";
            document.getElementById("password").style.backgroundColor =
                "yellow";
            document.getElementById("password").focus();
            document.getElementById("password").placeholder =
                "Δώστε έγκυρο συνθηματικό.";
        } else {
            document.getElementById("password").style.backgroundColor =
                "white ";
            document.getElementById("password").placeholder = "";
        }
    }
});

document.getElementById("confpassword").addEventListener("blur", (event) => {
    const confPass = document.getElementById("confpassword").value;
    const pass = document.getElementById("password").value;
    if (confPass !== pass) {
        document.getElementById("confpassword").value = "";
        document.getElementById("confpassword").style.backgroundColor =
            "yellow";
        document.getElementById("confpassword").focus();
        document.getElementById("confpassword").placeholder =
            "Επιβεβαιώστε το σωστό συνθηματικό.";
    } else {
        document.getElementById("confpassword").style.backgroundColor =
            "white ";
        document.getElementById("confpassword").placeholder = "";
    }
});

document.getElementById("submit").addEventListener("click", () => {
    const data = {
        fname: document.getElementById("firstName").value,
        lname: document.getElementById("lastName").value,
        bname: document.getElementById("businessName").value,
        tel: document.getElementById("telephone").value,
        email: document.getElementById("email").value,
        pwd: document.getElementById("password").value,
    };

    fetch("http://localhost/Ergasia2/scripts/change-data.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: data,
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(
                    "Network response was not ok " + response.statusText
                );
            }
            return response.json();
        })
        .then((data) => {
            if (data.exist) {
                alert(data.message);
            } else {
                alert(data.message);
            }
        })
        .catch((error) => {
            console.error(
                "There was a problem with the fetch operation:",
                error
            );
        });
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

