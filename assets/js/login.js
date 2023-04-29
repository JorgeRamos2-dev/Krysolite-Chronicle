$(document).ready(function(){

    
    email = $('#inputEmail');
    password = $('#inputPassword');
    submitBtn = $('#btnSubmit');

    warning = $('#showWarning');

    let form = [email, password];


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




        $.ajax({
            type: "POST",
            url: "http://krysolite.test:8080/assets/php/api/login.php",
            data: {email: email.val().toLowerCase(), password: password.val()},
            dataType: 'json',
            
            success: function(data){
                console.log('Usuario logeado');

                if(data.state == 'success'){
                    $(location).attr('href', '/');
                }else{
                    warning.css('display', 'block');
                    warning.text('Usuario o contraseña incorrectos');
                }
                
            }
        });


    }






    console.log('Finished loading');





});