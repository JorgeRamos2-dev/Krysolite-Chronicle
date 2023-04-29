$(document).ready(function(){


    const btnBorrar = $('#submitBtn-1');
    const btnGuardar = $('#submitBtn');
    const btnLogout = $('#submitBtn-2');

    const firstname = $('#firstname');
    const lastname = $('#lastname');
    const username = $('#username');
    const email = $('#email');
    const password = $('#password');
    const password2 = $('#password2');

    const warning = $('#errorMsg');

    btnBorrar.click(borrarUsuario);
    btnGuardar.click(guardarConfiguracion);
    btnLogout.click(cerrarSesion);


    function cargarConfiguracion(){
        $.ajax({
            type: "GET",
            url: "http://krysolite.test:8080/assets/php/api/getUser.php",
            dataType: 'json',
            success: function(data){

                if(data.username){
                    cargarDatos(data);

                }else{
                    $(location).attr('href', '/');
                }
                
            }
        });
    }

    function cargarDatos(data){

        firstname.val(data.firstname);
        lastname.val(data.lastname);
        username.val(data.username);
        email.val(data.email);

    }


    function borrarUsuario(){
        $.ajax({
            type: "GET",
            url: "http://krysolite.test:8080/assets/php/api/deleteUser.php",
            dataType: 'json',
            success: function(data){
                if(data.state == 'success'){
                    $(location).attr('href', '/');
                }
                
            }
        });

    }


    function guardarConfiguracion(){

        if(username.val() == ''){
            warning.css('display', 'block');
            warning.text('Escriba un nombre de usuario');
            return false;
        }

        if(email.val() == ''){
            warning.css('display', 'block');
            warning.text('Escriba un correo primero');
            return false;
        }

        if(password.val() == '' || password2.val() == ''){
            warning.css('display', 'block');
            warning.text('Escriba una contraseña primero');
            return false;
        }

        if(password.val() != password2.val()){
            warning.css('display', 'block');
            warning.text('¡Las contraseñas deben ser iguales!');
            return false;
        }

        warning.css('display', 'none');
        warning.text('');

        $.ajax({
            type: "POST",
            url: "http://krysolite.test:8080/assets/php/api/updateUser.php",
            data: {username: username.val().toLowerCase(), email: email.val().toLowerCase(), password: password.val(),
            firstname: firstname.val(), lastname: lastname.val()},
            dataType: 'json',
            
            success: function(data){
                if(data.state == 'success'){
                    location.reload();
                }else{
                    warning.css('display', 'block');
                    warning.text(data.reason);
                    return false;
                }
            }
        });


    }


    function cerrarSesion(){
        $.ajax({
            type: "GET",
            url: "http://krysolite.test:8080/assets/php/api/logout.php",
            dataType: 'json',
            success: function(){

            }
        }).always(function(){
            $(location).attr('href', '/');
        })

        
    }


    cargarConfiguracion();
    console.log('Carga finalizada');


});