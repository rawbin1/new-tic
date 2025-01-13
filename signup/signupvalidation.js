function signupval() {
    var name = document.getElementById("name").value.trim();
    var number = document.getElementById("phone").value.trim();
    var email = document.getElementById("email").value.trim();
    var password = document.getElementById("password").value.trim();
    var cpassword = document.getElementById("confirm-password").value.trim();
    var regx = /^\+977[0-9]{10}$/; // Nepali mobile number validation
    var regEmail = /^([a-zA-Z0-9._-]+)@([a-zA-Z0-9-]+)\.([a-z]{2,20})(\.[a-z]{2,20})?$/;

    if (name === "" || number === "" || email === "" || password === "" || cpassword === "") {
        alert("All fields are mandatory");
        return false;
    } else if (name.length < 6) {
        alert("Please enter your full name!");
        return false;
    } else if (!regx.test(number)) {
        alert("Please enter a valid Nepali number!");
        return false;
    } else if (!regEmail.test(email)) {
        alert("Please enter a valid email!");
        return false;
    } else if (password.length < 6) {
        alert("Password too short!");
        return false;
    } else if (password !== cpassword) {
        alert("Your password did not match. Please try again!");
        return false;
    } else {
        //alert("Signup successful!");
        return true;
    }
}