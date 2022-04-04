function checkSubmit(){
    console.log("Inside checkSubmit");

    var fname = $("#firstName").val();
    var lname = $("#lastName").val();
    var birthDate = $("#birthDate").val();
    var gender = $("#gender").val();
    var phoneNum = $("#phoneNum").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var confPassword = $("#confPassword").val();

    if (textOnlyInputCheck(fname) == true && textOnlyInputCheck(lname) == true && dateInputCheck(birthDate) == true && dateValidCheck(birthDate) == true && genderCheck(gender) == true && phoneNumCheck(phoneNum) == true && emailInputCheck(email) == true && textAndNumInputCheck(password) == true && textAndNumInputCheck(confPassword) == true){
        errorString = "Passwords Do Not Match";
        scrollToBottom();
        if (password == confPassword){
            $('#testpara').addClass('ng-hide');
            return true;
        }
    }   
    
    if (textAndNumInputCheck(confPassword) == false){
        errorString = "Please Use Only Letters And Numbers For Confirm Password";
    }

    if (textAndNumInputCheck(password) == false){
        errorString = "Please Use Only Letters And Numbers For Password";
    }

    if (emailInputCheck(email) == false){
        errorString = "Please Use Proper Email Formatting For Email";
    }

    if (phoneNumCheck(phoneNum) == false){
        errorString = "Please Use Proper Phone Number Format For Phone Number (*** *** ****)";
    }

    if (textAndNumInputCheck(gender) == false){
        errorString = "YOU'RE A FILTHY HACKER!";
    }

    if (dateValidCheck(birthDate) == false){
        errorString = "YOU'RE A FILTHY HACKER!";
    }

    if (dateInputCheck(birthDate) == false){
        errorString = "Please Select A Valid Date";
    }

    if (textOnlyInputCheck(lname) == false){
        errorString = "Please Use Only Letters For Last Name";
    }

    if (textOnlyInputCheck(fname) == false){
        errorString = "Please Use Only Letters For First Name";
    }

    scrollToBottom();
    $('#testpara').text(errorString);
    $('#testpara').removeClass('ng-hide');
    return false;
}