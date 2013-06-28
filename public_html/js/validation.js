$(document).ready(function(){
    //validation functions
    function validateEmail(){
        //testing regular expression
        var a = $("#email").val();
        var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
        //if it's valid email
        if(filter.test(a)){
            email.removeClass("error");
            emailInfo.text("Valid E-mail please, you will need it to log in!");
            emailInfo.removeClass("error");
            return true;
        }
        //if it's NOT valid
        else{
            email.addClass("error");
            emailInfo.text("Stop cowboy! Type a valid e-mail please :P");
            emailInfo.addClass("error");
            return false;
        }
    }
    function validateName(){
        //if it's NOT valid
        if(name.val().length < 4){
            name.addClass("error");
            nameInfo.text("We want names with more than 3 letters!");
            nameInfo.addClass("error");
            return false;
        }
        //if it's valid
        else{
            name.removeClass("error");
            nameInfo.text("What's your name?");
            nameInfo.removeClass("error");
            return true;
        }
    }
    function validatePass1(){
        var a = $("#password1");
        var b = $("#password2");

        //it's NOT valid
        if(pass1.val().length <5){
            pass1.addClass("error");
            pass1Info.text("Ey! Remember: At least 5 characters: letters, numbers and '_'");
            pass1Info.addClass("error");
            return false;
        }
        //it's valid
        else{           
            pass1.removeClass("error");
            pass1Info.text("At least 5 characters: letters, numbers and '_'");
            pass1Info.removeClass("error");
            validatePass2();
            return true;
        }
    }
    function validatePass2(){
        var a = $("#password1");
        var b = $("#password2");
        //are NOT valid
        if( pass1.val() != pass2.val() ){
            pass2.addClass("error");
            pass2Info.text("Passwords doesn't match!");
            pass2Info.addClass("error");
            return false;
        }
        //are valid
        else{
            pass2.removeClass("error");
            pass2Info.text("Confirm password");
            pass2Info.removeClass("error");
            return true;
        }
    }
    function validateMessage(){
        //it's NOT valid
        if(message.val().length < 10){
            message.addClass("error");
            return false;
        }
        //it's valid
        else{           
            message.removeClass("error");
            return true;
        }
    }
});