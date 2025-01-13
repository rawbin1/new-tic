function aloginval()
{
    var username = document.getElementById("username").value.trim();
    var password = document.getElementById("password").value.trim();

    if(username === "" || password === "") {
        alert("All fields are mandatory");
        return false;

    }
    else
    {
        return true;

    }
}