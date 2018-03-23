$(document).ready(function() {

    var refreshTimeout = 5000;

    $('body').on('click', '#refresh-btn', function(e) {
        $(e.target).html('<span class="glyphicon glyphicon-time"></span> Загрузка').attr('disabled', true);
    });

    setInterval(function() {
        $('#refresh-btn').click();
    }, refreshTimeout);

});