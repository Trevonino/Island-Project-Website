<html>  
<head>
<link rel="stylesheet" href="CSS-AdminPageLogin.css">
<!-- Script that adds AngularJS -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<!-- Script that adds JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

<div id="logo-Container">
    <img src="The Island Project Logo (Transparent).png" alt="The Island Project" id="IslandProjectLogo">
</div>    

<p id='testpara' class='ng-hide'></p>

<div id="adminLoginForm-Container">
    <form action="AdminHomepage.php" method="post">
        <label for="email">Email:</label><br>
        <input type="text" name="email" class='textBox'><br>
        <label for="password">Password:</label><br>
        <input type="password" name="password" class='textBox'><br>
        <input type="submit" value="Log In" class='logInButton'>
    </form>

<script>
var adminId = <?php if (isset($_SESSION["adminId"])) { echo $_SESSION["adminId"]; }
        else { echo "0"; } ?>;

if (adminId != "0"){
    console.log(adminId);
    var string1 = "You are already logged in.";
    $('#testpara').text(string1);
    $('#testpara').removeClass('ng-hide');
    $('#adminLoginForm-Container').addClass('ng-hide');
}
else {
    $('#testpara').addClass('ng-hide');
    $('#adminLoginForm-Container').removeClass('ng-hide');
}
</script>
</div>
</body>
</html>