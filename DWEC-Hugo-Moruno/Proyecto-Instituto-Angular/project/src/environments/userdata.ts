
/**
 * Exports
 */
export { school_name, text_welcome, text_hiw, session, sessionStarted }

//School Info for the project
let school_name = 'I.E.S Castelar';
let text_welcome = 'example';
let text_hiw = 'example';

/**
 * Session data, used by session.mjs
 */
let session = {
    jwtToken: '',
    classes: [{}],
    email: '',
    name: '',
    rol: '',
    age: 0,
    id: 0
}
//true if its correctly logged
let sessionStarted = false;