export const environment = {
  production: true,

  // URL Base de los servicios de taskman
  recetasBackendUrl: 'http://localhost:3000', 

  // Número que corresponde con la primera página en una consulta paginada
  paginaInicial: 1,

  // Registros por página
  numeroRegistrosPorPagina: 4,

  // Tiempo en milisegundos que un usuario debe estar sin pulsar una tecla
  // para que se acepte la entrada para lanzar por ejemplo un desplegable
  userInputDebounceDelay: 500,
 
  // Activa el modo depuración. Desactiva la autenticación.
  debug: 1
};
