<html>
<head>
<link rel="stylesheet" href="CSS-AdminPageLogin.css">
<!-- Script that adds AngularJS -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<!-- Script that adds JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?php session_start();?>

<script>
    function textInputCheck(s) {
        return /^[A-Za-z0-9]*$/g.test(s);
    }

    function textWithSpaceCheck(s) {
        return /^[a-zA-Z\s]*$/g.test(s);
    }

    function decimalInputCheck(s) {
        return /^[+-]?([0-9]+\.?[0-9]*|\.[0-9]+)$/g.test(s);
    }

    function checkSubmit(){
        console.log("Inside checkSubmit");

        var prodType = $("#prodType").val();
        var prodName = $("#prodName").val();
        var prodCost = $("#prodCost").val();

        if (textInputCheck(prodType) == true && textWithSpaceCheck(prodName) == true && decimalInputCheck(prodCost) == true){
            $('#testpara').addClass('ng-hide');
            return true;
        }
        else if (textInputCheck(prodType) == false || textWithSpaceCheck(prodName) == false){
            console.log("Naw");
            string1 = "Please Use Only Letters and Numbers For Type and Name";
            $('#testpara').text(string1);
            $('#testpara').removeClass('ng-hide');
            scrollToBottom();
            return false;
        }
        else {
            console.log("Naw");
            string1 = "Please Use A Decimal For Cost";
            $('#testpara').text(string1);
            $('#testpara').removeClass('ng-hide');
            scrollToBottom();
            return false;
        }
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

<div id="addItemForm-Container" class='form-Container'>
    <form method="post" action="AdminAddItemResult.php" onsubmit=" return checkSubmit();">
    <label for="prodType">Product Type:</label><br>
    <select name="prodType" id="prodType" class='textBox' required><br>
        <option value="Shirt">Shirt</option>
        <option value="Pants">Pants</option>
        <option value="Shoes">Shoes</option>
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



<script>
var adminId = <?php if (isset($_SESSION["adminId"])) { echo $_SESSION["adminId"]; }
        else { echo "0"; } ?>;

if (adminId == "0"){
    console.log(adminId);
    let string1 = "You Are Not Authorized For This Page"
    $('#testpara').text(string1);
    $('#testpara').removeClass('ng-hide');
    $('#addItemForm-Container').addClass('ng-hide');
}
</script>

</body>
</html>