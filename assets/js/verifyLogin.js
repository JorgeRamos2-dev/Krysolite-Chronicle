$(document).ready(function(){

    const usericon = $('.far.fa-user');
    const parentContainer = usericon.parent();
    const profile = parentContainer.find('img');

    const url = '../user/custom.html';
    const linker = parentContainer.parent();

    $.ajax({
        type: "GET",
        url: "http://krysolite.test:8080/assets/php/api/getUser.php",
        dataType: 'json',
        success: function(data){
            usericon.toggle('display');
            profile.toggle('display');

            profile.attr('src', data.profile);
            linker.attr('href', url);
        }
    });



});