<html>  
<head>
<link rel="stylesheet" href="CSS-CustomerLoginPage.css">
<!-- Script that adds AngularJS -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<!-- Script that adds JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?php session_start();?>

<script>
    function textInputCheck(s) {
        return /^[A-Za-z0-9]*$/g.test(s);
    }

    function checkSubmit(){
        var email = $("#email").val();
        var password = $("#password").val();

        if (textInputCheck(email) == true && textInputCheck(password) == true){
            console.log("Yes");
            $('#testpara').addClass('ng-hide');
            return true;
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

<div id="customerLoginForm-Container">
    <form action="CustomerLoginResult.php" method="post" onsubmit="return checkSubmit();">
        <label for="email">Email:</label><br>
        <input type="text" id='email' name="email" class='textBox'><br>
        <label for="password">Password:</label><br>
        <input type="password" id='password'name="password" class='textBox'><br>
        <input type="submit" value="Log In" class='logInButton'>
        <input type="button" value='Create Account' id='createNewButton' class='logInButton' onclick="location.href='CustomerCreateAccount.php';">
    </form>
</div>

<p id='testpara' class='ng-hide'></p>

<script>
var custId = <?php if (isset($_SESSION["custId"])) { echo $_SESSION["custId"]; }
        else { echo "0"; } ?>;

if (custId != "0"){
    console.log(custId);
    var string1 = "You are already logged in.";
    $('#testpara').text(string1);
    $('#testpara').removeClass('ng-hide');
    $('#customerLoginForm-Container').addClass('ng-hide');
}
else {
    $('#testpara').addClass('ng-hide');
    $('#customerLoginForm-Container').removeClass('ng-hide');
}
</script>

</body>
</html>