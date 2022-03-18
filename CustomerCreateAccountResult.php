<html>
<head>
<link rel="stylesheet" href="CSS-CustomerLoginPage.css">
<!-- Script that adds AngularJS -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<!-- Script that adds JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<?php
session_start();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstNameInput = test_input($_POST["firstName"]);
    $lastInput = test_input($_POST["lastName"]);
    $birthDateInput = test_input($_POST["birthDate"]);
    $genderInput = test_input($_POST["gender"]);
    $phoneNumInput = test_input($_POST["phoneNum"]);
    $emailInput = test_input($_POST["email"]);
    $passwordInput = test_input($_POST["password"]);
    $newsletterInput = test_input($_POST["newsletter"]);

    $servername = "209.106.201.103";
    $username = "dbstudent14";
    $password = "spicymonster10";
    $dbname = "group5";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO Customer (firstName, lastName, dateOfBirth, gender, phoneNumber, email, password, newsletterSubscriber, accountCreationDate)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, sysdate())");
    $stmt->bind_param("ssssssss", $firstNameInput, $lastInput, $birthDateInput, $genderInput, $phoneNumInput, $emailInput, $passwordInput, $newsletterInput);

    $result = $stmt->execute();

    if ($result = true) {
            $_SESSION["custMade"] = true;
    }    

    $conn->close();
}
?>

<div id="logo-Container">
    <img src="The Island Project Logo (Transparent).png" alt="The Island Project" id="IslandProjectLogo">
</div> 

<p id='testpara'></p>
<input type="button" value='Go Back To Login' id='backToLogButton' class='logInButton' onclick="location.href='CustomerLoginPage.php';">

<script>
var custMade = <?php if (isset($_SESSION["custMade"])) { echo $_SESSION["custMade"]; unset($_SESSION["custMade"]);}
        else { echo '0'; } ?>;

if (custMade != '0'){
    console.log(custMade);
    var string1 = "Account Created";
    $('#testpara').text(string1);
}
else {
    var string1 = "Account Was Not Created";
    $('#testpara').text(string1);
}
</script>

</body>
</html>