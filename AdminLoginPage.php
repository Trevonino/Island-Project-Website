<html>  
<head>
<link rel="stylesheet" href="CSS-AdminPageLogin.css">
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

    function checkSubmit(){
        var email = $("#email").val();
        var password = $("#password").val();

        if (emailInputCheck(email) == true && textInputCheck(password) == true){
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

<div id="adminLoginForm-Container">
    <form action="AdminHomepage.php" method="post" onsubmit="return checkSubmit();">
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" class='textBox' required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" class='textBox' required><br>
        <input type="submit" id="logButton" value="Log In" class='Button'>
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
<p id='testpara' class='ng-hide'></p>
</body>
</html>