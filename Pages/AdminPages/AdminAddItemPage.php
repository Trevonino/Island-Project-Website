<html>

<head>
    <link rel="stylesheet" href="http://student05web.mssu.edu/CSS/AdminCSS/CSS-AdminLoginPage.css">
    <!-- Script that adds AngularJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <!-- Script that adds JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="http://student05web.mssu.edu/Javascripts(Raw)/GenericFunctions.js"></script>

    <script src="http://student05web.mssu.edu/Javascripts(Raw)/AdminPageScripts/AdminAddItemScript.js"></script>

    <?php
    session_start();

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["adminId"])) {
        $prodTypeInput = test_input($_POST["prodType"]);
        $prodNameInput = test_input($_POST["prodName"]);
        $prodCostInput = test_input($_POST["prodCost"]);

        $servername = "209.106.201.103";
        $username = "dbstudent14";
        $password = "spicymonster10";
        $dbname = "group5";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $selectStmt = $conn->prepare("SELECT * FROM Product WHERE productType = ? AND name = ? AND cost = ?;");
        $selectStmt->bind_param("sss", $prodTypeInput, $prodNameInput, $prodCostInput);
        $selectStmt->execute();

        $selectResult = $selectStmt->get_result();

        if ($selectResult->num_rows == 0) {

            $insertStmt = $conn->prepare("INSERT INTO Product (productType, name, cost, productImage, isOnSale)
    VALUES (?, ?, ?, 'Default_Image.png', 0)");
            $insertStmt->bind_param("sss", $prodTypeInput, $prodNameInput, $prodCostInput);

            $result = $insertStmt->execute();

            if ($result = true) {
                $_SESSION["itemMade"] = true;
            }
            
        }
        $_SESSION["itemAttempted"] = true;
        $conn->close();
    }
    ?>

    <script></script>

</head>

<body>

    <div id="logo-Container">
    </div>

    <div id="addItemForm-Container" class='form-Container'>
        <form method="post" action="http://student05web.mssu.edu/Pages/AdminPages/AdminAddItemPage.php" onsubmit=" return checkSubmit();">
            <label for="prodType">Product Type:</label><br>
            <select name="prodType" id="prodType" class='textBox' required><br>
                <option value="Shirt">Shirt</option>
                <option value="Pants">Pants</option>
                <option value="Shoe">Shoe</option>
                <option value="Accessories">Accessories</option>
            </select><br>
            <label for="prodName">Product Name:</label><br>
            <input type="text" name="prodName" id="prodName" class='textBox' required><br>
            <label for="prodCost">Product Cost:</label><br>
            <input type="text" name="prodCost" id="prodCost" class='textBox' required><br>
            <input type="submit" value="Add Item" class='Button'>
        </form>
    </div>
    <p id='testpara' class='ng-hide'></p>
    <input type="button" value='Go Back To Admin Homepage' id='backToAdminButton' class='Button' onclick="location.href='http://student05web.mssu.edu/Pages/AdminPages/AdminLoginPage.php';">

    <script>
        //CHECKS IF USER IS LOGGED IN, IF NOT DISPLAY ERROR MESSAGE ONLY
        var adminId = <?php if (isset($_SESSION["adminId"])) {
                            echo '1';
                        } else {
                            echo "0";
                        } ?>;

        if (adminId == "0") {
            let string1 = "You Are Not Authorized For This Page"
            $('#testpara').text(string1);
            $('#testpara').removeClass('ng-hide');
            $('#addItemForm-Container').addClass('ng-hide');
        }
    </script>

    <script>
        //SHOULD NOTIFIY USERS IF ITEM IS MADE OR NOT 
        var itemAttempted = <?php if (isset($_SESSION["itemAttempted"])) {
                                echo '1';
                                unset($_SESSION["itemAttempted"]);
                            } else {
                                echo '0';
                            } ?>;
        var itemMade = <?php if (isset($_SESSION["itemMade"])) {
                            echo '1';
                            unset($_SESSION["itemMade"]);
                        } else {
                            echo '0';
                        } ?>;

        if (itemAttempted == 1 && itemMade != '0') {
            var string1 = "Item Created";
        } else if (itemAttempted == 1 && itemMade == '0') {
            var string1 = "Item Was Not Created";
        }

        $('#testpara').text(string1);
        $('#testpara').removeClass('ng-hide');
    </script>

</body>

</html>