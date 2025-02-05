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
    init
}

import * as start from '/js/components/adminForm/adminScript.mjs';

/**
 * Objects
 */

const OBJ_FORMCONTENT = '#adminContent';

/**
 * Main code
 */

function init() 
{
    start.loadForm(OBJ_FORMCONTENT, true);
};