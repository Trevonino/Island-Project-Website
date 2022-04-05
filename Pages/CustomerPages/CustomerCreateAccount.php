<html>
<head>
<link rel="stylesheet" href="http://student05web.mssu.edu/CSS/CustomerCSS/CSS-CustomerLoginPage.css">
<!-- Script that adds AngularJS -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<!-- Script that adds JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="http://student05web.mssu.edu/Javascripts(Raw)/GenericFunctions.js"></script>

<script src="http://student05web.mssu.edu/Javascripts(Raw)/CustomerPageScripts/CustomerCreateAccountScript.js"></script>

<?php include($_SERVER['DOCUMENT_ROOT'].'/.db.inc.php'); ?>

<?php 
$max = new DateTime();
?>

</head>
<body>

<?php

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function removeDashes($data)
    {
        $data = str_replace(' ', '', $data);
        $data = str_replace('-', '', $data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstNameInput = test_input($_POST["firstName"]);
        $lastInput = test_input($_POST["lastName"]);
        $birthDateInput = test_input($_POST["birthDate"]);
        $genderInput = test_input($_POST["gender"]);
        $phoneNumInput = test_input(removeDashes($_POST["phoneNum"]));
        $emailInput = test_input($_POST["email"]);
        $passwordInput = test_input($_POST["password"]);
        $newsletterInput = test_input($_POST["newsletter"]);

        //Create, Prepare, And Execute Select Statement To See If Row With Email Exists
        $selectStmt = $conn->prepare("SELECT * FROM Customer WHERE email = ?;");
        $selectStmt->bind_param("s", $emailInput);
        $selectStmt->execute();

        //Store The Resulting Table Inside A Variable
        $selectResult = $selectStmt->get_result();

        //If There Are 0 Rows In The Resulting Table, Executes The Insert. Otherwise, Show Error Message.
        if ($selectResult->num_rows == 0) {

            $hashedPassword = password_hash($passwordInput, PASSWORD_DEFAULT);

            $insertStmt = $conn->prepare("INSERT INTO Customer (firstName, lastName, dateOfBirth, gender, phoneNumber, email, password, newsletterSubscriber, accountCreationDate)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, sysdate());");
            $insertStmt->bind_param("ssssssss", $firstNameInput, $lastInput, $birthDateInput, $genderInput, $phoneNumInput, $emailInput, $hashedPassword, $newsletterInput);

            $insertResult = $insertStmt->execute();

            if ($insertResult = true) {
                $_SESSION["custMade"] = true;
            }
        }
            $_SESSION['accountAttempted'] = true;

        $conn->close();
    }
    ?>

<div id="logo-Container">
</div> 
<div id="customerCreateForm-Container">
<form method="post" id='accountCreateForm' action="http://student05web.mssu.edu/Pages/CustomerPages/CustomerCreateAccount.php" onsubmit=" return checkSubmit();">
    <label for="firstName">First Name:</label><br>
    <input type="text" name="firstName" id="firstName" class='textBox' required><br>
    <label for="lastName">Last Name:</label><br>
    <input type="text" name="lastName" id="lastName" class='textBox' required><br>
    <label for="birthday">Birthday:</label><br>
    <input type="date" name="birthDate" id="birthDate" class='textBox' max=<?php echo $max->format("Y-m-d")?> required><br>
    <label for="gender">Gender:</label><br>
    <select name="gender" id="gender" class='textBox' required><br>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other/Prefer Not To Say">Other/Prefer Not To Say</option>
    </select><br>
    <label for="phoneNum">Phone:</label><br>
    <input type="text" name="phoneNum" id="phoneNum" class='textBox' required><br>
    <label for="email">Email:</label><br>
    <input type="text" name="email" id="email" class='textBox' required><br>
    <label for="password">Password:</label><br>
    <input type="password" name="password" id="password" class='textBox' required><br>
    <label for="confPassword">Confirm Password:</label><br>
    <input type="password" name="confPassword" id="confPassword" class='textBox' required><br>
    <label for="newsletter">Subscribe to Newsletter:</label><br>
    <select name="newsletter" id="newsletter" class='textBox' required><br>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select><br>
    <input type="submit" value="Create Account" id='createNewButton' class='logInButton'>
</form>
</div>
<p id='testpara' class='ng-hide'></p>
<input type="button" value='Go Back To Admin Homepage' id='backToAdminButton' class='Button' onclick="location.href='http://student05web.mssu.edu/Pages/CustomerPages/CustomerLoginPage.php';">

<script>
        //SHOULD NOTIFIY USERS IF ACCOUNT IS MADE OR NOT 
        var custAttempted = <?php if (isset($_SESSION["accountAttempted"])) {
                                echo '1';
                                unset($_SESSION["accountAttempted"]);
                            } else {
                                echo '0';
                            } ?>;
        var custMade = <?php if (isset($_SESSION["custMade"])) {
                            echo '1';
                            unset($_SESSION["custMade"]);
                        } else {
                            echo '0';
                        } ?>;

        if (custAttempted == 1 && custMade != '0') {
            var string1 = "Account Created";
            $('#accountCreateForm').addClass('ng-hide');

        } else if (custAttempted == 1 && custMade == '0') {
            var string1 = "Account Was Not Created, Email Is Already In Use";
        }
        $('#testpara').text(string1);
        $('#testpara').removeClass('ng-hide');
    </script>

</body>
</html>