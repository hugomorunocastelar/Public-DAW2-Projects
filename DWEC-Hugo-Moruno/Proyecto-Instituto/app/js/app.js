/**
 * Script author = Hugo Moruno
 */

/**
 * Imports
 */
import * as http from './lib/http.mjs';
import * as sess from './lib/session/session.mjs';
import * as pag from './pages.mjs';

/**
 * Objects
 */
const OBJ_PAGECONTENT = $('#pageContent');
const OBJ_INFOBLOCK = $('.infoBlock');

/**
 * Buttons
 */
const BTN_NAVITEM = $('a');
const BTN_INFOBLOCKCLOSE = $('.infoBlockClose');
const BTN_LOGOUT = $('#idLogoutIndex');

/**
 * Main code. Execution time
 */
$(window).ready(() =>
{

    //Searchs for the user-session token if it exists inside the browser
    if (localStorage.getItem('token') != '')
    {
        sess.configMenuFromRole(localStorage.getItem('rol'));
    }

    //Starting page --home--
    pag.loadPage('home', OBJ_PAGECONTENT);

    //After the home loads, puts the user email beside the logout button
    if (localStorage.getItem('token') != '')
    {
        $('#loginEmail').text(session.email);
    }

    //Adding the navbar function to change the page content of the pressed button
    BTN_NAVITEM.on('click', (btn) =>
    {
        pag.routes($(btn.target), OBJ_PAGECONTENT)
    });

    //Sets the close action to the close button of the toast page
    BTN_INFOBLOCKCLOSE.on('click', hideInfo);

    //Closes the session
    BTN_LOGOUT.on('click', sess.closeSession);

    //Searchs for the school info
    http.get(URL_SCHOOLNAME)
        .then(response => response.json())
        .then(response =>
        {
            school_name = response.schoolName;
        })
        .catch(error => console.error('Error:', error));

});

/**
 * Functions
 */

/**
 * Hides the toast page
 */
function hideInfo()
{
    OBJ_INFOBLOCK.addClass('d-none');
}