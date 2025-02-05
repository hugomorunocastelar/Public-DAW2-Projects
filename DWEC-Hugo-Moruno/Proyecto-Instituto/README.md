# Proyecto Instituto

Hecho por Hugo Moruno Parra, 2024. 

2º DAW, I.E.S. Castelar.

<div style="page-break-after: always;"></div>

# Índice

- [Proyecto Instituto](#proyecto-instituto)
- [Índice](#índice)
- [Introducción](#introducción)
- [Enunciado](#enunciado)
  - [Menú de aplicación/Opciones a implementar. (5 puntos)](#menú-de-aplicaciónopciones-a-implementar-5-puntos)
      - [Consulta (1.75 puntos)](#consulta-175-puntos)
    - [Otros Aspectos Valorados (0.5 puntos)](#otros-aspectos-valorados-05-puntos)
    - [Defensa del Trabajo](#defensa-del-trabajo)
- [Tecnologías](#tecnologías)
- [Documentación](#documentación)
- [Conclusión](#conclusión)
- [Webgrafía](#webgrafía)
- [Aplicaciones utilizadas](#aplicaciones-utilizadas)

<div style="page-break-after: always;"></div>

# Introducción

[-> Índice](#índice)

Éste proyecto se desarrolla en base a la idea de hacer una aplicación de gestión del alumnado y su ordenación por:
- Roles
- Clases

La estructura de un usuario será la siguiente:

- Id.
- Email.
- Password: encriptada.
- Nombre.
- Rol.
- Edad.
- Clases [].

Los consiguientes usuarios tendrán su estructura propia, y son:
1. Admin:
    - Rol: admin.
    - Clases.
2. Profesor:
    - Rol: prof.
    - Clases.
3. Alumno:
    - Rol: alum.
    - Clases:.
4. Desasignado:
    - Rol: 'unassigned'.

También se crearán la siguiente clase:
    - Clase.
Que se ve de la siguiente manera:

- Id.
- Name.
- Profs: [
    { id: prof }
  ]
- Alums: [
    { "id": alum }
  ]


Básicamente la propia aplicación se compondrá de un sistema de permisos de gestión según roles. En el que, siendo usuario puedes ser: Admin (tiene todos los permisos), Profesor (Tiene permisos sobre todos los alumnos y acceso a los datos de los que pertenecen a sus grupos y clases) y Alumno (tiene acceso a su clase, sus profesores y sus datos) y Desasignado (que no tiene más permisos que a sus propios datos).

Para ello, implementaré una estructura de tablas cruzadas y clases con métodos de control. con el siguiente diagrama.

El proyecto estará completamente escrito en inglés. Y tendrá traducción al español.

<div style="page-break-after: always;"></div>

# Enunciado

[-> Índice](#índice)

Se debe hacer un proyecto basado en lo que hemos visto en clase. Cada alumno debe presentar el mantenimiento de una entidad diferente. El proyecto se debería hacer basado en el mismo backend que el proyecto AJAX.
Además, el proyecto tendrá que cumplir con los apartados siguientes.

## Menú de aplicación/Opciones a implementar. (5 puntos)

El menú de aplicación permitirá acceder a las diferentes pantallas de la aplicación. Podéis utilizar el componente de bootstrap que prefiráis. Tendrá que dar acceso a las siguientes opciones:

1. **Gestión de Objetos (3 puntos)**
   - Implementación del CRUD que permitirá llevar a cabo las acciones de creación, modificación, borrado y listado. Esta pantalla deberá tener las siguientes características:

   #### Consulta (1.75 puntos)
   - Mostrará todos los objetos sin filtro de ningún tipo.
   - Permitirá ordenar los resultados de forma **ascendente** (por omisión) o **descendente** usando alguno de los campos. No será necesario que el usuario pueda elegir el campo, pero sí que pueda escoger entre orden ascendente o descendente. Por ejemplo, si trabajamos con libros, podría ordenarse por título.
   - Los resultados deberán estar **paginados**.
   - La pantalla incluirá un botón para **crear objetos**. (1 punto)
   - La pantalla mostrará botones para acceder a las siguientes acciones:
     - **Modificación**: mostrará un cuadro de diálogo para modificar el objeto. (1 punto)
     - **Borrado**: pedirá confirmación y refrescará los resultados recargando la misma página de datos. (0.5 puntos)
   - Validaciones. Será necesario que cuente con validaciones de los tres tipos:
     - Síncronas (0,25)
     - Asíncronas (0,25)
     - De formulario (0,25)

2. **Listados (2 puntos)**
   - Debe haber al menos dos pantallas adicionales que permitan **ordenar o clasificar** los objetos de acuerdo a diferentes criterios. Ejemplos:
     - **Clasificación alfabética** con botones para cada letra del alfabeto.
     - **Ordenación** por un campo determinado, seleccionable mediante un `select`.
     - **Búsqueda** por un campo determinado en un campo tipo `select`.
     - **Búsqueda de texto completo**.

   **Opciones originales** serán valoradas positivamente.

3. **Cerrar Sesión (0.5 puntos)**
   - Esta acción cerrará la sesión y redirigirá a la página principal.

4. **Creación de un Componente Visual (1.5 puntos)**
   - Ejemplo: un `select` que cargue los datos desde el servidor, o un campo numérico con botones para incrementar y decrementar. 
   - El componente debe ser **reutilizable**, de modo que se pueda insertar en otras partes de la página. Debe utilizar input y output

### Otros Aspectos Valorados (0.5 puntos)
- Código **ordenado** y **bien documentado**.
- Respetar las **convenciones** establecidas en clase.

---

### Defensa del Trabajo
Para la superación de la tarea será necesario haber superado una defensa individual que se hará con el profesor.  
Consistirá en contestar a una serie de preguntas con el código y la aplicación delante.  
Si se considera necesario se podría pedir que se hiciera alguna pequeña modificación a la aplicación tanto a algún alumno como al grupo completo.

<div style="page-break-after: always;"></div>

# Tecnologías

[-> Índice](#índice)

<div style="page-break-after: always;"></div>

# Documentación

[-> Índice](#índice)


<div style="page-break-after: always;"></div>

# Conclusión

[-> Índice](#índice)


<div style="page-break-after: always;"></div>

# Webgrafía

[-> Índice](#índice)

  1. Documentación aportada en clase. [GitLab Juanjo](https://gitlab.com/materiales-de-clase/daw/daw2-dwec-alumnado)
  2. Documentación oficial de Bootstrap. [Bootstrap](https://getbootstrap.com/docs/4.0/components/button-group/)
  3. Documentación oficial de Google Icons. [Google fonts](https://fonts.google.com/icons)
  4. Documentación oficial de JQuery. [JQuery](https://api.jquery.com/)
  5. API REST. [API](https://juanda.gitbooks.io/webapps/content/api/arquitectura-api-rest.html)
  6. json-server. [Json-Server](https://github.com/typicode/json-server)
  7. JWT-localstorage. [KEEPCODING](https://keepcoding.io/blog/guardar-jwt-en-localstorage/)
  8. Traductor automático de Google. [Ayuda Medios](https://ayuda.medios.com.ar/support/solutions/articles/14000139354-integrar-el-traductor-de-idiomas-de-google)

# Aplicaciones utilizadas

[-> Índice](#índice)

  1. ChatGPT. [ChatGPT](https://chatgpt.com/)
  2. Azure VPS. [Azure](https://portal.azure.com/)
  3. VSCode. [VSCode](https://code.visualstudio.com/)
  4. PostMan. [PostMan](https://www.postman.com/)
  5. JSon server. [BackendApp](https://moodle.educarex.es/iescastelarfp/mod/resource/view.php?id=73883)
  6. Google Draws. [Drawings](https://docs.google.com/drawings/)