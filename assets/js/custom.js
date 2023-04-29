$(document).ready(function(){


    const btnBorrar = $('#submitBtn-1');
    const btnGuardar = $('#submitBtn');
    const btnLogout = $('#submitBtn-2');


    btnBorrar.click(borrarUsuario);

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


    }


    function cerrarSesion(){
        

    }



    console.log('Carga finalizada');


});