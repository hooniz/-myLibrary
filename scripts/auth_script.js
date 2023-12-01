$( "#authForm" ).submit(function( event ) {
    event.preventDefault();
    if($('#inputLogin').val() != "" && $('#inputPassword').val() != "")
    {
        $("#alert").addClass("d-none");
        $.ajax({
            url: '/auth/do/',
            method: 'post',
            dataType: 'json',
            data: {
                login: $('#inputLogin').val(),
                password: $('#inputPassword').val()
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
                    window.location.href = "/";
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