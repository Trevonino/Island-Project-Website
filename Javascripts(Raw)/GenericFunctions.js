$(document).ready(function(){
   
    try {
        $('#logo-Container').load("http://student05web.mssu.edu/Pages/GenericResources/LogoTransparent.html");
    } catch (error){
        
    }
 
 });

function textOnlyInputCheck(s) {
    return /^[A-Za-z]+$/g.test(s);
}

function textAndNumInputCheck(s) {
    return /^[A-Za-z0-9]+$/g.test(s);
}

function emailInputCheck(s) {
    return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/g.test(s);
}

function phoneNumCheck(s) {
    return /^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/g.test(s);
}

function dateInputCheck(s) {
    return /^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/g.test(s);
}

function decimalInputCheck(s) {
    return /^[0-9]+(\.[0-9][0-9])$/g.test(s);
}

function textWithSpaceCheck(s) {
    return /^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/g.test(s);
}

function genderCheck(s){
    if (s == 'Other/Prefer Not To Say'){
        return true;
    }
    else {
        return textOnlyInputCheck(s);
    }
}

function dateValidCheck(s){
    today = new Date();
    var todayDay = String(today.getDate()).padStart(2, '0');
    var todayMonth = String(today.getMonth() + 1).padStart(2, '0');
    var todayYear = today.getFullYear();

    inputYear = s.substring(0,4);
    inputMonth = s.substring(5,7);
    inputDay = s.substring(8,10);

    if (todayYear >= inputYear && todayMonth == inputMonth && todayDay >= inputDay){
        return true;
    }

    if (todayYear >= inputYear && todayMonth > inputMonth){
        return true;
    } 

    if (todayYear > inputYear){
        return true;
    } 

    return false;
}

function scrollToBottom(){
    let body = document.querySelector("body");
    body.scrollTop = body.scrollHeight;
}