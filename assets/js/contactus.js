
$(document).ready(function(){

    const name = $('#name');
    const email = $('#email');
    const phone = $('#phone');
    const message = $('#message');

    const submitBtn = $('#sendMessageButton');
    const warning = $('#error');

    let form = [name, email, phone, message];


    submitBtn.click(submitForm);


    for( i in form){
        form[i].change(function(){$(this).css('border-color', ''); $(this).css('border', '')});
    }

    function submitForm(){

        for(i in form){
            if(form[i].val() == ""){
                form[i].css('border', '2px solid');
                form[i].css('border-color', 'red');
            }
        }


        if( !email.val().includes('@') || !email.val().includes('.')){
            warning.css('display', 'block');
            warning.css('color', 'red');
            warning.text('Ingrese un correo electrónico válido');
            return false;
        }else{
            warning.css('display', 'none');
            warning.text('');
        }

        
        $.ajax({
            type: "POST",
            url: "http://krysolite.test:8080/assets/php/api/createMessage.php",
            data: {name: name.val(), email: email.val().toLowerCase(), phone: phone.val(), message: message.val()},
            dataType: 'json',
            
            success: function(data){
                if(data.state == 'fail'){
                    warning.css('display', 'block');
                    warning.css('color', 'red');
                    warning.text(data.reason);
                }else{
                    console.log('Mensaje guardado');
                    warning.css('display', 'block');
                    warning.css('color', 'green');
                    warning.text("Mensaje enviado");

                    for(i in form){
                        form[i].val('');
                    }
                }
                
            }
        });


    }





});







