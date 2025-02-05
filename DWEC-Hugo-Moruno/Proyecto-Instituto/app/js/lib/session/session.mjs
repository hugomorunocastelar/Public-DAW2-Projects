/**
 * Script author = Hugo Moruno
 */

/**
 * Exports
 */
export { trySession, closeSession, saveSession, configMenuFromRole };

/**
 * Imports
 */
import * as http from "../http.mjs";
import * as pag from "../../pages.mjs";

/**
 * Tries to login, then returns the promise
 * 
 * @returns {Promise} Returns the tries of the login
 */
function trySession()
{
    //If there's a previous login, then loads the last
    if (localStorage.getItem("token") != null)
    {
        //Loads the localStorage into the env.session
        getLocalStorage();
    }

    //Makes the login try, and then returns the observable result
    return http.tryLogin(URL_USERS + `/${ session.id }`);
}

/**
 * Closses the session. To do it, cleans the variables and the Menú.
 */
function closeSession()
{
    //Cleans the session variables
    session = {
        jwtToken: "",
        classes: [],
        email: "",
        name: "",
        rol: "",
        age: 0,
        id: "",
    };

    //Cleans the localStorage
    cleanLocalStorage();

    //Sets the menú to the role :<empty>
    configMenuFromRole(session.rol);

    //Loads the email to the Menú box
    $("#loginEmail").text("");

    //Loads the menú page
    pag.loadPage("home", $("#pageContent"));
}

/**
 * Formats the clases of the user to a string to save them into the browser
 * 
 * @returns {String} Returns the String of the classes
*/
function saveClasses()
{
    let classesList = "";
    
    //For every class, loads the id into the String
    for (let clas of session.classes)
        {
            classesList = classesList + clas.id + ",";
        }
        
        return classesList;
    }
    
/**
 * 
 * @param {String} classesList It admits the string with the classes Id, and
 * converts it to a object
 * @returns {Object} Returns a object with the formatted clases of the String
*/
function getClasses(classesList)
{
    let classesObj = [];
    
    //Formatts the String into a Object
    for (let classId of classesList.split(","))
    {
        if (classId != null && classId != "")
        {
            classesObj.push({ id: classId });
        }
    }
    return classesObj;
}

/**
 * Saves the session data into the browser
*/
function saveSession()
{
    localStorage.setItem("token", session.jwtToken),
    localStorage.setItem("classes", saveClasses()),
    localStorage.setItem("email", session.email),
    localStorage.setItem("name", session.name),
    localStorage.setItem("rol", session.rol),
    localStorage.setItem("age", session.age),
    localStorage.setItem("id", session.id);
}

/**
 * Gets the session data from the browser
*/
function getLocalStorage()
{
    session = {
        jwtToken: localStorage.getItem("token"),
        classes: getClasses(localStorage.getItem("classes")),
        email: localStorage.getItem("email"),
        name: localStorage.getItem("name"),
        rol: localStorage.getItem("rol"),
        age: localStorage.getItem("age"),
        id: localStorage.getItem("id"),
    };
}
     
/**
 * Cleans the localStorage
 */
function cleanLocalStorage()
{
    localStorage.setItem("token", ""),
    localStorage.setItem("classes", ""),
    localStorage.setItem("email", ""),
    localStorage.setItem("name", ""),
    localStorage.setItem("rol", ""),
    localStorage.setItem("age", ""),
    localStorage.setItem("id", "");
}


/**
 * Sets the menu options according to the rol of the user
 * 
 * @param {String} rol Rol of the user
 */
function configMenuFromRole(rol)
{

    const home = $("#idHomeIndex");
    const admin = $("#idAdminIndex");
    const roles = $("#idRolesIndex");
    const control = $("#idControlClassesIndex");
    const profile = $("#idProfileIndex");
    const classes = $("#idClassesIndex");
    const login = $("#idLoginIndex");
    const start = $("#idStartIndex");
    const logout = $("#idLogoutIndex");

    switch (rol)
    {
        case "admin":
            showOption(home, "yes");
            showOption(admin, "yes");
            showOption(roles, "yes");
            showOption(control, "yes");
            showOption(profile, "yes");
            showOption(classes, "no");
            showOption(login, "no");
            showOption(start, "yes");
            showOption(logout, "yes");
            break;
        case "prof":
            showOption(home, "yes");
            showOption(admin, "no");
            showOption(roles, "no");
            showOption(control, "no");
            showOption(profile, "yes");
            showOption(classes, "yes");
            showOption(login, "no");
            showOption(start, "no");
            showOption(logout, "yes");
            break;
        case "alum":
            showOption(home, "yes");
            showOption(admin, "no");
            showOption(roles, "no");
            showOption(control, "no");
            showOption(profile, "yes");
            showOption(classes, "yes");
            showOption(login, "no");
            showOption(start, "no");
            showOption(logout, "yes");
            break;
        case "unassigned":
            showOption(home, "yes");
            showOption(admin, "no");
            showOption(roles, "no");
            showOption(control, "no");
            showOption(profile, "yes");
            showOption(classes, "no");
            showOption(login, "no");
            showOption(start, "no");
            showOption(logout, "yes");
            break;
        default:
            showOption(home, "yes");
            showOption(admin, "no");
            showOption(roles, "no");
            showOption(control, "no");
            showOption(profile, "no");
            showOption(classes, "no");
            showOption(login, "yes");
            showOption(start, "no");
            showOption(logout, "no");
            break;
    }
}

/**
 * Shows or hides the menu option
 * 
 * @param {JQuery object} obj Object of the menu option
 * @param {Boolean} YOrN true, shows it; false, hides it
 */
function showOption(obj, YOrN)
{
    YOrN == "yes" ? obj.removeClass("d-none") : obj.addClass("d-none");
}
