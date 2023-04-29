let username;
let email;
let password;
let confirmpass;
let submitBtn;

let warning;

$(document).ready(function(){

    username = $('#inputUsername');
    email = $('#inputEmail');
    password = $('#inputPassword');
    confirmpass = $('#inputPasswordConfirm');
    submitBtn = $('#btnSubmit');
    warning = $('#showWarning');

    let form = [username, email, password, confirmpass];


    submitBtn.click(submitForm);


    for( i in form){
        form[i].change(function(){$(this).css('border-color', '')});
    }

    function submitForm(){

        for(i in form){
            if(form[i].val() == ""){
                form[i].css('border-color', 'red');
            }
        }


        if( !email.val().includes('@') || !email.val().includes('.')){
            warning.css('display', 'block');
            warning.text('Ingrese un correo electrónico válido');
            return false;
        }else{
            warning.css('display', 'none');
            warning.text('');
        }


        if(password.val() != confirmpass.val()){
            warning.css('display', 'block');
            warning.text('¡Las contraseñas deben ser iguales!');
            return false;
        }else{
            warning.css('display', 'none');
            warning.text('');
        }




        $.ajax({
            type: "POST",
            url: "http://krysolite.test:8080/assets/php/api/createUser.php",
            data: {username: username.val().toLowerCase(), email: email.val().toLowerCase(), password: password.val()},
            dataType: 'json',
            
            success: function(data){
                if(data.state == 'fail'){
                    warning.css('display', 'block');
                    warning.text(data.reason);
                }else{
                    console.log('Usuario creado');
                    $(location).attr('href', '/');
                }
                
            }
        });


    }






    console.log('Finished loading');





});







