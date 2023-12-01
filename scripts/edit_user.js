$(function($) {
    $("#inputPhone").mask("+7 (999) 999-9999",{placeholder:"_"});
});
$('.alert-close').on('click', function(e) {
    $('.alert').css("display", "none");
});
