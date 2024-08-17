document.addEventListener("DOMContentLoaded", () => {
    let entName = document.getElementById("name");
    let entTel = document.getElementById("tel");
    let entEmail = document.getElementById("email");
    let entMob = document.getElementById("mob");

    function fetchData() {
        let xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            "http://localhost/Ergasia2/scripts/fetch-accom.php",
            true
        );
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    try {
                        userData = JSON.parse(xhr.responseText);
                        fillForm(userData);
                    } catch (e) {
                        console.error(
                            "Failed to parse JSON response: " + e.message
                        );
                    }
                } else {
                    console.error(
                        "Failed to fetch data: " +
                            xhr.status +
                            " " +
                            xhr.statusText
                    );
                }
            }
        };
    }

    function fillForm(userData) {
        //fill the form with the data from the database
        document.getElementById("name").value = userData[0].bname;
        document.getElementById("roomsName").value = userData[0].bname;
        document.getElementById("tel").value = userData[0].tel;
        document.getElementById("mob").value = userData[1].mobile;
        document.getElementById("email").value = userData[0].email;
    }

    // Call fetchUserData when the page loads
    window.onload = fetchData;
});
