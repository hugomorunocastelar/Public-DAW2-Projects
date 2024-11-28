# Explicación de la estructura creada para la MV de esta unidad de trabajo.

Las 4 actividades de la UT3, se desarrollan todas en el mismo contexto, un servidor con:

MV de Azure VPS Ubuntu 24.04
- Docker:
  - Comunes:
    1. Duckdns.
    2. Caddy.
    3. Uptime-Kuma.
  - Contenedores de las aplicaciones:
    1. Tomcat (JakartaEE, Spring).
    2. Sail (Laravel).
    3. Node.js (Javascript).
    4. Flask (Python).
  
La estructura de URL's es la siguiente:

- TOMCAT        https://tomcat.ut3hugocastelar.duckdns.org/
  - JAKARTA     https://tomcat.ut3hugocastelar.duckdns.org/jdee
- SAIL          https://laravel.ut3hugocastelar.duckdns.org/
- NODE.JS       https://node.ut3hugocastelar.duckdns.org/
- FLASK         https://flask.ut3hugocastelar.duckdns.org/  (Sin certificado porque Let'sEncrypt no lo provee correctamente)
- KUMA          https://monitor.ut3hugocastelar.duckdns.org/
  - GENERAL     https://monitor.ut3hugocastelar.duckdns.org/status/general