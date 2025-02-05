//--------------------------------------------------------
// Dependencias del módulo
//--------------------------------------------------------
import * as tabla from '../../js/componentes/tabla/tablaClass.mjs';
import * as controlTabla from '../../js/componentes/tabla/controlTabla.mjs';

/**
 * Exportaciones
 */

export
{
    inicializar
}

//--------------------------------------------------------
// Constantes
//--------------------------------------------------------

const TBODY_RESULTADO = $("#resultado");
const DIV_PAGINADOR = "#paginador";

const JSON2HTML_PLANTILLA_TABLA = {
      '<>': 'tr','html': [
      {'<>': 'th','scope':'row','html': '${id}'},
      {'<>': 'td','html': '${nombre}'},
      {'<>': 'td','html': '${descripcion}'},
      {'<>':'td','html':'<button name="btEditar" class="btn btn-info bi bi-pencil-fill" value="${id}"></button>'},
      {'<>':'td','html':'<button name="btEliminar" class="btn btn-danger bi bi-trash-fill" value="${id}"></button>'}
    ]
};

const TABLA = new tabla.tabla();

//-------------------------------------------------------
// Inicialización de la página de ingredientes
//-------------------------------------------------------

$("#ingredientes").ready(() => {

    $("#btnIngredientes").on('click', inicializar);

});

function inicializar() 
{
    controlTabla.inicializar(URL_INGREDIENTES, JSON2HTML_PLANTILLA_TABLA, TABLA, TBODY_RESULTADO, DIV_PAGINADOR);
}