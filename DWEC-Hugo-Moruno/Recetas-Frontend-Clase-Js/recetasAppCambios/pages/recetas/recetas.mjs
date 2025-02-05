//--------------------------------------------------------
// Dependencias del módulo
//--------------------------------------------------------
import * as tabla from '../../js/componentes/tabla/tablaClass.mjs';
import * as controlTabla from '../../js/componentes/tabla/controlTabla.mjs';
import * as controlRecetas from './recetas_control.mjs';

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

const TBODY_RESULTADO = "#resultado";
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
// Inicialización de la página de recetas
//-------------------------------------------------------

function inicializar() 
{
    controlTabla.inicializar(URL_RECETAS, JSON2HTML_PLANTILLA_TABLA, TABLA, TBODY_RESULTADO, DIV_PAGINADOR);
    controlRecetas.activarBotones(TBODY_RESULTADO, DIV_PAGINADOR, JSON2HTML_PLANTILLA_TABLA, TABLA);
}