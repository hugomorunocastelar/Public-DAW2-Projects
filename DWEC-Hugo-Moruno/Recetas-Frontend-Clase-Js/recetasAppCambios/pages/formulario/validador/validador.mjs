/**
 * Exportaciones
 */

export
{
    validar
}

/**
 * Constantes
 */

const validadores = 
{
    '01vacio': /^.+$/,
    '02numero': /^[0-9]+$/,
    '03de3a20': /^.{3,20}$/
};

/**
 * Variables
 */

var errores = [];

/**
 * Funciones de validación
 */

function validar(campo)
{
    errores = [];
    var validadoresCampo = campo.attr('validar').split(',');
    var valorCampo = campo.val().trim();

    validadoresCampo.forEach(validacion => {
        cumple(validacion, valorCampo)
        ?
        errores.push(validacion)
        :
        null
        ;
    });

    return errores;
}

function cumple(tipo, campo)
{
    var regex = validadores[tipo];
    return regex.test(campo.value);
}