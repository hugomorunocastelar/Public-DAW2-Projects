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

import * as start from '/js/components/profileForm/profileScript.mjs';

/**
 * Objects
 */

const OBJ_FORMCONTENT = '#profileContent';

/**
 * Main code
 */

function init() 
{
    start.loadForm(OBJ_FORMCONTENT);
};