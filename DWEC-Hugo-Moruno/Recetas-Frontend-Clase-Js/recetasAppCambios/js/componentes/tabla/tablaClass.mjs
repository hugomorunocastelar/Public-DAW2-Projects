//--------------------------------------------------------
// Dependencias del módulo
//--------------------------------------------------------
export 
{
    tabla
}

const worker = new Worker('./js/lib/wworkers/ww_peticion.mjs', { type: "module" });

/**
 * Clase tabla.
 */

class tabla {
    //Número de página actual, por defecto 1.
    pagina = 1;

    //Contenido html
    html = null;

    //Objeto de respuesta de la librería http
    #objetoResponse = null;

    //Plantilla según la que se rige la tabla
    plantillaTabla = null;

    //Gaurda la url si no hay ninguna.
    savedUrl = null;

    constructor() {}

    //Formatea y devuelve el objeto html
    crearTabla(url = this.savedUrl, plantilla = this.plantillaTabla, filtro = '', numeroPagina = 1)
    {
        // debugger;
        //Gaurda los datos para no tener que llamarlos otra vez
        this.savedUrl = url;
        this.plantillaTabla = plantilla;
        this.pagina = numeroPagina;

        const formatedUrl = `${url}?_page=${numeroPagina}&_limit=${TABLA_REGISTROS_POR_PAGINA}`;
        const filteredUrl = (filtro.length == 0)?formatedUrl:`${formatedUrl}&q=${filtro}`;
        return this.obtenerDatos(filteredUrl)
                .then(() => {
                    this.formatearDatos(plantilla);
                    return this.html;
                });
    }

    //Obtener los datos del servidor
    obtenerDatos(url)
    {
        return new Promise((resolve, reject) => {
            const wwMensaje = (event) => {
                const { success, data, error } = event.data;

                if (success) {
                    this.#objetoResponse = data;
                    console.log(this.#objetoResponse);
                    resolve(data);
                } else {
                    console.error("Error desde el Worker:", error);
                    reject(error);
                }

                worker.removeEventListener("message", wwMensaje);
            };

            worker.addEventListener("message", wwMensaje);
            worker.postMessage(url);
        });
    }

    //Formatea el objeto json a un objeto jquery
    formatearDatos(plantilla)
    {
        this.html = json2html.render(this.#objetoResponse, plantilla);
    }

    //Accede a la página anterior
    anterior()
    {
        if(this.pagina > 1)
        {
            return this.crearTabla( this.savedUrl, this.plantillaTabla, this.pagina-1);
        }
    }

    //Accede a la página siguiente
    siguiente()
    {
        return this.crearTabla( this.savedUrl, this.plantillaTabla, this.pagina+1)
    }
}