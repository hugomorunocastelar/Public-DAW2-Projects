/**
 * Script author = Hugo Moruno
 */ 

/**
 * Exports
 */
export { send, sendAuth, update, sendImg, tryLogin, get, del };

/**
 * Send data to the server. Conerting the js objecto to json.
 * 
 * @param {String} url Url where the data is send to
 * @param {Object} data Body of the post petition
 * @returns {Promise} Returns a promise with wich is worked after 
 * */
function send(url, data)
{
    return fetch(url, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
    });
}

/**
 * Send data to the server. Conerting the js object to json.
 * In this case, it gets the auth token and uses it.
 * 
 * @param {String} url Url where the data is send to
 * @param {Object} data Body of the post petition
 * @returns {Promise} Returns a promise with wich is worked after 
 * */
function sendAuth(url, data)
{
    return fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${session.jwtToken}`,
        },
        body: JSON.stringify(data),
    });
}

/**
 * Updates the data of some object. 
 * Its has to be obligatory logged.
 * Receives and object that lately is converted to json.
 * 
 * @param {String} url Url where the data is updated
 * @param {Object} data Data to update
 * @returns {Promise} Returns a promise with wich is worked after 
 */
function update(url, data)
{
    return fetch(url, {
        method: "PATCH",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${session.jwtToken}`,
        },
        body: JSON.stringify(data),
    });
}
/**
 * Sends a image to the :3001 express server.
 * 
 * @param {String} url Url where the data is send to.
 * @param {File} data In this case, the data sended si an Image.
 * @returns {Promise} Returns a promise with wich is worked after 
 */
function sendImg(url, data)
{
    return fetch(url, { method: "POST", body: data });
}

/**
 * It returns the data of the login if its token its correct.
 * 
 * @param {String} url Url where the data is send to.
 * @returns {Promise} Returns a promise with wich is worked after 
 */
function tryLogin(url)
{
    return fetch(url, {
        headers: { Authorization: `Bearer ${session.jwtToken}` },
    });
}

/**
 * It gets the data of a concret table.
 * 
 * @param {String} url Url where the data is getted from.
 * @returns {Promise} Returns a promise with wich is worked after 
 */
function get(url)
{
    return fetch(url);
}

/**
 * Sends a DELETE method to delete an object from a table.
 * It has to be logged to do it.
 * 
 * @param {String} url Url where the data is deleted from.
 * @param {int} id The id of the object that is wanted to be deleted.
 * @returns {Promise} Returns a promise with wich is worked after 
 */
function del(url, id)
{
    return fetch(url + "/" + id, {
        method: "DELETE",
        headers: { Authorization: `Bearer ${session.jwtToken}` },
    });
}
