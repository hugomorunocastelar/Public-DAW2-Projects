"use strict";
/**
 * Script author = Hugo Moruno
 */

/**
 * Global Settings by User
 */

//School Info for the project
let school_name = 'I.E.S Castelar';
let text_welcome = 'example';
let text_hiw = 'example';

/**
 * Session data, used by session.mjs
 */
let session = {
    jwtToken: '',
    classes: [],
    email: '',
    name: '',
    rol: '',
    age: 0,
    id: ''
}
//true if its correctly logged
let sessionStarted = false;

/**
 * URLs
 */

//IP of the server
const IP_BASE = 'localhost'

//Port and protocol of connection to the info server
const URL_BASE = `http://${ IP_BASE }:3000/`;

//Urls of the base information of the high school
const URL_SCHOOLNAME = `${ URL_BASE }` + 'schoolName';
const URL_SCHOOLADDRESS = `${ URL_BASE }` + 'schoolAddress';
const URL_WELCOMETEXT = `${ URL_BASE }` + 'welcomeText';
const URL_HIWTEXT = `${ URL_BASE }` + 'hiwText';

//Urls of the users control 
const URL_REGISTER = `${ URL_BASE }` + 'register';
const URL_LOGIN = `${ URL_BASE }` + 'login';
const URL_USERS = `${ URL_BASE }` + 'users';
const URL_ALLUSERS = `${ URL_BASE }` + 'allusers';

//Urls of the class control
const URL_CLASS = `${ URL_BASE }` + 'class';
const URL_ALLCLASSES = `${ URL_BASE }` + 'allClasses';
const ULR_PROF = `${ URL_ALLUSERS }` + '?rol=prof';
const ULR_ALUM = `${ URL_ALLUSERS }` + '?rol=alum';

//Port and protocol for the images server
const URL_IMG_SERVER = `http://${ IP_BASE }:3001/`

//Urls of the image control
const URL_IMG_UPLOAD = `${ URL_IMG_SERVER }` + 'upload/'
const URL_IMG_DOWNLOAD = `${ URL_IMG_SERVER }` + 'uploads/'

/**
 * Pages
 */

//Project files urls
const URL_ROOT = '/';
const URL_PAGES = `${ URL_ROOT }` + 'html/';
const URL_SCRIPTS = `${ URL_ROOT }` + 'js/';
const URL_COMPONENTS = `${ URL_SCRIPTS }` + 'components/';

/**
 * Table
 */
const TABLE_DATA_PER_PAGE = 10;