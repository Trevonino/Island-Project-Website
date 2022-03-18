<html>
<head>
<link rel="stylesheet" href="CSS-CustomerLoginPage.css">
<!-- Script that adds AngularJS -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<!-- Script that adds JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    function textInputCheck(s) {
        return /^[A-Za-z0-9]*$/g.test(s);
    }

    function emailInputCheck(s) {
        return /^[A-Za-z0-9@.]*$/g.test(s);
    }

    function dateInputCheck(s) {
        return /^[A-Za-z0-9-]*$/g.test(s);
    }

    function checkSubmit(){
        console.log("Inside checkSubmit");

        var fname = $("#firstName").val();
        var lname = $("#lastName").val();
        var birthDate = $("#birthDate").val();
        var gender = $("#gender").val();
        var phoneNum = $("#phoneNum").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var confPassword = $("#confPassword").val();

        if (textInputCheck(fname) == true && textInputCheck(lname) == true && dateInputCheck(birthDate) == true && textInputCheck(gender) == true && textInputCheck(phoneNum) == true && emailInputCheck(email) == true && textInputCheck(password) == true && textInputCheck(confPassword) == true){
            console.log("Yes")
            string1 = "Passwords Do Not Match";
            $('#testpara').text(string1);
            $('#testpara').removeClass('ng-hide');
            scrollToBottom();
            if (password == confPassword){
                console.log("Yes2");
                $('#testpara').addClass('ng-hide');
                return true;
            }
            return false;
        }   
        console.log("Naw");
        string1 = "Please Use Only Letters and Numbers For Input";
        $('#testpara').text(string1);
        $('#testpara').removeClass('ng-hide');
        scrollToBottom();
        return false;
    }

    function scrollToBottom(){
        let body = document.querySelector("body");
        body.scrollTop = body.scrollHeight;
    }
</script>

</head>
<body>

<div id="logo-Container">
    <img src="The Island Project Logo (Transparent).png" alt="The Island Project" id="IslandProjectLogo">
</div> 
<div id="customerCreateForm-Container">
<form method="post" action="CustomerCreateAccountResult.php" onsubmit=" return checkSubmit();">
    <label for="firstName">First Name:</label><br>
    <input type="text" name="firstName" id="firstName" class='textBox' required><br>
    <label for="lastName">Last Name:</label><br>
    <input type="text" name="lastName" id="lastName" class='textBox' required><br>
    <label for="birthday">Birthday:</label><br>
    <input type="date" name="birthDate" id="birthDate" class='textBox' required><br>
    <label for="gender">Gender:</label><br>
    <select name="gender" id="gender" class='textBox' required><br>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other/Prefer Not To Say">Other/Prefer Not To Say</option>
    </select><br>
    <label for="phoneNum">Phone:</label><br>
    <input type="text" name="phoneNum" id="phoneNum" class='textBox' maxlength="12" minlength="12" required><br>
    <label for="email">Email:</label><br>
    <input type="text" name="email" id="email" class='textBox' required><br>
    <label for="password">Password:</label><br>
    <input type="text" name="password" id="password" class='textBox' required><br>
    <label for="confPassword">Confirm Password:</label><br>
    <input type="text" name="confPassword" id="confPassword" class='textBox' required><br>
    <label for="newsletter">Subsrcibe To Newsletter:</label><br>
    <select name="newsletter" id="newsletter" class='textBox' required><br>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select><br>
    <input type="submit" value="Create Account" id='createNewButton' class='logInButton'>
    <!-- -->
</form>
</div>
<p id='testpara' class='ng-hide'></p>

</body>
</html>