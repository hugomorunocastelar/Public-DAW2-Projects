# Práctica 4 Creación de servidor de Páginas Web con repositorio Git Bare

**URL**  

https://ut4.hugocastelar.duckdns.org/

## Índice

- [Práctica 4 Creación de servidor de Páginas Web con repositorio Git Bare](#práctica-4-creación-de-servidor-de-páginas-web-con-repositorio-git-bare)
  - [Índice](#índice)
  - [Requisitos](#requisitos)
- [Base del Ejercicio](#base-del-ejercicio)
  - [Creación de la Máquina virtual](#creación-de-la-máquina-virtual)
  - [Obtención de subdominio DuckDNS](#obtención-de-subdominio-duckdns)
  - [Instalación de Docker](#instalación-de-docker)
    - [Creación de la red de Caddy.](#creación-de-la-red-de-caddy)
  - [Instalación del contenedor autoupdater de DuckDNS](#instalación-del-contenedor-autoupdater-de-duckdns)
  - [Instalación del contenedor de Caddy](#instalación-del-contenedor-de-caddy)
- [Ejercicio](#ejercicio)
  - [Instalación y configuración del contenedor de Php Apache](#instalación-y-configuración-del-contenedor-de-php-apache)
    - [Explicación de los archivos de la carpeta](#explicación-de-los-archivos-de-la-carpeta)
  - [Configuración del repositorio para el uso del push.](#configuración-del-repositorio-para-el-uso-del-push)

## Requisitos

- [x] Creación de la máquina VPS. 
  - [x] Configuración de la VPS.
    - [x] Obtener el subdominio de DuckDNS.
    - [x] Instalar Docker.
    - [x] Configurar el contenedor de DuckDNS.
    - [x] Instalar contenedor de Caddy (Proxy).
- [x] Instalación del contenedor de Apache.
  - [x] Docker Compose.
- [x] Configuración del repositorio de git bare.

# Base del Ejercicio

[-> índice](#índice)

Sobre una máquina virtual de Azure, voy a crear el siguiente sistema:

- VPS:
  - Docker:
    - DuckDNS.
    - Php-Apache.
    - Caddy.

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
- Grupo de recursos: (Nuevo) ut4_group
- Nombre de máquina virtual: ut4
- Región: (yo voy a elegir (Europe) France Central, pero cualquiera en Europa sirve) (Europe) France Central.
- Imagen: Ubuntu Server 22.04 LTS - x64 gen. 2
- Tamaño: Standard_B1s - 1 vcpu, 1 GiB de memoria (8,61 US$/mes) (servicios gratuitos elegibles)
- Tipo de autenticación: Clave pública SSH
- Nombre de usuario: hugomoruno
- Origen de clave pública SSH: Usar la clave pública existente
- Clave pública SSH: contenido de la clave pública que creo a continuación:
  
**Crear un par de clave pública-privada**

<details>

    Para crear el par de llaves, primero abriremos una terminal de powershell e introduciremos:
    ```powershell
    ssh-keygen -t ed25519
    ```

    Una vez introducido, nos saldrá una salida parecida a la siguiente:
    ```powershell
    PS C:\Users\daw2> ssh-keygen -t ed25519
    Generating public/private ed25519 key pair.
    Enter file in which to save the key (C:\Users\daw2/.ssh/id_ed25519):
    Enter passphrase (empty for no passphrase):
    Enter same passphrase again:
    Your identification has been saved in id_ed25519
    Your public key has been saved in id_ed25519.pub
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
    mv ~/id_ed25519 ~/.ssh/id_ed25519
    mv ~/id_ed25519.pub ~/.ssh/id_ed25519.pub
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
    -a----        17/10/2024     16:11            464 id_ed25519
    -a----        17/10/2024     16:11            103 id_ed25519.pub


    PS C:\Users\daw2>
    ```

</details>

- Puertos de entrada públicos: Permitir los puertos seleccionados
- Seleccionar puertos de entrada: HTTP (80), HTTPS (443), SSH (22)

Una vez rellenado el formulario completo, pulsas en Revisar y Crear.
Y después en Crear.

## Obtención de subdominio DuckDNS

[-> índice](#índice)

Una vez creada la máquina virtual, ahora me voy a la página de DuckDNS.org, inicio sesión y 
configuro mi dominio hugocastelar.duckdns.org en la ip pública de la máquina: 
4.233.57.20

Una vez creado, nos aparecerá un mensaje de success como el siguiente:

success: domain hugocastelar.duckdns.org added to your account

Y ahora actualizamos la IP con la IP Pública de la máquina, nos aparecerá el siguiente mensaje:

success: ip address for hugocastelar.duckdns.org updated to 4.233.57.20

## Instalación de Docker

[-> Índice](#índice)

Ahora, para poder iniciar los trabajos en la máquina virtual, debemos ejecutar el siguiente comando:
```powershell
ssh hugomoruno@hugocastelar.duckdns.org
```
 
<details>

    PS C:\Users\hugom\.ssh> ssh hugomoruno@hugocastelar.duckdns.org
    Enter passphrase for key 'C:\Users\hugom/.ssh/id_ed25519':
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

    hugomoruno@ut4:~$
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

    hugomoruno@ut4:~$ curl -fsSL https://get.docker.com -o get-docker.sh
    hugomoruno@ut4:~$ sudo sh get-docker.sh
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

    hugomoruno@ut4:~$
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

### Creación de la red de Caddy.

[-> Índice](#índice)

Para la estructura con el servicio de proxy, necesitaremos la red de docker: red_interna.

El comando será el siguiente:

```bash
docker network create red_interna
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
SUBDOMAINS=hugocastelar
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

    hugomoruno@ut4:~/duckdns$ docker compose up -d
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
    hugomoruno@ut4:~/duckdns$
</details>

Comprobamos que se ha creado y levantado el contenedor con el comando:
```bash
docker ps

# Esta seria la salida.
hugomoruno@ut4:~/duckdns$ docker ps
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
rsync -a -e /mnt/e/DEAPW-Hugo-Moruno/ut4/practica/caddy hugomoruno@hugocastelar.duckdns.org:/home/hugomoruno/
```

Ahora, una vez creado todo, nos situamos en la carpeta caddy. Y ejecutamos:
```bash
docker compose up -d
```

Si comprobamos el resultado con ```docker ps``` nos saldrá algo así:
```bash
hugomoruno@ut4:~/caddy$ docker ps
CONTAINER ID   IMAGE                                       COMMAND                  CREATED              STATUS              PORTS                                                                                NAMES
f3dc6fa9afd6   lucaslorentz/caddy-docker-proxy:ci-alpine   "/bin/caddy docker-p…"   About a minute ago   Up About a minute   0.0.0.0:80->80/tcp, :::80->80/tcp, 0.0.0.0:443->443/tcp, :::443->443/tcp, 2019/tcp   caddy
400dc058f682   lscr.io/linuxserver/duckdns:latest          "/init"                  31 minutes ago       Up 5 minutes                                                                                             duckdns
```

# Ejercicio

## Instalación y configuración del contenedor de Php Apache

[-> Índice](#índice)

Una vez instalado y configurado el servidor de proxy inverso de caddy, vamos a levantar
y configurar el servidor de Apache.

Para ello, primero nos aseguramos de tener el siguiente contenido en alguna carpeta de nuestro PC.

[Carpeta con el contenedor de PHP configurado con el repositorio git --bare](./php-apache/).

Y los subimos al servidor con el comando siguiente:

```bash
rsync -a -e /mnt/e/DEAPW-Hugo-Moruno/ut4/practica/php-apache hugomoruno@hugocastelar.duckdns.org:/home/hugomoruno/
```

Y dentro de la carpeta del VPS, en /home/hugomoruno/php-apache haces un docker compose up -d y ya tienes el servidor con la página inicial.

### Explicación de los archivos de la carpeta

[-> Índice](#índice)

[./php-apache/hooks/post-receive](./php-apache/hooks/post-receive)

Hook que se activa tras el push al repositorio. Cambiar dentro del mismo las rutas /home/hugomoruno/apache/public a la ruta de tu repositorio en el VPS.

[../apache/docker-compose.yml](../apache/docker-compose.yml)

Compose que instala el servidor de apache y configura la página inicial.

[./php-apache/index.php](./php-apache/index.php)

Página inicial que se sirve en el servidor.

## Configuración del repositorio para el uso del push.

[-> Índice](#índice)

La creación del repositorio es sencilla y se limita a lo siguiente:

Crear una carpeta en cualquier lugar en el que no haya un directorio previo en la misma carpeta o en superiores.
En mi caso he creado el repositorio en E:\repolocal. Para ello, he hecho:

En mi caso creando la carpeta.
```powershell
mkdir E:\repolocal
```

Dentro de la carpeta, he creado un archivo index.php, para el cuál puedes usar el que hay en [este repositorio](./repolocal/index.php).
Después creas un repositorio en la misma carpeta con el comando ```git init```. Y tras ello, añades la ruta del repositorio del vps con la siguiente plantilla:
```powershell
git remote add prod ssh://[usuario]@[ip|dominio]/url/al/repositorio.git
```

Una vez añadido el repositorio en el vps, podemos subir los commits con el comando
```
git push prod master
```