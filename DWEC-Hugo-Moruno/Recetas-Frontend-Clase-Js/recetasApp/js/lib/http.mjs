
// Exportaciones del módulo
export 
{
    get,
    del
};

/**
 * Petición de tipo get al servidor
 * 
 * @param {} url URL del recurso a descargar
 */
function get(url) {
    return fetch(url);
}

function del(url, id) {
    return fetch(url+'/'+id, { method: 'DELETE' })
}