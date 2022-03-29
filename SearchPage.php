<html>

<head>
    <!-- Script that adds AngularJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <!-- Script that adds JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="CSS-Searches.css">

    <script>
        function textWithSpaceCheck(s) {
            return /^[a-zA-Z\s]*$/g.test(s);
        }

        function checkSubmit() {
            var searchbar = $("#searchbar").val();
            var password = $("#password").val();

            if (textWithSpaceCheck(searchbar) == true) {
                console.log("Yes");
                $('#testpara').addClass('ng-hide');
                return true;
            }
            console.log("Naw");
            string1 = "Please Use Only Letters, Numbers, and Spaces For Input";
            $('#testpara').text(string1);
            $('#testpara').removeClass('ng-hide');
            scrollToBottom();
            return false;
        }

        function scrollToBottom() {
            let body = document.querySelector("body");
            body.scrollTop = body.scrollHeight;
        }
    </script>

</head>

<body>

    <div id="logo-Container">
        <img src="The Island Project Logo (Transparent).png" alt="The Island Project" id="IslandProjectLogo">
    </div>

    <div id='searchbar-Conatainer' class='form-Container'>
        <form action="SearchResults.php" method="post" onsubmit="return checkSubmit();">
            <label for="searchbar">Search: </label>
            <input type="text" name="searchbar" id="searchbar" class='textBox' required>
            <br>
            <input type="submit" value="Search" class='Button'>
        </form>
    </div>
    <p id='testpara' class='ng-hide'></p>
</body>

</html>