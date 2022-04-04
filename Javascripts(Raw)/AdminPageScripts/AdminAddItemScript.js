function checkSubmit(){
    console.log("Inside checkSubmit");

    var prodType = $("#prodType").val();
    var prodName = $("#prodName").val();
    var prodCost = $("#prodCost").val();

    if (textOnlyInputCheck(prodType) == true && textWithSpaceCheck(prodName) == true && decimalInputCheck(prodCost) == true){
        $('#testpara').addClass('ng-hide');
        return true;
    }
    else {
        if (textOnlyInputCheck(prodType) == false){
            string1 = "YOU FILTHY HACKER";
        }

        if (textWithSpaceCheck(prodName) == false){
            string1 = "Please Use Only Numbers, Letters, and Spaces For Product Name";
        }

        if (decimalInputCheck(prodCost) == false){
            string1 = "Please Use Only A Decimal Without A Dollar Sign For Cost'";
        }

        $('#testpara').text(string1);
        $('#testpara').removeClass('ng-hide');
        scrollToBottom();
        return false;
    }
}
