/**
 * Imports
 */

import * as validador from './validador/validador.mjs';

$(document).ready(() => {
    $('#submit').on('click', (form) => {
        validarFormulario(form)
    });
});

function validarFormulario(form)
{
    var inputs = $('input[validar]');
    inputs.each(function(){
        const errores = validador.validar($(this));
        debugger
        if(errores.length > 0)
        {
            form.preventDefault();
            console.log(errores);
        }
    });
}