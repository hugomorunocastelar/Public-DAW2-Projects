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

import * as startAlum from '../../js/components/alumForm/alumScript.mjs';
import * as startProf from '../../js/components/profForm/profScript.mjs';

/**
 * Objects
 */

const OBJ_FORMCONTENT = '#classesContent';

/**
 * Main code
 */

function init() 
{
    console.log(session.rol)
    if (session.rol == 'alum')
    {
        startAlum.loadForm(OBJ_FORMCONTENT);
    }
    else 
    {
        startProf.loadForm(OBJ_FORMCONTENT);
    }

};