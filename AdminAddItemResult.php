<html>
<head>
<link rel="stylesheet" href="CSS-AdminPageLogin.css">
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

    $stmt = $conn->prepare("INSERT INTO Product (productType, name, cost, productImage, isOnSale)
    VALUES (?, ?, ?, 'Default_Image.png', 0)");
    $stmt->bind_param("sss", $prodTypeInput, $prodNameInput, $prodCostInput);

    $result = $stmt->execute();

    if ($result = true) {
            $_SESSION["itemMade"] = true;
    }    

    $conn->close();
}
?>

<div id="logo-Container">
    <img src="The Island Project Logo (Transparent).png" alt="The Island Project" id="IslandProjectLogo">
</div> 

<p id='testpara'></p>
<input type="button" value='Go Back To Admin Homepage' id='backToAdminButton' class='Button' onclick="location.href='AdminHomepage.php';">

<script>
var itemMade = <?php if (isset($_SESSION["itemMade"])) { echo $_SESSION["itemMade"]; unset($_SESSION["itemMade"]);}
        else { echo '0'; } ?>;

if (itemMade != '0'){
    console.log(itemMade);
    var string1 = "Item Created";
    $('#testpara').text(string1);
}
else {
    var string1 = "Item Was Not Created";
    $('#testpara').text(string1);
}
</script>

</body>
</html>

