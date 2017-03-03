function loadList(){
    var $content = $('#list-contactos');
    $.ajax({
        url: baseUrl + '/agenda/list',
        dataType: 'html',
        success: function(data){
            $content.html(data);
        }
    });
}

function editContacto(id){
    var $modal = $('#mdEditar');
    var $body = $modal.find('.modal-body');
    var header;
    if (typeof id !== 'undefined') {
        header = 'Editar contacto';
        id = '?id=' + id;
    } else {
        header = 'Agregar contacto';
        id = '';
    }
    $modal.find('.modal-header h4').text(header);
    $.ajax({
        url: baseUrl + '/agenda/edit' + id,
        dataType: 'html',
        type: 'get',
        success: function(data){
            $body.html(data);
        }
    });
    $modal.modal('show').on('hidden.bs.modal', function(){
        $body.empty();
    });
}

function saveContacto(id) {
    var $modal = $('#mdEditar');
    var $form = $('#formEditContacto');
    var $button = $form.find('button[type=submit]');
    if (typeof id === 'undefined') {
        id = '';
    } else {
        id = '?id=' + id;
    }
    $.ajax({
        url: $form.attr('action'),
        dataType: 'json',
        data: $form.serializeArray(),
        type: 'post',
        beforeSend: function(){
            $button.prop('disabled', true);
        },
        success: function(data){
            switch (data.error) {
                case ERROR_OK:
                    loadList();
                    $.notify('Registro exitoso.', 'success');
                    $modal.modal('hide').on('hidden.bs.modal', function(){
                        $button.prop('disabled', false);
                    });
                    break;
                case ERROR_FAIL:
                default:
                    $.notify('Ocurrió un problema.', 'warn');
                    $button.prop('disabled', false);
                    break;
            }
        }
    });
    
}