// This file can be replaced during build by using the `fileReplacements` array.
// `ng build` replaces `environment.ts` with `environment.prod.ts`.
// The list of file replacements can be found in `angular.json`.

const IP_BASE = `localhost`;

export const environment = 
{
  production: false,

  //Port and protocol of connection to the info server
  URL_BASE: `http://${ IP_BASE }:3000/`,

  //Port and protocol for the images server
  URL_IMG_SERVER: `http://${ IP_BASE }:3001/`,

  DATA_PER_TABLE_PAGE: 10

}

export const urls =
{

  //Url of the base information of the high school
  URL_SCHOOLINFO: `${ environment.URL_BASE }schoolInfo`,

  //Urls of the users control 
  URL_REGISTER: `${ environment.URL_BASE }register`,
  URL_LOGIN: `${ environment.URL_BASE }login`,
  URL_USERS: `${ environment.URL_BASE }users`,
  URL_ALLUSERS: `${ environment.URL_BASE }allusers`,

  //Urls of the class control
  URL_CLASS: `${ environment.URL_BASE }class`,
  URL_ALLCLASSES: `${ environment.URL_BASE }allClasses`,

  //Urls of the image control
  URL_IMG_UPLOAD: `${ environment.URL_IMG_SERVER }upload/`,
  URL_IMG_DOWNLOAD: `${ environment.URL_IMG_SERVER }uploads/`

}
/*
 * For easier debugging in development mode, you can import the following file
 * to ignore zone related error stack frames such as `zone.run`, `zoneDelegate.invokeTask`.
 *
 * This import should be commented out in production mode because it will have a negative impact
 * on performance if an error is thrown.
 */
// import `zone.js/plugins/zone-error`,  // Included with Angular CLI.
