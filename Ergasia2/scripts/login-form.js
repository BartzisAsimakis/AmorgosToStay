document.getElementById("submit").addEventListener("click", (event) => {
    const username = document.getElementById("uname").value;
    const password = document.getElementById("pwd").value;
    const remember = document.getElementById("remember").value;

    const data = {
        username: username,
        password: password,
        remember: remember,
    };

    const formBody = Object.keys(data)
        .map(
            (key) =>
                encodeURIComponent(key) + "=" + encodeURIComponent(data[key])
        )
        .join("&");

    fetch("http://localhost/Ergasia2/login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: formBody,
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
