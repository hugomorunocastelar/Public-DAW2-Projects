
import * as utils from '../../js/utils.mjs';

/**
 * Inicialización
 */

$(document).ready(()=>{

    $('#btnVolver').on('click', onBtnVolver);
    $('#btnGuardar').on('click', onBtnGuardar);

});

/**
 * Funciones de eventos
 */

//Salir del formulario
function onBtnVolver()
{
    utils.loadPage(utils.URL_PAGINA('recetas'));
}
//Guardar los datos del formulario
function onBtnGuardar()
{
    
}