$(document).ready(function(){
    if($.notify){
        $.notify.defaults({
            clickToHide: true,
            autoHide: true,
            autoHideDelay: 6000,
            arrowShow: true,
            arrowSize: 5,
            globalPosition: 'top center',
            style: 'bootstrap',
            className: 'info',
            gap: 2
        });
    }
});

$.ajaxSetup({
    cache: false,
    error: function(error){
        $.notify('Ocurrió un error: ' + error, 'warn');
    }
});