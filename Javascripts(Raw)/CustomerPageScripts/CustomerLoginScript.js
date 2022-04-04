function checkSubmit(){
    var email = $("#email").val();
    var password = $("#password").val();

    if (emailInputCheck(email) == true && textAndNumInputCheck(password) == true){
        $('#testpara').addClass('ng-hide');
        return true;
    }   
    if (emailInputCheck(email) == false){
        string1 = "Please Use A Proper Email";
    }

    if (textAndNumInputCheck(password) == false){
        string1 = "Please Use Only Letters And Numbers For Your Password";
    }

    $('#testpara').text(string1);
    $('#testpara').removeClass('ng-hide');
    scrollToBottom();
    return false;
}