/**
 * Script author = Hugo Moruno
 * 
 * Creation date = 7/11/2024
 */

/**
 * Imports
 */

import * as http from '../../js/lib/http.mjs';
import * as pag from '../../js/pages.mjs';

/**
 * Exports
 */

export
{
    init
}

/**
 * Objects
 */

const OBJ_WELCTEXT = '#cardWelcome';
const OBJ_HIWTEXT = '#cardHiw';
const OBJ_SCHOOLNAME = '#schoolName';
const OBJ_SCHOOLADDRESS = '#schoolAddress';

const HREF_WELCOME = '#welcome';
const HREF_HIW = '#hiw';

/**
 * Main code
 */

function init() 
{
    // console.log('charged')
    getArticlesInfo();
    putArticlesAction();
    setSchoolInfo();
};

/**
 * Functions
 */

function getArticlesInfo()
{
    http.get(URL_WELCOMETEXT)
        .then(response => response.json())
        .then(data =>
        {
            $(OBJ_WELCTEXT).text(data.welcomeText);
        });

    http.get(URL_HIWTEXT)
        .then(response => response.json())
        .then(data =>
        {
            $(OBJ_HIWTEXT).text(data.hiwText);
        });
}

function putArticlesAction()
{
    $(HREF_WELCOME).click(function ()
    {
        pag.loadPage('howitworks', $('#pageContent'), true)
    });
    $(HREF_HIW).click(function ()
    {
        pag.loadPage('welcome', $('#pageContent'), true)
    });
}

function setSchoolInfo()
{
    http.get(URL_SCHOOLNAME)
        .then(response => response.json())
        .then(data =>
        {
            $(OBJ_SCHOOLNAME).text(data.schoolName);
        });

    http.get(URL_SCHOOLADDRESS)
        .then(response => response.json())
        .then(data =>
        {
            $(OBJ_SCHOOLADDRESS).text(data.schoolAddress);
        });
}