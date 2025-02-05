
/**
 * Importaciones
 */
import * as controlTabla from '../../js/componentes/tabla/controlTabla.mjs';
import * as modal from '../../js/componentes/modal/modal.mjs';
import * as toast from '../../js/componentes/toast/toast.mjs';
import * as http from '../../js/lib/http.mjs'
import * as utils from '../../js/utils.mjs';

/**
 * Exportaciones
 */

export
{
    activarBotones
}

var TBODY_RESULTADO = null;
var DIV_PAGINADOR = null;
var JSON2HTML_PLANTILLA_TABLA = null;
var TABLA = null;

/**
 * Funciones de la página recetas.
 */

function activarBotones(TBODY, DIV, JS2HTML, TABLA)
{

    TBODY_RESULTADO = TBODY;
    DIV_PAGINADOR = DIV;
    JSON2HTML_PLANTILLA_TABLA = JS2HTML;

    $("#btBuscar").on("click", onBotonBuscarClick);
    $("#btAnadir").on("click", onBotonAñadirClick);

    $(TBODY_RESULTADO).on('click', '[name=btEliminar]', onEliminarClick);
    $(TBODY_RESULTADO).on('click', '[name=btEditar]', onEditarClick); 
}

function onBotonBuscarClick() {
    // Obtengo el filtro
    const filtro = $("#iFiltro").val();

    // Aplico el filtro a la tabla
    controlTabla.inicializar(URL_RECETAS, JSON2HTML_PLANTILLA_TABLA, TABLA, TBODY_RESULTADO, DIV_PAGINADOR, filtro);
}

/**
 * Evento añadir receta
 */
function onBotonAñadirClick() {
    utils.loadPage(utils.URL_PAGINA("formulario_recetas", 'formulario'));
}

/** 
 * Se va a eliminar un registro 
 */
function onEliminarClick(evento) {
    // Obtengo el identificador de la receta a eliminar
    const id=evento.target.value;
    modal.preguntar(
        "¿Está seguro de que desea eliminar el registro?", 
        () => {
            http.del(URL_RECETAS, id)
            .then(() => {
                toast.mostrar("Receta eliminada");
                //tabla.recargar(TBODY_RESULTADO);
            });
        }
    );
}

/** 
 * Se va a editar un registro 
 */
function onEditarClick(evento) {
    console.log("Editar");
}