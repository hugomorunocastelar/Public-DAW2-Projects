/**
 * Script author = Hugo Moruno
 */

/**
 * Exports
 */

export
{
    init,
    sendForm
}

import * as start from '/js/components/loginForm/loginScript.mjs';

/**
 * Objects
 */

const OBJ_FORMCONTENT = '#loginContent';

/**
 * Main code
 */

function init() 
{
    start.loadForm(OBJ_FORMCONTENT);
}

function sendForm()
{
    console.log('formulario enviado');
}