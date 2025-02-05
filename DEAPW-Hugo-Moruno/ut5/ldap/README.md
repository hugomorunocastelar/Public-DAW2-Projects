# Práctica 5.2 LDAP

**LDAP**  

https://monitor.ahut5ldap.duckdns.org/

- user: ldap 
- password: ldap_ldap

https://phpapache.ahut5ldap.duckdns.org/

- user: hugo 
- password: hugopassword

- user: ana
- password: anapassword

## Índice

- [Práctica 5.2 LDAP](#práctica-52-ldap)
  - [Índice](#índice)
  - [Requisitos](#requisitos)
- [Base del Ejercicio](#base-del-ejercicio)
  - [Creación de la Máquina virtual](#creación-de-la-máquina-virtual)
  - [Obtención de subdominio DuckDNS](#obtención-de-subdominio-duckdns)
  - [Instalación de Docker](#instalación-de-docker)
    - [Creación de las redes de los contenedores](#creación-de-las-redes-de-los-contenedores)
  - [Instalación del contenedor autoupdater de DuckDNS](#instalación-del-contenedor-autoupdater-de-duckdns)
  - [Instalación del contenedor de Caddy](#instalación-del-contenedor-de-caddy)
  - [Instalación del contenedor de Uptime-Kuma](#instalación-del-contenedor-de-uptime-kuma)
- [Configuración de los contenedores de ldap y phpldapadmin](#configuración-de-los-contenedores-de-ldap-y-phpldapadmin)

## Requisitos

  - [x] Creación de la máquina VPS. 
    - [x] Configuración de la VPS.
      - [x] Obtener el subdominio de DuckDNS.
      - [x] Instalar Docker.
      - [x] Configurar el contenedor de DuckDNS.
      - [x] Instalar contenedor de Caddy (Proxy).
      - [x] Instalar contenedor de Kuma (Monitor).

# Base del Ejercicio

[-> índice](#índice)

Sobre una máquina virtual de Azure, voy a crear el siguiente sistema:

- VPS:
  - Docker:
    - Caddy:
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
- Grupo de recursos: (Nuevo) ut5-ldap
- Nombre de máquina virtual: maquinaldap
- Región: (yo voy a elegir (Europe) France Central, pero cualquiera en Europa sirve) (Europe) France Central.
- Imagen: Ubuntu Server 22.04 LTS - x64 gen. 2
- Tamaño: Standard_B1s - 1 vcpu, 1 GiB de memoria (8,61 US$/mes) (servicios gratuitos elegibles)
- Tipo de autenticación: Clave pública SSH
- Nombre de usuario: ldapadmin
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
    Enter file in which to save the key (C:\Users\daw2/.ssh/id_ed25519): ldap_key
    Enter passphrase (empty for no passphrase):
    Enter same passphrase again:
    Your identification has been saved in ldap_key
    Your public key has been saved in ldap_key.pub
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
    mv ~/ldap_key ~/.ssh/ldap_key
    mv ~/ldap_key.pub ~/.ssh/ldap_key.pub
    ```

    Entonces la carpeta .ssh ya tendrá las claves nuevas:
    ```powershell
    PS C:\Users\daw2> dir ~/.ssh


        Directorio: C:\Users\daw2\.ssh


    Mode                 LastWriteTime         Length Name
    ----                 -------------         ------ ----
    -a----        28/10/2024     17:48           1859 known_hosts
    -a----        28/10/2024     17:48           1115 known_hosts.old
    -a----        17/10/2024     16:11            464 ldap_key
    -a----        17/10/2024     16:11            103 ldap_key.pub


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
configuro mi dominio ahut5ldap.duckdns.org en la ip pública de la máquina: 
4.251.118.102

Una vez creado, nos aparecerá un mensaje de success como el siguiente:

success: domain ahut5ldap.duckdns.org added to your account

Y ahora actualizamos la IP con la IP Pública de la máquina, nos aparecerá el siguiente mensaje:

success: ip address for ahut5ldap.duckdns.org updated to 4.251.118.102

## Instalación de Docker

[-> Índice](#índice)

Ahora, para poder iniciar los trabajos en la máquina virtual, debemos ejecutar el siguiente comando:
```powershell
ssh -i ~/.ssh/ldap_key ldapadmin@4.251.118.102
```

Ejecutando este comando, accedemos a la máquina (en mi caso he usado 
-i para especificar qué llave quiero usar ya que tengo más de una en mi carpeta)    
<details>

    PS C:\Users\hugom\.ssh> ssh -i ~/.ssh/ldap_key ldapadmin@4.251.118.102
    Enter passphrase for key 'C:\Users\hugom/.ssh/ldap_key':
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

    ldapadmin@maquinaldap:~$
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

    ldapadmin@maquinaldap:~$ curl -fsSL https://get.docker.com -o get-docker.sh
    ldapadmin@maquinaldap:~$ sudo sh get-docker.sh
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

    ldapadmin@maquinaldap:~$
</details>

¡Instalado! Ahora, hay que configurar nuestro usuario como usuario Docker, para ello:
```bash
sudo groupadd docker
sudo usermod -aG docker $USER
newgrp docker
```

Y si compruebo con el comando:
```bash
groups ldapadmin

#Ésta sería la salida
ldapadmin : ldapadmin adm dialout cdrom floppy sudo audio dip video plugdev netdev lxd **docker**
```

Como veo que ya está docker, está todo correcto.

### Creación de las redes de los contenedores

[-> Índice](#índice)

Para la estructura con el servicio de proxy, necesitaremos la red de docker: red_interna.
A su vez, como planteo la instalación de un servicio de monitorización, crearemos la red: red_ldap.

Los comandos serán los siguientes:

```bash
docker network create red_interna
docker network create red_ldap
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
SUBDOMAINS=ahut5ldap
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

    ldapadmin@maquinaldap:~/duckdns$ docker compose up -d
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
    ldapadmin@maquinaldap:~/duckdns$
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
rsync -a -e "ssh -i ~/.ssh/ldap_key" /mnt/e/DEAPW-Hugo-Moruno/ut3/jakartaEE/caddy hugomoruno@ahut5ldap.duckdns.org:/home/hugomoruno/ 
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
rsync -a -e "ssh -i ~/.ssh/ldap_key" /mnt/e/DEAPW-Hugo-Moruno/ut3/jakartaEE/kuma hugomoruno@ahut5ldap.duckdns.org:/home/hugomoruno/ 
```

Y ahora, iniciamos el contenedor de kuma.

<details>

    ldapadmin@maquinaldap:~/kuma$ docker compose up -d
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
    ldapadmin@maquinaldap:~/kuma$
</details>

Ahora, iniciamos una conexión privada por túnel ssh, en mi caso es el siguiente comando:
```powershell
ssh -ND 2110 hugomoruno@ahut5ldap.duckdns.org -i ~/.ssh/ldap_key

# -N Para no utilizar la conexión manualmente, -D Para el tunel directo, 
# 2110 puerto de mí maquina que voy a usar para la conexión.
```

Una vez iniciada la conexión, vamos a un navegador que pueda configurar el proxy y ponemos:
Proxy: localhost : 2110
Protocolo: SOCKs V.5.

Ahora buscamos la ip privada de la máquina virtual que en mi caso es: 10.1.1.4 y accedemos desde
el navegador configurado en la ruta http://10.1.1.4:3001/.

Ahí podremos monitorear el entorno creado desde dentro de la red_ldap.

# Configuración de los contenedores de ldap y phpldapadmin

[-> Índice](#índice)

Para la configuración de ambos microservicios, he elegido los contenedores del publisher osixia.

OpenLdap:

1. Creamos el directorio:
  
```bash
mkdir ldap
```

2. Creamos el docker compose con el contenido de [openldap](./ldap/docker-compose.yml)

```bash 
touch docker-compose.yml
```

3. Ejecuto ````docker compose up -d```

PhpLdapAdmin:

1. Creamos el directorio:
  
```bash
mkdir phpldap
```

2. Creamos el docker compose con el contenido de [phpldap](./phpldap/docker-compose.yml)

```bash 
touch docker-compose.yml
```

3. Ejecuto ````docker compose up -d```

Y una vez ejecutado todo, creamos un tunel seguro a la máquina, en mi caso: ```ssh -i ~/.ssh/ldap_key -ND 2110 ldapadmin@ahut5ldap.duckdns.org```,
configuro el proxy de firefox en SOCKS v5 y pongo el puerto 2110. Una vez hecho, entro en la url http://10.1.1.4:8080 y accedo a el servicio de ldap.

Una vez accedo, entro en la pestaña de import y pego el contenido del archivo [ldif](./phpldap/ldap.ldif). Entonces me devolverá:
```txt
Adding ou=users,dc=example,dc=org Success
Adding cn=hugo,ou=users,dc=example,dc=org Success
Adding cn=ana,ou=users,dc=example,dc=org Success
```

Y entonces ya tendré añadidos y creados los usuarios de Ana, de Hugo y la unidad organizxativa de usuarios.

