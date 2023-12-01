$( "#authForm" ).submit(function( event ) {
    event.preventDefault();
    if($('#inputLogin').val() != "" && $('#inputPassword').val() != "")
    {
        $("#alert").addClass("d-none");
        $.ajax({
            url: '/reg/do/',
            method: 'post',
            dataType: 'json',
            data: {
                login: $('#inputLogin').val(),
                password: $('#inputPassword').val(),
                passwordRepeat: $('#inputPasswordRepeat').val(),
                name: $('#inputName').val(),
                surname: $('#inputSurname').val(),
                lastname: $('#inputLastname').val(),
                phone: $('#inputPhone').val(),
                street: $('#inputStreet').val(),
                building: $('#inputBuilding').val(),
                apartments: $('#inputApartments').val(),
            },
            success: function(data){
                if(data.status === 'FAIL')
                {
                    message = '';
                    data.errors.forEach(function(item, i, arr) {
                        message += item + '<br>';
                    });
                    showErrors(message);
                }else
                {
                    window.location.href = "/auth/";
                }
            }
        });
    }else
    {
        showErrors("Вы не ввели логин или пароль");
    }
});
function showErrors(error)
{
    $("#alert").html(error);
    $("#alert").removeClass("d-none");
}
$(function($) {
    $("#inputPhone").mask("+7 (999) 999-9999",{placeholder:"_"});
})