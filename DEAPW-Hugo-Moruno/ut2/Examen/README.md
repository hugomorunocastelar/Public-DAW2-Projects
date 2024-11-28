# Examen 28 - Octubre / Apache en VPS

## Índice

- [Examen 28 - Octubre / Apache en VPS](#examen-28---octubre--apache-en-vps)
  - [Índice](#índice)
  - [Requisitos](#requisitos)
  - [Base del ejercicio](#base-del-ejercicio)
  - [Inicio de máquina en VPS](#inicio-de-máquina-en-vps)
  - [Obtención de subdominio DuckDNS](#obtención-de-subdominio-duckdns)
  - [Instalación de Docker en la máquina virtual](#instalación-de-docker-en-la-máquina-virtual)
  - [Creación de la base de Docker (Carpetas de configuración y Redes)](#creación-de-la-base-de-docker-carpetas-de-configuración-y-redes)
  - [Creación del Docker Compose que levantará la estructura completa](#creación-del-docker-compose-que-levantará-la-estructura-completa)
  - [Páginas de estado y monitoreo interno de la máquina:](#páginas-de-estado-y-monitoreo-interno-de-la-máquina)
- [Ejercicios del examen](#ejercicios-del-examen)
  - [1. Servicio apache montado en VPS.](#1-servicio-apache-montado-en-vps)
  - [2. Ruta por subdominio.](#2-ruta-por-subdominio)

## Requisitos

[-> índice](#índice)

Los requisitos que se indican para el ejercicio son los siguientes:

- [ ] Servicio apache montado sobre VPS
- [ ] Accesible por ruta (subdominio) DuckDNS comenzado por cosa.
- [ ] Anonimizar las cabeceras.
- [ ] Monitorización del servicio.
- [ ] Instrucciones de reproducción.

## Base del ejercicio

[-> índice](#índice)

Para empezar, la base del ejercicio es la siguiente:
- Conexión permanente a internet.
- Una máquina cualquiera (windows, unix o macintosh; en mi caso windows).
- Un servidor virtual (VPS).
- Un navegador que se pueda configurar con proxy.

Para comenzar, yo voy a usar Microsoft Azure, por ende estos son mis pasos:

1. Crearme una cuenta de outlook referenciando la cuenta del @iescastelar.com.
2. Selecionar la subscripción de Azure for Students.

Una vez hecho todo, tenemos lo suficiente para comenzar el ejercicio.

## Inicio de máquina en VPS

[-> índice](#índice)

Para comenzar a usar la máquina virtual, debemos crearla en la página de portal.azure.com.
Buscaremos servicios gratuitos.
Seleccionaremos Máquina virtual con Linux.
Y cumplimentaremos el formulario con el siguiente contenido:

- Subscripción: Azure for Students
- Grupo de recursos: (Nuevo) examenhugo
- Nombre de máquina virtual: examenhugomaq
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
    Enter file in which to save the key (C:\Users\daw2/.ssh/id_ed25519): examenkey
    Enter passphrase (empty for no passphrase):
    Enter same passphrase again:
    Your identification has been saved in examenkey
    Your public key has been saved in examenkey.pub
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
    mv ~/examenkey ~/.ssh/examenkey
    mv ~/examenkey.pub ~/.ssh/examenkey.pub
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


## Obtención de subdominio DuckDNS

[-> índice](#índice)

Una vez creada la máquina virtual, ahora me voy a la página de DuckDNS.org, inicio sesión y 
configuro mi dominio cosa.hugocastelar.duckdns.org en la ip pública de la máquina: 
4.251.114.138

Una vez creado, nos aparecerá un mensaje de success como el siguiente:

success: domain hugocastelar.duckdns.org added to your account

Y ahora actualizamos la IP con la IP Pública de la máquina, nos aparecerá el siguiente mensaje:

success: ip address for hugocastelar.duckdns.org updated to 4.251.114.138

## Instalación de Docker en la máquina virtual

[-> índice](#índice)

Ahora, iniciamos la conexión a la máquina virtual con el siguiente comando:

```powershell
ssh -i ~/.ssh/examenkey hugomoruno@hugocastelar.duckdns.org
```

La salida será la siguiente:
```powershell
PS C:\Users\daw2> ssh -i ~/.ssh/examenkey hugomoruno@hugocastelar.duckdns.org
The authenticity of host 'hugocastelar.duckdns.org (4.251.114.138)' can't be established.
ED25519 key fingerprint is SHA256:wF49uR9OMPAfCx7Q2Ms1wvO1a/6SQ2/xBxMj7TJASSI.
This key is not known by any other names.
Are you sure you want to continue connecting (yes/no/[fingerprint])? yes
Warning: Permanently added 'hugocastelar.duckdns.org' (ED25519) to the list of known hosts.
Enter passphrase for key 'C:\Users\daw2/.ssh/examenkey':
Welcome to Ubuntu 22.04.5 LTS (GNU/Linux 6.5.0-1025-azure x86_64)

 * Documentation:  https://help.ubuntu.com
 * Management:     https://landscape.canonical.com
 * Support:        https://ubuntu.com/pro

 System information as of Mon Oct 28 19:16:12 UTC 2024

  System load:  0.0               Processes:             101
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

hugomoruno@examenhugomaq:~$
```

Ya estoy dentro de la máquina, ahora, instalaré docker con el ejecutable de get-docker, 
para ello, introduzco los siguientes comandos:
```bash
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh
```

La salida será la siguiente: 
```bash
hugomoruno@examenhugomaq:~$ curl -fsSL https://get.docker.com -o get-docker.sh
hugomoruno@examenhugomaq:~$ sudo sh get-docker.sh
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

hugomoruno@examenhugomaq:~$
```

Ahora, una vez instalado Docker - CLI, instalaré el módulo de docker compose, para ello
usaré los siguientes comandos:
```bash
sudo apt update
sudo apt install docker compose
```

La salida será la siguiente: 

<details>

    ```bash
    hugomoruno@examenhugomaq:~$ sudo apt update
    Hit:1 http://azure.archive.ubuntu.com/ubuntu jammy InRelease
    Hit:2 http://azure.archive.ubuntu.com/ubuntu jammy-updates InRelease
    Hit:3 http://azure.archive.ubuntu.com/ubuntu jammy-backports InRelease
    Hit:4 http://azure.archive.ubuntu.com/ubuntu jammy-security InRelease
    Hit:5 https://download.docker.com/linux/ubuntu jammy InRelease
    Reading package lists... Done
    Building dependency tree... Done
    Reading state information... Done
    12 packages can be upgraded. Run 'apt list --upgradable' to see them.
    hugomoruno@examenhugomaq:~$ sudo apt install docker compose
    Reading package lists... Done
    Building dependency tree... Done
    Reading state information... Done
    The following additional packages will be installed:
    python3-docker python3-dockerpty python3-docopt python3-dotenv python3-texttable python3-websocket
    Recommended packages:
    docker.io
    The following NEW packages will be installed:
    docker compose python3-docker python3-dockerpty python3-docopt python3-dotenv python3-texttable
    python3-websocket
    0 upgraded, 7 newly installed, 0 to remove and 12 not upgraded.
    Need to get 290 kB of archives.
    After this operation, 1545 kB of additional disk space will be used.
    Do you want to continue? [Y/n] y
    Get:1 http://azure.archive.ubuntu.com/ubuntu jammy/universe amd64 python3-websocket all 1.2.3-1 [34.7 kB]
    Get:2 http://azure.archive.ubuntu.com/ubuntu jammy/universe amd64 python3-docker all 5.0.3-1 [89.3 kB]
    Get:3 http://azure.archive.ubuntu.com/ubuntu jammy/universe amd64 python3-dockerpty all 0.4.1-2 [11.1 kB]
    Get:4 http://azure.archive.ubuntu.com/ubuntu jammy/universe amd64 python3-docopt all 0.6.2-4 [26.9 kB]
    Get:5 http://azure.archive.ubuntu.com/ubuntu jammy/universe amd64 python3-dotenv all 0.19.2-1 [20.5 kB]
    Get:6 http://azure.archive.ubuntu.com/ubuntu jammy/universe amd64 python3-texttable all 1.6.4-1 [11.4 kB]
    Get:7 http://azure.archive.ubuntu.com/ubuntu jammy/universe amd64 docker compose all 1.29.2-1 [95.8 kB]
    Fetched 290 kB in 0s (5232 kB/s)
    Selecting previously unselected package python3-websocket.
    (Reading database ... 62393 files and directories currently installed.)
    Preparing to unpack .../0-python3-websocket_1.2.3-1_all.deb ...
    Unpacking python3-websocket (1.2.3-1) ...
    Selecting previously unselected package python3-docker.
    Preparing to unpack .../1-python3-docker_5.0.3-1_all.deb ...
    Unpacking python3-docker (5.0.3-1) ...
    Selecting previously unselected package python3-dockerpty.
    Preparing to unpack .../2-python3-dockerpty_0.4.1-2_all.deb ...
    Unpacking python3-dockerpty (0.4.1-2) ...
    Selecting previously unselected package python3-docopt.
    Preparing to unpack .../3-python3-docopt_0.6.2-4_all.deb ...
    Unpacking python3-docopt (0.6.2-4) ...
    Selecting previously unselected package python3-dotenv.
    Preparing to unpack .../4-python3-dotenv_0.19.2-1_all.deb ...
    Unpacking python3-dotenv (0.19.2-1) ...
    Selecting previously unselected package python3-texttable.
    Preparing to unpack .../5-python3-texttable_1.6.4-1_all.deb ...
    Unpacking python3-texttable (1.6.4-1) ...
    Selecting previously unselected package docker compose.
    Preparing to unpack .../6-docker compose_1.29.2-1_all.deb ...
    Unpacking docker compose (1.29.2-1) ...
    Setting up python3-dotenv (0.19.2-1) ...
    Setting up python3-texttable (1.6.4-1) ...
    Setting up python3-docopt (0.6.2-4) ...
    Setting up python3-websocket (1.2.3-1) ...
    Setting up python3-dockerpty (0.4.1-2) ...
    Setting up python3-docker (5.0.3-1) ...
    Setting up docker compose (1.29.2-1) ...
    Processing triggers for man-db (2.10.2-1) ...
    Scanning processes...
    Scanning linux images...

    Running kernel seems to be up-to-date.

    No services need to be restarted.

    No containers need to be restarted.

    No user sessions are running outdated binaries.

    No VM guests are running outdated hypervisor (qemu) binaries on this host.
    hugomoruno@examenhugomaq:~$
    ```

</details>
Una vez tengamos todo instalado, procederemos a añadir a nuestro usuario al grupo docker, para ello, ejecutaremos el siguiente grupo de comandos:

```bash
sudo usermod -aG docker $USER
newgrp docker
```

Estos comandos no tienen salida, sin embargo podemos comprobar que ha funcionado de la siguiente manera:
```bash
hugomoruno@examenhugomaq:~$ groups hugomoruno
hugomoruno : hugomoruno adm dialout cdrom floppy sudo audio dip video plugdev netdev lxd docker
```

## Creación de la base de Docker (Carpetas de configuración y Redes)

[-> índice](#índice)

Una vez tengo la máquina de ubuntu con docker instalado, procedo a construir los contenedores que van a componer el contenedor, pero antes, voy a crear una estructura que me va a servir de base para agilizar el proceso:

1. Creo las carpetas que va a usar apache:

    - Para ello, ejecutaré el siguiente comando:
    ```bash
    mkdir apache apache/public apache/config
    ```

2. Una vez creadas, creo los archivos que van a tener de la siguiente manera:
    ```bash
    touch apache/public/index.php | sudo echo "<?php phpInfo(); ?>" >> apache/public/index.php
    touch apache/config/security.conf | sudo echo "ServerTokens Prod
    ServerSignature Off
    TraceEnable Off" >> apache/config/security.conf
    ```

    Podremos comprobar la estructura creada de la siguiente manera:
    ```bash
    hugomoruno@examenhugomaq:~$ ls -R
    .:
    apache  get-docker.sh

    ./apache:
    config  public

    ./apache/config:
    security.conf

    ./apache/public:
    index.php
    hugomoruno@examenhugomaq:~$
    ```

3. Ahora que tenemos creados los archivos de la configuración básica. Explico por qué ésta configuración:

        Esta configuración se presta a preconfigurar el servidor de php:apache para poder levantarlo sin tener que manipularlo. El archivo index.php sirve como página de muestra para que la página tenga contenido y el archivo security.conf anonimiza las cabeceras del servidor para que éste sea más difícilmente atacable.

4. Una vez creada la estructura crearemos las dos redes que la componen de la siguiente manera:

```bash
docker network create red_interna
docker network create red_monitor
```

## Creación del Docker Compose que levantará la estructura completa

Para crear este archivo, ejecuto el siguiente comando:
```bash
touch docker-compose.yml
```

Lo cuál sacará por pantalla:
```bash
hugomoruno@examenhugomaq:~$ docker network ls
NETWORK ID     NAME          DRIVER    SCOPE
f8606fdaf174   bridge        bridge    local
00467aa80366   host          host      local
e41d3a4bd5b1   none          null      local
a79d7ed32c48   red_interna   bridge    local
29b20624cfb6   red_monitor   bridge    local
hugomoruno@examenhugomaq:~$
```

Y el contenido del mismo será el siguiente:

docker-compose.yml:
<details>

    ```yml
    services:
        duckdns:
            image: lscr.io/linuxserver/duckdns:latest
            container_name: duckdns
            network_mode: host #optional
            environment:
               - PUID=1000 #optional
               - PGID=1000 #optional
               - TZ=Etc/UTC #optional
               - SUBDOMAINS=hugocastelar.duckdns.org
               - TOKEN=4538f749-28b0-4b4e-8a73-24bb9c310934
               - UPDATE_IP=ipv4 #optional
               - LOG_FILE=false #optional
            restart: unless-stopped

        caddy: 
            image: lucaslorentz/caddy-docker-proxy:ci-alpine
            container_name: caddy
            ports:
              - 80:80
              - 443:443
            environment:
              - CADDY_INGRESS_NETWORKS=red_interna
            networks:
              - red_interna
              - red_monitor
            volumes:
              - /var/run/docker.sock:/var/run/docker.sock
              - caddy_data:/data
            restart: unless-stopped

        apache:
            image: php:apache
            container_name: apache
            networks:
              - red_interna
              - red_monitor
            volumes:
              - ./apache/public:/var/www/html
              - ./apache/config/security.conf:/etc/apache2/conf-available/security.conf
            labels:
                caddy: "cosa.hugocastelar.duckdns.org"
                caddy.reverse_proxy: "{{upstreams}}"

        kuma:
            image: louislam/uptime-kuma:latest
            container_name: kuma
            environment:
                - DB_SQLITE_FILE=/app/data/kuma.db
            volumes:
                - uptime-kuma-data:/app/data
            ports:
                - 3001:3001
            networks:
                - red_interna
                - red_monitor
            labels:
                caddy: "monitor.hugocastelar.duckdns.org"
                caddy.reverse_proxy: "{{upstreams}}"

    networks:
        red_interna:
            external: true
        red_monitor:
            external: true

    volumes:
        caddy_data: {}
        uptime-kuma-data:
    ```

</details>

Una vez ejecutado el comando ```bash docker compose up -d ```, obtendremos una salida parecida a la siguiente:

<details>

    hugomoruno@examenhugomaq:~$ docker compose up -d
    Creating volume "hugomoruno_caddy_data" with default driver
    Creating volume "hugomoruno_uptime-kuma-data" with default driver
    Pulling duckdns (lscr.io/linuxserver/duckdns:latest)...
    latest: Pulling from linuxserver/duckdns
    68c4ea3779b6: Pull complete
    df25a931801a: Pull complete                                                                           ab0ddebe54a6: Pull complete                                                                           19f39f464468: Pull complete
    7560e3e46aa2: Pull complete                                                                           339ecd878087: Pull complete                                                                           fdaf29876bfe: Pull complete                                                                           c606a5b2fbbd: Pull complete
    Digest: sha256:48004b34e10de8749442d4834bfa55e842410ddb561caccca022532e496c8d2e
    Status: Downloaded newer image for lscr.io/linuxserver/duckdns:latest
    Pulling caddy (lucaslorentz/caddy-docker-proxy:ci-alpine)...
    ci-alpine: Pulling from lucaslorentz/caddy-docker-proxy
    c158987b0551: Pull complete                                                                           97ee13ebe9f0: Pull complete                                                                           12d510dcf679: Pull complete
    Digest: sha256:39f7150668bd321f5bb38c71c773e06f0d4c7c2aac5777d260c8289478d0b74c
    Status: Downloaded newer image for lucaslorentz/caddy-docker-proxy:ci-alpine
    Pulling apache (php:apache)...
    apache: Pulling from library/php
    a480a496ba95: Pull complete                                                                           95ab1cc5ca33: Pull complete
    78ee5e1490ca: Pull complete                                                                           e807ae4973d0: Pull complete
    8a1846dfbe9a: Pull complete                                                                           27f1d0bbde81: Pull complete
    8fac5e585cd6: Pull complete
    d9c6f3e52ce4: Pull complete                                                                           c57873668e4a: Pull complete
    1c5e24ee9e3c: Pull complete                                                                           9480e567b6b3: Pull complete                                                                           d091998f419b: Pull complete
    a486d994d4c3: Pull complete
    Digest: sha256:6b67869eacbbd08670412998740e790632c3695c91f4157c68b3e9679073359f
    Status: Downloaded newer image for php:apache
    Pulling kuma (louislam/uptime-kuma:latest)...
    latest: Pulling from louislam/uptime-kuma
    b338562f40a7: Pull complete                                                                           874bf4d93720: Pull complete                                                                           b16337721583: Pull complete                                                                           7d955db85b85: Pull complete                                                                           2c706596bd17: Pull complete
    88a5c59ed14f: Pull complete
    5a1d0a896c33: Pull complete                                                                           e68c2f25b946: Pull complete                                                                           2e6c90f010d6: Pull complete
    ff15b10fabb8: Pull complete
    4f4fb700ef54: Pull complete
    2bb0dd8bbb19: Pull complete
    Digest: sha256:d8b1b2151256bda3a99e822902fcbeb27b3eca6ef6d93fad25d2062b9fb61ad2
    Status: Downloaded newer image for louislam/uptime-kuma:latest
    Creating duckdns ... done
    Creating apache  ... done
    Creating kuma    ... done
    Creating caddy   ... done
    hugomoruno@examenhugomaq:~$

</details>

Comprobaremos que los contenedores está todos creados ejecutamos:

```bash
docker ps
```

Y la salida será:
```bash
CONTAINER ID   IMAGE                                       COMMAND                  CREATED          STATUS                    PORTS
        NAMES
29b8d088eae9   lucaslorentz/caddy-docker-proxy:ci-alpine   "/bin/caddy docker-p…"   42 seconds ago   Up 40 seconds             0.0.0.0:80->80/tcp, :::80->80/tcp, 0.0.0.0:443->443/tcp, :::443->443/tcp, 2019/tcp   caddy
f6dfce2f6f20   louislam/uptime-kuma:latest                 "/usr/bin/dumb-init …"   42 seconds ago   Up 40 seconds (healthy)   0.0.0.0:3001->3001/tcp, :::3001->3001/tcp
        kuma
32b95c50383c   php:apache                                  "docker-php-entrypoi…"   42 seconds ago   Up 40 seconds             80/tcp
        apache
cf2c99ac5d30   lscr.io/linuxserver/duckdns:latest          "/init"                  42 seconds ago   Up 41 seconds
        duckdns
```

Una vez comprobado que todo está en pié y que funciona, por las dos urls:

- cosa.hugocastelar.duckdns.org
- monitor.hugocastelar.duckdns.org

Procedo a explicar cómo configurar uptime-kuma para dar una página de estado a un cliente.

## Páginas de estado y monitoreo interno de la máquina:

Para poder monitorear la máquina desde dentro, entro a Powershell y abro un túnel ssh de la siguiente manera:

```powershell
ssh -i ~/.ssh/examenkey -ND 2110 hugomoruno@hugocastelar.duckdns.org
```

Una vez ejecutado y visto que no devuelve nada ni deja escribir, funciona correctamente.

Entonces configuro el proxy en Firefox y pongo la siguiente configuración:

Configuración manual del proxy:
    Host SOCKS: localhost   Puerto: 2110

Pulso en aceptar y voy a la página 10.1.1.4:3001

Creo mi usuario Hugo y entro a Uptime Kuma.

Añado los monitores de los contenedores que nos interesa monitorear de la siguiente manera:

  1. Añadir nuevo monitor.
     1. Apache: 
        - Tipo de monitor HTTP(s).
        - Nombre sencillo: Apache.
        - URL: http://apache:80.
     2. Caddy:
        - Tipo de monitor TCP Port.
        - Nombre sencillo: Caddy.
        - Nombre del host: caddy.
        - Puerto: 80.

Ahora, añado una pantalla de monitoreo externo de la siguiente manera:

  1. Páginas de estado.
  2. Nueva página de estado.
     1. Nombre: kumahugo
     2. Slug: /status/kumahugo
  3. Agregar grupo:
     1. Agregar Monitor:
        1. Apache
        2. Caddy

Ahora la página de estado de Kuma para clientes se podrá ver desde: 

monitor.hugocastelar.duckdns.org/status/kumahugo

# Ejercicios del examen

## 1. Servicio apache montado en VPS.

[-> Índice](#índice)

Ejecutar:
```bash
curl http://4.251.114.138/
```

## 2. Ruta por subdominio.

Ejecutar:
```bash
curl http://cosa.hugocastelar.duckdns.org/
```
