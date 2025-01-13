function loginval()
{
    var number = document.getElementById("phone").value.trim();
    var password = document.getElementById("password").value.trim();

    if(number === "" || password === "") {
        alert("All fields are mandatory");
        return false;

    }
    else
    {
        return true;

    }
}