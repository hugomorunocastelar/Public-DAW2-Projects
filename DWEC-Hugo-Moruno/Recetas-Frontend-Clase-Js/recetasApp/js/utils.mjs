/**
 * Variables.
 */
const WORKSPACE = $('#workspace');
const ENLACES = $('[page]');
const PAG_CONTROL = "cuadro_mandos";

/**
 * Exportaciones
 */

export 
{
    loadPage, 
    URL_COMPONENTE_JS,
    URL_COMPONENTE_PLANTILLLA,
    URL_PAGINA
}

/**
 * Main.
 */
$(window).on('load', function(){
    loadPage(URL_PAGINA(PAG_CONTROL))
    ENLACES.each(function()
    {
        $(this).on('click', function(e) {
            const page = $(this).attr('page');
            loadPage(URL_PAGINA(page), cargarPagina(page));
        });
    });
});

/**
 * Funciones de utilidad.
 */
function loadPage(url, inicializar) 
{
    WORKSPACE.empty();
    WORKSPACE.load(url, inicializar);
}

function cargarPagina(page) {
    import(URL_PAGINA_JS(page)).then(module => module.inicializar());
}

/**
 * Autoobtención de rutas para cargar páginas.
 */

function URL_PAGINA(page, carpeta = page)
{
    return `${PAGES_ROOT}/${carpeta}/${page}.html`;
}

function URL_PAGINA_JS(page, carpeta = page)
{
    return `../${PAGES_ROOT}/${carpeta}/${page}.mjs`;
}

function URL_COMPONENTE_JS(nombre, carpeta = nombre) 
{
    return `${COMPONENTES_ROOT}/${carpeta}/${nombre}.mjs`
}

function URL_COMPONENTE_PLANTILLLA(nombre, carpeta = nombre) 
{
    return `${COMPONENTES_ROOT}/${carpeta}/${nombre}.html`
}