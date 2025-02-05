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

import * as start from '/js/components/rolesForm/rolesScript.mjs';

/**
 * Objects
 */

const OBJ_FORMCONTENT = '#rolesContent';

/**
 * Main code
 */

function init() 
{
    start.loadForm(OBJ_FORMCONTENT);
};