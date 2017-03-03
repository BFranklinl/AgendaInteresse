$(document).ready(function(){
    var $form = $('#formEditContacto');
   $form.bootstrapValidator({
        framework: 'bootstrap',
        live: 'submitted',
        verbose: false,
        fields: {
            nombre: {
                validators: {
                    notEmpty:{
                        message: 'Campo Nombre obligatorio'
                    },
                    stringLength: {
                        max: 100,
                        message: 'La longitud del campo Nombre es de máximo 100 caracteres.'
                    }
                }
            },
            correoElectronico: {
                validators: {
                    notEmpty:{
                        message: 'El campo Correo electrónico obligatorio'
                    },
                    emailAddress:{
                        message: 'El campo Correo electrónico no contiene el formato.'
                    },
                    string: {
                        max: 80,
                        message: 'La longitud del campo Correo electrónico es de máximo 80 caracteres.'
                    }
                }
            },
            telefono: {
                validators: {
                    integer: {
                        message: 'No es un número telefónico'
                    },
                    stringLength: {
                        min: 8,
                        max: 10,
                        message: 'La longitud del teléfono debe ser de 8 a 10 dígitos'
                    }
                }
            },
            calle:{
                validators: {
                    stringLength: {
                        max: 60,
                        message: 'La longitud del campo Calle es de máximo 60 caracteres.'
                    }
                }
            },
            colonia:{
                validators: {
                    stringLength: {
                        max: 60,
                        message: 'La longitud del campo Colonia es de máximo 60 caracteres.'
                    }
                }
            },
            numInt:{
                validators: {
                    stringLength: {
                        max: 45,
                        message: 'La longitud del campo Número int. es de máximo 45 caracteres.'
                    }
                }
            },
            numExt:{
                validators: {
                    stringLength: {
                        max: 45,
                        message: 'La longitud del campo Número ext. es de máximo 45 caracteres.'
                    }
                }
            },
            delegacion:{
                validators: {
                    stringLength: {
                        max: 45,
                        message: 'La longitud del campo Delegacion es de máximo 45 caracteres.'
                    }
                }
            },
            entidadFederativa:{
                validators: {
                    stringLength: {
                        max: 45,
                        message: 'La longitud del campo Entidad federativa es de máximo 45 caracteres.'
                    }
                }
            },
            pais:{
                validators: {
                    stringLength: {
                        max: 70,
                        message: 'La longitud del campo País es de máximo 70 caracteres.'
                    }
                }
            }
        }
    }).on('success.form.bv', function(e){
        e.preventDefault();
        saveContacto();
    });

    $('.addTelefono').on('click', function(){
        var $input = $form.find('input[name=telefono]').last();
        var $new = $input.clone();
        $input.after($new.val(''));
    });
});