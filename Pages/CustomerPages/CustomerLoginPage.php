<html>

<head>
    <link rel="stylesheet" href="http://student05web.mssu.edu/CSS/CustomerCSS/CSS-CustomerLoginPage.css">
    <!-- Script that adds AngularJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <!-- Script that adds JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="http://student05web.mssu.edu/Javascripts(Raw)/GenericFunctions.js"></script>

    <script src="http://student05web.mssu.edu/Javascripts(Raw)/CustomerPageScripts/CustomerLoginScript.js"></script>

    <?php
    session_start();

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (($_SERVER["REQUEST_METHOD"] == "POST") && (!isset($_POST["custLogout"]))) {

        //MAKE A .DB.WHATERVER FILE AND USE Includes 
        $emailInput = test_input($_POST["email"]);
        $passwordInput = test_input($_POST["password"]);


        $servername = "209.106.201.103";
        $username = "dbstudent14";
        $password = "spicymonster10";
        $dbname = "group5";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //

        //SELECT ON JUST EMAIL
        //GRAB THE PASSWORD FROM THE RESULTING ROW AND CHECK THE HASH, IF TRUE MAKE APPROPRIATE SESSION VARIABLES
        $stmt = $conn->prepare("SELECT * FROM Customer WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $emailInput, $passwordInput);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $_SESSION["custId"] = $row["customerId"];
                $_SESSION["custFName"] = $row["firstName"];
                $_SESSION["custLName"] = $row["lastName"];
            }
        } else {
            $_SESSION['failedLogin'] = 1;
        }

        $conn->close();
    } else if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["custLogout"]))) {
        unset($_SESSION["custId"]);
        unset($_SESSION["custFName"]);
        unset($_SESSION["custLName"]);
    }
    ?>

</head>

<body>

    <div id="logo-Container"></div>

    <div id="customerLoginForm-Container">
        <form action="http://student05web.mssu.edu/Pages/CustomerPages/CustomerLoginPage.php" method="post" onsubmit="return checkSubmit();">
            <label for="email">Email:</label><br>
            <input type="text" id='email' name="email" class='textBox'><br>
            <label for="password">Password:</label><br>
            <input type="password" id='password' name="password" class='textBox'><br>
            <input type="submit" value="Log In" class='logInButton'>
            <input type="button" value='Create Account' id='createNewButton' class='logInButton' onclick="location.href='http://student05web.mssu.edu/Pages/CustomerPages/CustomerCreateAccount.php';">
        </form>
    </div>

    <p id='testpara' class='ng-hide'></p>

    <form action='http://student05web.mssu.edu/Pages/CustomerPages/CustomerLoginPage.php' method='post' class='ng-hide' id='logoutButtonForm'>
        <input type='submit' name='custLogout' value='Log out' class='logInButton'>
    </form>

    <script>
        var custId = <?php if (isset($_SESSION["custId"])) {
                            echo '1';
                        } else {
                            echo "0";
                        } ?>;



        if (custId != "0") {
            var string1 = "You are logged in as: <?php if (isset($_SESSION["custFName"])) {echo $_SESSION["custFName"];} ?> <?php if (isset($_SESSION["custLName"])) {echo $_SESSION["custLName"];} ?>";
            $('#testpara').text(string1);
            $('#testpara').removeClass('ng-hide');
            $('#logoutButtonForm').removeClass('ng-hide');
            $('#customerLoginForm-Container').addClass('ng-hide');
        } else {
            <?php if (isset($_SESSION['failedLogin'])) {
                echo "string1 = 'Email / Password Was Incorrect'; $('#testpara').text(string1); $('#testpara').removeClass('ng-hide');";
                unset($_SESSION['failedLogin']);
            } else {
                echo "$('#testpara').addClass('ng-hide');";
            } ?>
            $('#customerLoginForm-Container').removeClass('ng-hide');
        }
    </script>

</body>

</html>