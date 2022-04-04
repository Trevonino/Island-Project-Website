<html>

<head>
    <link rel="stylesheet" href="http://student05web.mssu.edu/CSS/AdminCSS/CSS-AdminLoginPage.css">
    <!-- Script that adds AngularJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <!-- Script that adds JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="http://student05web.mssu.edu/Javascripts(Raw)/GenericFunctions.js"></script>

    <script src="http://student05web.mssu.edu/Javascripts(Raw)/AdminPageScripts/AdminLoginScript.js"></script>

    <?php
    session_start();

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (($_SERVER["REQUEST_METHOD"] == "POST")  && (!isset($_POST["adminLogout"]))) {
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

        $stmt = $conn->prepare("SELECT * FROM Employee WHERE email = ? AND password = ? AND isAdmin = 1");
        $stmt->bind_param("ss", $emailInput, $passwordInput);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $_SESSION["adminId"] = $row["employeeId"];
                $_SESSION["adminFName"] = $row["firstName"];
                $_SESSION["adminLName"] = $row["lastName"];
            }
        } else {
            $_SESSION['failedLogin'] = 1;
        }

        $conn->close();
    } else if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["adminLogout"]))) {
        unset($_SESSION["adminId"]);
        unset($_SESSION["adminFName"]);
        unset($_SESSION["adminLName"]);
    }
    ?>

</head>

<body>

    <div id="logo-Container">
    </div>

    <div id="adminLoginForm-Container">
        <form action="http://student05web.mssu.edu/Pages/AdminPages/AdminLoginPage.php" method="post" onsubmit="return checkSubmit();">
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" class='textBox' required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" class='textBox' required><br>
            <input type="submit" id="logButton" value="Log In" class='Button'>
        </form>
    </div>

    <p id='testpara' class='ng-hide'></p>
    <input type="button" value="Add Item" id="addItemButton" class="Button ng-hide" onclick="location.href='http://student05web.mssu.edu/Pages/AdminPages/AdminAddItemPage.php';">

    <form action='http://student05web.mssu.edu/Pages/AdminPages/AdminLoginPage.php' method='post' class='ng-hide' id='logoutButtonForm'>
        <input type='submit' name='adminLogout' value='Log out' class='Button'>
    </form>

    <script>
        var adminId = <?php if (isset($_SESSION["adminId"])) {
                            echo '1';
                        } else {
                            echo "0";
                        } ?>;

        if (adminId != "0") {
            var string1 = "You are logged in as: <?php if (isset($_SESSION["adminFName"])) {echo $_SESSION["adminFName"];} ?> <?php if (isset($_SESSION["adminLName"])) {echo $_SESSION["adminLName"];} ?>";
            $('#testpara').text(string1);
            $('#testpara').removeClass('ng-hide');
            $('#addItemButton').removeClass('ng-hide');
            $('#logoutButtonForm').removeClass('ng-hide');
            $('#adminLoginForm-Container').addClass('ng-hide');
        } else {
            <?php if (isset($_SESSION['failedLogin'])) {
                echo "string1 = 'Email / Password Was Incorrect'; $('#testpara').text(string1); $('#testpara').removeClass('ng-hide');";
                unset($_SESSION['failedLogin']);
            } else {
                echo "$('#testpara').addClass('ng-hide');";
            } ?>
            $('#adminLoginForm-Container').removeClass('ng-hide');
        }
    </script>

</body>

</html>