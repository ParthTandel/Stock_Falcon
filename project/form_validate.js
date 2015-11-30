function validateForm()
{

    var x = document.forms["myForm"]["first_name"].value;
    if (x == null || x == "") {
        alert("First name must be filled out");
        return false;
    }

   var x = document.forms["myForm"]["gender"].value;
    if (x == null || x == "") {
        alert("Gender must be filled out");
        return false;
    }

    var x = document.forms["myForm"]["password"].value;
    var y = document.forms["myForm"]["temp_password"].value;
   
   if (x== null || x == "") {
        alert("Password must be filled out");
        return false;
    }

    if (y== null || y== "") {
        alert("Name must be filled out");
        return false;
    }

    if (x!=y)
    {
        alert("Password missmatched");
        return false;
    }

    var x = document.forms["myForm"]["birthdate"].value;
    if (x == null || x == "") {
        alert("Birth Date must be filled out");
        return false;
    }


    var x = document.forms["myForm"]["email"].value;
    if (x == null || x == "") {
        alert("Email must be filled out");
        return false;
    }

    
}