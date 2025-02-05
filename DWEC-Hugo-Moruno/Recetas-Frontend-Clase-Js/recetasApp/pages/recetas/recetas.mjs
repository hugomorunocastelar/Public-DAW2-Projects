//--------------------------------------------------------
// Dependencias del módulo
//--------------------------------------------------------
import * as tabla from '../../js/componentes/tabla/tablaClass.mjs';
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

/*$(document).ready(() => {
    inicializar();
    $("#btBuscar").on("click", onBotonBuscarClick);
    $("#btAnadir").on("click", onBotonAñadirClick);

    $(TBODY_RESULTADO).on('click', '[name=btEliminar]', onEliminarClick);
    $(TBODY_RESULTADO).on('click', '[name=btEditar]', onEditarClick);  
});*/

function inicializar() 
{
    controlTabla.inicializar(URL_RECETAS, JSON2HTML_PLANTILLA_TABLA, TABLA, TBODY_RESULTADO, DIV_PAGINADOR);
    $("#btBuscar").on("click", onBotonBuscarClick);
    $("#btAnadir").on("click", onBotonAñadirClick);

    $(TBODY_RESULTADO).on('click', '[name=btEliminar]', onEliminarClick);
    $(TBODY_RESULTADO).on('click', '[name=btEditar]', onEditarClick); 
}

//-------------------------------------------------------
// Gestores de eventos
//-------------------------------------------------------
/**
 * Gestiona los clicks sobre el botón buscar
 */
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
    utils.loadPage(utils.URL_PAGINA("receta_edit", 'recetas'));
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