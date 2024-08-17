function generateCaptcha() {
    var chars =
        "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var captcha = "";
    for (var i = 0; i < 6; i++) {
        captcha += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return captcha;
}

// Display the generated captcha
document.getElementById("captcha").textContent = generateCaptcha();

// Function to check if the user input matches the captcha
document.getElementById('user_input').oninput = function checkCaptcha() {
    var captcha = document.getElementById("captcha").textContent;
    var userInput = document.getElementById("user_input").value;
if(userInput.length==captcha.length){
    if (captcha === userInput) {
        alert("CAPTCHA matched! You are not a robot.");
        document.getElementById("submit").disabled = false;
    } else {
        alert("CAPTCHA does not match. Please try again.");
        document.getElementById("submit").disabled = true;
    }

  }
}
