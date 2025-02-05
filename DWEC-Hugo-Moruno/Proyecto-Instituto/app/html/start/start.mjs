/**
 * Script author = Hugo Moruno
 * 
 * Creation date = 7/11/2024
 */

/**
 * Exports
 */

export
{
    init,
    sendForm
}

import * as start from '/js/components/startForm/startScript.mjs';

/**
 * Objects
 */

const OBJ_FORMCONTENT = '#startContent';
const BTN_SAVEFORM = '#saveButton';

/**
 * Main code
 */

function init() 
{
    start.loadForm(OBJ_FORMCONTENT, BTN_SAVEFORM);
};

function sendForm()
{
    console.log('formulario enviado');
}