# Práctica 3.1 Creación de servidor de Aplicaciones JakartaEE/Spring en Tomcat

**JakartaEE**  

https://tomcat.ut3hugocastelar.duckdns.org/jdee

**Spring**  

...  

**Monitor**  

https://monitor.ut3hugocastelar.duckdns.org/status/general

## Índice

- [Práctica 3.1 Creación de servidor de Aplicaciones JakartaEE/Spring en Tomcat](#práctica-31-creación-de-servidor-de-aplicaciones-jakartaeespring-en-tomcat)
  - [Índice](#índice)
  - [Requisitos](#requisitos)
- [Base del Ejercicio](#base-del-ejercicio)
  - [Creación de la Máquina virtual](#creación-de-la-máquina-virtual)
  - [Ampliación de la memoria RAM a través del archivo Swapfile](#ampliación-de-la-memoria-ram-a-través-del-archivo-swapfile)
  - [Obtención de subdominio DuckDNS](#obtención-de-subdominio-duckdns)
  - [Instalación de Docker](#instalación-de-docker)
    - [Creación de las redes de los contenedores](#creación-de-las-redes-de-los-contenedores)
  - [Instalación del contenedor autoupdater de DuckDNS](#instalación-del-contenedor-autoupdater-de-duckdns)
  - [Instalación del contenedor de Caddy](#instalación-del-contenedor-de-caddy)
  - [Instalación del contenedor de Uptime-Kuma](#instalación-del-contenedor-de-uptime-kuma)
- [Instalación del contenedor de Tomcat](#instalación-del-contenedor-de-tomcat)
  - [Aplicación de JakartaEE](#aplicación-de-jakartaee)
    - [Descarga de la aplicación de Tomcat Local (Para el desarrollo).](#descarga-de-la-aplicación-de-tomcat-local-para-el-desarrollo)
    - [Creación de la aplicación de JakartaEE](#creación-de-la-aplicación-de-jakartaee)
  - [Despliegue de la aplicación](#despliegue-de-la-aplicación)
    - [docker-compose.yml](#docker-composeyml)
    - [Dockerfile](#dockerfile)

## Requisitos

  - [x] Creación de la máquina VPS. 
    - [x] Configuración de la VPS.
      - [x] Obtener el subdominio de DuckDNS.
      - [x] Instalar Docker.
      - [x] Configurar el contenedor de DuckDNS.
      - [x] Instalar contenedor de Caddy (Proxy).
      - [x] Instalar contenedor de Kuma (Monitor).
  - [x] Instalación del contenedor de Tomcat.
    - [x] Descarga de la aplicación de Tomcat Local (Para el desarrollo).
    - [x] Creación de la aplicación a desplegar.
      - [x] JakartaEE.
      - [ ] Spring.
    - [x] Configuración del contenedor.
      - [x] Docker Compose.
      - [x] Docker File.
    - [x] Despliegue de la aplicación.
      - [x] Método 1: Subida de archivos.
      - [x] Método 2: Actualización del repositorio de Docker Hub.

# Base del Ejercicio

[-> índice](#índice)

Sobre una máquina virtual de Azure, voy a crear el siguiente sistema:

- VPS:
  - Docker:
    - Tomcat:
      - JakartaEE
      - Spring
    - Caddy:
      - Tomcat.
    - Kuma.

Para ello, necesito:

- Conexión permanente a internet.
- Una máquina cualquiera (windows, unix o macintosh; en mi caso windows).
- Un servidor virtual (VPS, en mi caso Azure).
- Dominio de DuckDNS

## Creación de la Máquina virtual

[-> índice](#índice)

Para comenzar a usar la máquina virtual, debemos crearla en la página de portal.azure.com.
Buscaremos servicios gratuitos.
Seleccionaremos Máquina virtual con Linux.
Y cumplimentaremos el formulario con el siguiente contenido:

- Subscripción: Azure for Students
- Grupo de recursos: (Nuevo) ut3hugo
- Nombre de máquina virtual: ut3hugo
- Región: (yo voy a elegir (Europe) France Central, pero cualquiera en Europa sirve) (Europe) France Central.
- Imagen: Ubuntu Server 22.04 LTS - x64 gen. 2
- Tamaño: Standard_B1s - 1 vcpu, 1 GiB de memoria (8,61 US$/mes) (servicios gratuitos elegibles)
- Tipo de autenticación: Clave pública SSH
- Nombre de usuario: hugomoruno
- Origen de clave pública SSH: Usar la clave pública existente
- Clave pública SSH: contenido de la clave pública que creo a continuación:
  
**Crear un par de clave pública-privada**

<details>

    Para crear el par de llaves, primero abriremos una terminal de powrshell e introduciremos:
    ```powershell
    ssh-keygen -t ed25519
    ```

    Una vez introducido, nos saldrá una salida parecida a la siguiente:
    ```powershell
    PS C:\Users\daw2> ssh-keygen -t ed25519
    Generating public/private ed25519 key pair.
    Enter file in which to save the key (C:\Users\daw2/.ssh/id_ed25519): pubauzrekey
    Enter passphrase (empty for no passphrase):
    Enter same passphrase again:
    Your identification has been saved in pubauzrekey
    Your public key has been saved in pubauzrekey.pub
    The key fingerprint is:
    SHA256:Xm3dt07430AbA0GimYxmMSjGOb9CFIKzsnCDI3TWPeM daw2@DESKTOP-F1HNNF0
    The key's randomart image is:
    +--[ED25519 256]--+
    |o..o..+   ..o    |
    |ooBo.. O + . .   |
    |.*o+  = B   .    |
    |B + .o E   . o . |
    |+= . .  S . o = o|
    |. . .  . . . ..+o|
    |   .    .    .oo |
    |              +..|
    |               o+|
    +----[SHA256]-----+
    PS C:\Users\daw2>
    ```

    Ahora, muevo las claves a la carpeta .ssh. 
    ```powerhsell
    mv ~/pubauzrekey ~/.ssh/pubauzrekey
    mv ~/pubauzrekey.pub ~/.ssh/pubauzrekey.pub
    ```

    Entonces la carpeta .ssh ya tendrá las claves nuevas:
    ```powershell
    PS C:\Users\daw2> dir ~/.ssh


        Directorio: C:\Users\daw2\.ssh


    Mode                 LastWriteTime         Length Name
    ----                 -------------         ------ ----
    -a----        28/10/2024     20:03            464 examenkey
    -a----        28/10/2024     20:03            103 examenkey.pub
    -a----        28/10/2024     17:48           1859 known_hosts
    -a----        28/10/2024     17:48           1115 known_hosts.old
    -a----        17/10/2024     16:11            464 pubauzrekey
    -a----        17/10/2024     16:11            103 pubauzrekey.pub


    PS C:\Users\daw2>
    ```

</details>

- Puertos de entrada públicos: Permitir los puertos seleccionados
- Seleccionar puertos de entrada: HTTP (80), HTTPS (443), SSH (22)

Una vez rellenado el formulario completo, pulsas en Revisar y Crear.
Y después en Crear.

## Ampliación de la memoria RAM a través del archivo Swapfile

[-> Índice](#índice)

Debido a que la máquina que voy a usar para la realización de los 4 ejercicios de las prácticas de la ut3, va a albergar varios contenedores simultáneos y a su vez las distintas peticiones que se deben realizar para su corrección, voy a ampliar la memoria RAM de manera virtual a través de la creación de un archivo SWAP (Memoria RAM virtual, situada en la memoria ROM).

Para ello seguiré los siguiente pasos de el foro [Softzone](https://www.softzone.es/linux/tutoriales/activar-swap/):

1. Crear archivo:
   - ```sudo fallocate -l 4G /swapfile```
2. Asignar permisos para que solo root pueda escribir:
   - ```sudo chmod 600 /swapfile```
3. Configurar el archivo como tipo swap:
   - ```sudo mkswap /swapfile```
4. Activar la memoria SWAP.
   - ```sudo swapon /swapfile```

Una vez activado, vamos a activar la memoria swap al inicio de la máquina. Para ello, incluiremos en el archivo /etc/fstab la siguiente línea ```/swapfile swap swap defaults 0 0```

Hecho todo lo anterior, nuestra máquina pasará de tener 1GB de RAM a tener 5GB de RAM (con la consecuente lentitud que conlleva que no sea RAM real).

## Obtención de subdominio DuckDNS

[-> índice](#índice)

Una vez creada la máquina virtual, ahora me voy a la página de DuckDNS.org, inicio sesión y 
configuro mi dominio ut3hugocastelar.duckdns.org en la ip pública de la máquina: 
51.103.98.242

Una vez creado, nos aparecerá un mensaje de success como el siguiente:

success: domain ut3hugocastelar.duckdns.org added to your account

Y ahora actualizamos la IP con la IP Pública de la máquina, nos aparecerá el siguiente mensaje:

success: ip address for ut3hugocastelar.duckdns.org updated to 51.103.98.242

## Instalación de Docker 

[-> Índice](#índice)

Ahora, para poder iniciar los trabajos en la máquina virtual, debemos ejecutar el siguiente comando:
```powershell
ssh -i ~/.ssh/pubauzrekey hugomoruno@51.103.98.242
```

Ejecutando este comando, accedemos a la máquina (en mi caso he usado 
-i para especificar qué llave quiero usar ya que tengo más de una en mi carpeta)    
<details>

    PS C:\Users\hugom\.ssh> ssh -i ~/.ssh/pubauzrekey hugomoruno@51.103.98.242
    Enter passphrase for key 'C:\Users\hugom/.ssh/pubauzrekey':
    Welcome to Ubuntu 22.04.5 LTS (GNU/Linux 6.5.0-1025-azure x86_64)

    * Documentation:  https://help.ubuntu.com
    * Management:     https://landscape.canonical.com
    * Support:        https://ubuntu.com/pro

    System information as of Fri Oct 25 23:20:16 UTC 2024

    System load:  0.13              Processes:             101
    Usage of /:   2.4% of 61.84GB   Users logged in:       0
    Memory usage: 31%               IPv4 address for eth0: 10.1.1.4
    Swap usage:   0%

    Expanded Security Maintenance for Applications is not enabled.

    0 updates can be applied immediately.

    Enable ESM Apps to receive additional future security updates.
    See https://ubuntu.com/esm or run: sudo pro status


    The list of available updates is more than a week old.
    To check for new updates run: sudo apt update


    The programs included with the Ubuntu system are free software;
    the exact distribution terms for each program are described in the
    individual files in /usr/share/doc/*/copyright.

    Ubuntu comes with ABSOLUTELY NO WARRANTY, to the extent permitted by
    applicable law.

    To run a command as administrator (user "root"), use "sudo <command>".
    See "man sudo_root" for details.

    hugomoruno@ut3hugo:~$
</details>

Ahora, procedemos a la instalación. Para ello, ejecutaremos los siguientes comandos:

```bash
curl -fsSL https://get.docker.com -o get-docker.sh
```
Obtiene el script de instalación automática de Docker.

```bash
sudo sh get-docker.sh
```
Ejecuta el script de forma desatendida.

Pongo como ejemplo mi salida:
<details>

    hugomoruno@ut3hugo:~$ curl -fsSL https://get.docker.com -o get-docker.sh
    hugomoruno@ut3hugo:~$ sudo sh get-docker.sh
    # Executing docker install script, commit: 6d51e2cd8c04b38e1c2237820245f4fc262aca6c
    + sh -c apt-get -qq update >/dev/null
    + sh -c DEBIAN_FRONTEND=noninteractive apt-get -y -qq install ca-certificates curl >/dev/null
    + sh -c install -m 0755 -d /etc/apt/keyrings
    + sh -c curl -fsSL "https://download.docker.com/linux/ubuntu/gpg" -o /etc/apt/keyrings/docker.asc
    + sh -c chmod a+r /etc/apt/keyrings/docker.asc
    + sh -c echo "deb [arch=amd64 signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu jammy stable" > /etc/apt/sources.list.d/docker.list
    + sh -c apt-get -qq update >/dev/null
    + sh -c DEBIAN_FRONTEND=noninteractive apt-get -y -qq install docker-ce docker-ce-cli containerd.io docker compose-plugin docker-ce-rootless-extras docker-buildx-plugin >/dev/null
    + sh -c docker version
    Client: Docker Engine - Community
    Version:           27.3.1
    API version:       1.47
    Go version:        go1.22.7
    Git commit:        ce12230
    Built:             Fri Sep 20 11:41:00 2024
    OS/Arch:           linux/amd64
    Context:           default

    Server: Docker Engine - Community
    Engine:
    Version:          27.3.1
    API version:      1.47 (minimum version 1.24)
    Go version:       go1.22.7
    Git commit:       41ca978
    Built:            Fri Sep 20 11:41:00 2024
    OS/Arch:          linux/amd64
    Experimental:     false
    containerd:
    Version:          1.7.22
    GitCommit:        7f7fdf5fed64eb6a7caf99b3e12efcf9d60e311c
    runc:
    Version:          1.1.14
    GitCommit:        v1.1.14-0-g2c9f560
    docker-init:
    Version:          0.19.0
    GitCommit:        de40ad0

    ================================================================================

    To run Docker as a non-privileged user, consider setting up the
    Docker daemon in rootless mode for your user:

        dockerd-rootless-setuptool.sh install

    Visit https://docs.docker.com/go/rootless/ to learn about rootless mode.


    To run the Docker daemon as a fully privileged service, but granting non-root
    users access, refer to https://docs.docker.com/go/daemon-access/

    WARNING: Access to the remote API on a privileged Docker daemon is equivalent
            to root access on the host. Refer to the 'Docker daemon attack surface'
            documentation for details: https://docs.docker.com/go/attack-surface/

    ================================================================================

    hugomoruno@ut3hugo:~$
</details>

¡Instalado! Ahora, hay que configurar nuestro usuario como usuario Docker, para ello:
```bash
sudo groupadd docker
sudo usermod -aG docker $USER
newgrp docker
```

Y si compruebo con el comando:
```bash
groups hugomoruno

#Ésta sería la salida
hugomoruno : hugomoruno adm dialout cdrom floppy sudo audio dip video plugdev netdev lxd **docker**
```

Como veo que ya está docker, está todo correcto.

### Creación de las redes de los contenedores

[-> Índice](#índice)

Para la estructura con el servicio de proxy, necesitaremos la red de docker: red_interna.
A su vez, como planteo la instalación de un servicio de monitorización, crearemos la red: red_monitor.

Los comandos serán los siguientes:

```bash
docker network create red_interna
docker network create red_monitor
```

## Instalación del contenedor autoupdater de DuckDNS

[-> Índice](#índice)

Volvemos a la máquina virtual y en la carpeta que queramos (a poder ser en ~/ ), creamos una carpeta 
llamada duckdns.
```bash
mkdir duckdns
```
Dentro de la carpeta creamos el archivo docker-compose.yml.
```bash
touch ./duckdns/docker-compose.yml
```
Y dentro de la carpeta también creamos nuestro archivo .env.
```bash
touch ./duckdns/.env
```
Donde introduciremos el contenido en el siguiente formato:
```bash
SUBDOMAINS=ut3hugocastelar
TOKEN=4538f749-28b0-4b4e-8a73-xxxxxxxxxxxx
```

En el archivo de compose introducimos el contenedor de DuckDNS composerized.
El contenido del composer lo tenemos en el repositorio de Docker Hub del grupo linuxserver
en la siguiente dirección: [duckdns](https://hub.docker.com/r/linuxserver/duckdns)

[Compose de DuckDNS](duckdns/docker-compose.yml)

Ahora, nos situamos en la carpeta duckdns y ejecutamos el comando
```bash
docker compose up -d
```

Y la salida será la siguiente:
<details>

    hugomoruno@ut3hugo:~/duckdns$ docker compose up -d
    [+] Running 9/9
    ✔ duckdns Pulled                                                                                 3.0s
      ✔ 68c4ea3779b6 Pull complete                                                                   0.7s
      ✔ df25a931801a Pull complete                                                                   0.9s
      ✔ ab0ddebe54a6 Pull complete                                                                   1.0s
      ✔ 19f39f464468 Pull complete                                                                   1.0s
      ✔ 7560e3e46aa2 Pull complete                                                                   1.5s
      ✔ 339ecd878087 Pull complete                                                                   1.6s
      ✔ fdaf29876bfe Pull complete                                                                   1.8s
      ✔ c606a5b2fbbd Pull complete                                                                   1.9s
    [+] Running 1/1
    ✔ Container duckdns  Started                                                                     0.2s
    hugomoruno@ut3hugo:~/duckdns$
</details>

Comprobamos que se ha creado y levantado el contenedor con el comando:
```bash
docker ps

# Esta seria la salida.
hugomoruno@maquina02:~/duckdns$ docker ps
CONTAINER ID   IMAGE                                COMMAND   CREATED              STATUS              PORTS     NAMES
400dc058f682   lscr.io/linuxserver/duckdns:latest   "/init"   About a minute ago   Up About a minute             duckdns
```

## Instalación del contenedor de Caddy

[-> Índice](#índice)

Para empezar crearemos la estructura caddy en el mismo directorio donde se encuentra duckdns.
Es decir:
```bash
mkdir caddy
touch ./caddy/docker-compose.yml
```

E introduciremos el siguiente composer, del repositorio de [lucaslorentz](https://github.com/lucaslorentz/caddy-docker-proxy?tab=readme-ov-file#basic-usage-example-using-docker).

[Docker Compose](./caddy/docker-compose.yml)

Ahora subiremos la carpeta creada en éste repositorio con el siguiente comando:
```bash 
rsync -a -e "ssh -i ~/.ssh/pubauzrekey" /mnt/e/DEAPW-Hugo-Moruno/ut3/jakartaEE/caddy hugomoruno@ut3hugocastelar.duckdns.org:/home/hugomoruno/ 
```


Ahora, una vez creado todo, nos situamos en la carpeta caddy. Y ejecutamos:
```bash
docker compose up -d
```

Si comprobamos el resultado con ```docker ps``` nos saldrá algo así:
```bash
hugomoruno@maquina02:~/caddy$ docker ps
CONTAINER ID   IMAGE                                       COMMAND                  CREATED              STATUS              PORTS                                                                                NAMES
f3dc6fa9afd6   lucaslorentz/caddy-docker-proxy:ci-alpine   "/bin/caddy docker-p…"   About a minute ago   Up About a minute   0.0.0.0:80->80/tcp, :::80->80/tcp, 0.0.0.0:443->443/tcp, :::443->443/tcp, 2019/tcp   caddy
400dc058f682   lscr.io/linuxserver/duckdns:latest          "/init"                  31 minutes ago       Up 5 minutes                                                                                             duckdns
```

## Instalación del contenedor de Uptime-Kuma

[-> Índice](#índice)

Ahora para crear el sistema de monitorización empezaremos por crear la carpeta de uptimekuma:

```bash
mkdir ./kuma
touch ./kuma/docker-compose.yml
```

Ahora vamos a cumplimentar el docker compose con el siguiente archivo:

[docker-compose.yml](./kuma/docker-compose.yml)

Subiremos la carpeta creada en éste repositorio con el siguiente comando:
```bash 
rsync -a -e "ssh -i ~/.ssh/pubauzrekey" /mnt/e/DEAPW-Hugo-Moruno/ut3/jakartaEE/kuma hugomoruno@ut3hugocastelar.duckdns.org:/home/hugomoruno/ 
```

Y ahora, iniciamos el contenedor de kuma.

<details>

    hugomoruno@ut3hugo:~/kuma$ docker compose up -d
    Creating volume "kuma_uptime-kuma-data" with default driver
    Pulling uptime-kuma (louislam/uptime-kuma:latest)...
    latest: Pulling from louislam/uptime-kuma
    b338562f40a7: Pull complete
    874bf4d93720: Pull complete
    b16337721583: Pull complete
    7d955db85b85: Pull complete
    2c706596bd17: Pull complete
    88a5c59ed14f: Pull complete
    5a1d0a896c33: Pull complete
    e68c2f25b946: Pull complete
    2e6c90f010d6: Pull complete
    ff15b10fabb8: Pull complete
    4f4fb700ef54: Pull complete
    2bb0dd8bbb19: Pull complete
    Digest: sha256:d8b1b2151256bda3a99e822902fcbeb27b3eca6ef6d93fad25d2062b9fb61ad2
    Status: Downloaded newer image for louislam/uptime-kuma:latest
    Creating uptime-kuma ... done
    hugomoruno@ut3hugo:~/kuma$
</details>

Ahora, iniciamos una conexión privada por túnel ssh, en mi caso es el siguiente comando:
```powershell
ssh -ND 2110 hugomoruno@ut3hugocastelar.duckdns.org -i ~/.ssh/pubauzrekey

# -N Para no utilizar la conexión manualmente, -D Para el tunel directo, 
# 2110 puerto de mí maquina que voy a usar para la conexión.
```

Una vez iniciada la conexión, vamos a un navegador que pueda configurar el proxy y ponemos:
Proxy: localhost : 2110
Protocolo: SOCKs V.5.

Ahora buscamos la ip privada de la máquina virtual que en mi caso es: 10.1.1.4 y accedemos desde
el navegador configurado en la ruta http://10.1.1.4:3001/.

Ahí podremos monitorear el entorno creado desde dentro de la red_monitor.

# Instalación del contenedor de Tomcat

[-> Índice](#índice)

Para crear el contenedor de Tomcat, tenemos dos posibles maneras, hacerlo por Docker Hub o hacerlo con un docker compose y subir los archivos por un túnel seguro. En mi caso, voy a elegir la imagen de Tomcat 11.0.0. Esto se debe a que, según la [documentación oficial](https://tomcat.apache.org/whichversion.html), la versión 11 de tomcat, cuya última versión a dia de 8/11/'24 es 11.0.0 soporta versiones superiores a Java 17 (inclusive).

Para éste ejercicio, y en coherencia con lo anterior, elegiré el contenedor de tomcat:11.0.0 de la imagen oficial de [Tomcat](https://hub.docker.com/_/tomcat). 

## Aplicación de JakartaEE

[-> Índice](#índice)

### Descarga de la aplicación de Tomcat Local (Para el desarrollo). 

La descarga del mismo se hace a través del siguiente [enlace](https://dlcdn.apache.org/tomcat/tomcat-11/v11.0.0/bin/apache-tomcat-11.0.0-windows-x64.zip). Una vez descargado, en mi caso lo tengo en E:\apache-tomcat-11.0.0.

### Creación de la aplicación de JakartaEE

Para crear la aplicación de JakartaEE, usaremos el IDE de IntelliJ (JETBRAINS).
La versión que vamos a utilizar en éste ejercicio es IntelliJ Ultimate 2024.2.4.

Una vez instalada la versión del IDE, en la ventana de inicio, seguimos los siguientes pasos:

  1. Crear proyecto.
  2. Generadores -> JakartaEE.
    - Name: JakartaDespliegue  
    - Location: La que queramos.  
    - Template: Web application.  
    - Application server: Seleccionamos nuestra copia de Tomcat local, en mi caso (E:\apache-tomcat-11.0.0).  
    - Language: Java.  
    - Build system: Maven.  
    - GroupID: hugo  
    - ArtifacId: JakartaDespliegue  
    - JDK: Oracle OpenJDK 21.0.2 (Última versión LTS, con soporte hasta 2028).  
  3. Next
  4. Dependencias -> Specifications -> Servlet (Por defecto viene marcado)
  5. Create

Cuando estemos dentro de la aplicación podremos crear la aplicación que queramos, pero en mi caso, incluiré mi nombre en el index.jsp debajo de la línea de \<h1><%= "Hello World!" %>\</h1>" incluiré:

\<br>  
\<h1>Hugo Moruno\</h1>

Terminada la aplicación, con la siguiente configuración:

1. Zona superior del IDE > Tomcat 11.0.0 > Tres puntos
2. Edit
3. Abajo del todo > Before launch
4. Cambiar build JakartaDespliegue:war exploded por JakartaDespliegue:war
5. Apply
6. Ejecutamos la aplicación
  
Una vez ejecutada se nos creará una carpeta target en el proyecto, donde encontraremos un archivo de nombre "JakartaDespliegue-1.0-SNAPSHOT.war". Este archivo es nuestra aplicación JakartaEE que debermos subir al servidor.

## Despliegue de la aplicación

### [docker-compose.yml](./tomcat/docker-compose.yml)

[-> Índice](#índice)

Para el archivo de compose, es decir, con una instalación semi-manual a través de ssh. Éste mismo tendrá las siguientes líneas:

  - image: tomcat:11.0.0 / Imagen de tomcat descrita arriba.
  - volumes: ./webapps:/usr/local/tomcat/webapps / Para añadir el volumen dentro de la carpeta de páginas.
  - restart: always / Para evitar la caida del servicio sin reestablecimiento automático.

A la hora de copiar el docker-compose.yml se puede hacer manualmente a través de la terminal ssh. A la vez, crearemos una carpeta de nombre tomcat con la carpeta webapps dentro. 

Para subir el archivo a la aplicación, usaremos el paquete de rsync a traves de wsl.

1. Instalaremos el paquete rsync tanto en wsl como en la máquina.
   1. Ejecutar los comandos para la instalación:
      - ```sudo apt update```
      - ```sudo apt install rsync```
   2. Comprobar que está instalado:
      - ```rsync -V```
2. Nos situamos en cualquier carpeta en la terminal local y buscamos la ruta del archivo .war.
   - Una vez conseguido, E:\DEAPW-Hugo-Moruno\ut3\jakartaEE\JakartaDespliegue\JakartaDespliegue-1.0-SNAPSHOT.war, buscamos esa url dentro de WSL y la usamos para el comando rsync.
   - Lo subiremos al servidor con el siguiente comando:
     - ```rsync -a -e "ssh -i ~/.ssh/pubauzrekey" /mnt/e/DEAPW-Hugo-Moruno/ut3/jakartaEE/JakartaDespliegue/JakartaDespliegue-1.0-SNAPSHOT.war hugomoruno@ut3hugocastelar.duckdns.org:/home/hugomoruno/tomcat/webapps/```
   - Este comando se ejecuta en wsl de la máquina local.
3. Una vez subido, compruebo que se ha subido con el comando:
   - ```ls ~/tomcat/webapps```
   - Y nos devuelte:
   - ```bash 
     hugomoruno@ut3hugo:~$ ls ~/tomcat/webapps
     JakartaDespliegue-1.0-SNAPSHOT.war
     ```
   - En mi caso he decidido cambiarle el nombre a jdee.war.

### [Dockerfile](./tomcat/Dockerfile)

[-> Índice](#índice)

En caso alterno al anterior, nos encontramos ante la posibilidad de hacer una imagen de Docker Hub que ya contenga nuestra aplicación. Esto facilita la tarea de la subida de la aplicación pero en esencia mantiene la estructura de docker compose.

Para ello, usaremos un archivo Dockerfile en el que incluiremos la imagen de tomcat 11.0.0, copiaremos el contenido de la carpeta ./webapps a la carpeta del contendor: /usr/local/tomcat/webapps y abriremos el puerto 8080. Tras ello se ejecuta el comando catalina.sh y ya tendríamos la imagen del servidor de tomcat con nuestra aplicación. 

Una vez hecho, seguiremos los siguientes pasos para la creación de la imagen:

1. ```docker login```, Iniciamos sesión, nos pedirá la contraseña de nuestra cuenta de Docker Hub.
2. ```docker build -t hugomoru5/jdeetomcat:latest .```, Crearemos la imagen y se subirá a nuestro repositorio.
3. ```docker push hugomoru5/jdeetomcat:latest```, la subimos a nuestro repositorio.
4. En nuestro [docker-compose.yml](./tomcat/docker-compose.yml), cambiamos la imagen de tomcat:11.0.0 a hugomoru5/jdeetomcat:latest y al iniciarse el contenedor, siempre tendrá esa versión de la aplicación lista para ejecutarse.