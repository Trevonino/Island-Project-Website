<html>  
<head>
<link rel="stylesheet" href="CSS-CustomerLoginPage.css">
<!-- Script that adds AngularJS -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<!-- Script that adds JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?php session_start();?>

</head>
<body>

<div id="logo-Container">
    <img src="The Island Project Logo (Transparent).png" alt="The Island Project" id="IslandProjectLogo">
</div>    

<p id='testpara' class='ng-hide'></p>

<div id="customerLoginForm-Container">
    <form action="CustomerLoginResult.php" method="post">
        <label for="email">Email:</label><br>
        <input type="text" name="email" class='textBox'><br>
        <label for="password">Password:</label><br>
        <input type="password" name="password" class='textBox'><br>
        <input type="submit" value="Log In" class='logInButton'>
        <input type="button" value='Create Account' id='createNewButton' class='logInButton' onclick="location.href='CustomerCreateAccount.php';">
    </form>
</div>

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