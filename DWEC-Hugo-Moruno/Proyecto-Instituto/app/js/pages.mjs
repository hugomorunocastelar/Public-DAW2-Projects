/**
 * Script author = Hugo Moruno
 */

/**
 * Imports
 */
import * as sess from "./lib/session/session.mjs";

/**
 * Exports
 */
export { routes, loadPage };

/**
 * Get the route attr. and charges the content using @function (loadPage)
 * 
 * @param btn Button pressed
 * @param pagecontent Object where the content is loaded
 */
function routes(btn, pagecontent)
{
    let route = btn.attr("route");
    loadPage(route, pagecontent);
}

/**
 * Get the page by the name parametter and loads it in the pagecontent
 * If it is and article, searchs it in another directory
 * 
 * @param {String} page Name of the page to load
 * @param {JQuery Object} pagecontent Object where the content is loaded
 * @param {Boolean} article if the page is an article or not
 */
function loadPage(page, pagecontent, article = false)
{
    let urlPage;
    article ? (urlPage = GET_URL_ARTICLE(page)) : (urlPage = GET_URL_PAGE(page));

    //Checks if the user is correctly logged.
    checkLogin();

    //Charges the module init() method by importing the module script.
    pagecontent.load(urlPage, () =>
    {
        loadInit(page);
    });
}

/**
 * Charges the module init() method by importing the module script.
 * 
 * @param {String} page 
 */
function loadInit(page)
{
    import(GET_URL_PAGE_JS(page)).then((module) => module.init());
}

/**
 * Checks if the login is correctly setted and is valid. Calling the saved
 * data and then passing it to the trySession() method to validate it.
 * 
 * If the session is valid, it allows the last charged page of the loadPage 
 * method, if not, it charges the home page, cleans the session and charges
 * the default page.
 */
function checkLogin()
{
    //If the loging sessions is setted, then tries to login.
    if (session.jwtToken != "" || localStorage.getItem("token") != "")
    {
        sess
            .trySession()
            .then((response) =>
            {
                if (!response.ok)
                {
                    throw new Error();
                }
            })
            //If there's an error while login, it closes the session and,
            //charges the default data. (Empty)
            .catch((error) =>
            {
                sess.closeSession();
                console.error("Invalid session data.");
            });
    }
}

/**
 * Auto get contents Url's.
 */

/**
 * Get the page project url.
 * 
 * @param {String} page Page title
 * @param {String} directory Directory, if its empty, then gets the same value as page
 * @returns {String} The page local url.
 */
function GET_URL_PAGE(page, directory = page)
{
    return `${URL_PAGES}${directory}/${page}.html`;
}

/**
 * Get the page project script url.
 * 
 * @param {String} page Page title
 * @param {String} directory Directory, if its empty, then gets the same value as page
 * @returns {String} The page script local url.
 */
function GET_URL_PAGE_JS(page, directory = page)
{
    return `${URL_PAGES}${directory}/${page}.mjs`;
}

/**
 * Get the page of an article url.
 * 
 * @param {String} page Page title
 * @param {String} directory Directory, if its empty, then gets the same value as page
 * @returns {String} The page of an article url.
 */
function GET_URL_ARTICLE(page, directory = page)
{
    return `${URL_PAGES}articles/${directory}/${page}.html`;
}
