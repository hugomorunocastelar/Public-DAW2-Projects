# Simulacro examen Hugo Moruno

## Requisitos

- [ ] Crear un servidor de apache en un vps
- [ ] Visible desde el mundo en el puerto 80 y 443
- [ ] Subdominio de DuckDNS
- [ ] Cabeceras del servidor anonimizadas
- [ ] Documentado

## Creación de la máquina virtual

Para crear la máquina virtual, en mi caso he elegido el servicio Azure de Microsoft.

Los pasos a seguir son los siguientes:

<details>

    Antes de empezar, debemos crear la clave ssh si no la tenemos, y se hace de la siguiente manera:
    ```powershell
    ssh-keygen -t ed25519
    ```

    Y la salida debería ser algo así:
    ```powershell
    PS C:\Users\hugom> ssh-keygen -t ed25519
    Generating public/private ed25519 key pair.
    Enter file in which to save the key (C:\Users\hugom/.ssh/id_ed25519): pruebaexamen
    Enter passphrase (empty for no passphrase):
    Enter same passphrase again:
    Your identification has been saved in pruebaexamen
    Your public key has been saved in pruebaexamen.pub
    The key fingerprint is:
    SHA256:b7OMtE1Fd0y7mHOdS1oxrT7D4VjrIQN/s0yAg9tZ5lk hugom@M5
    The key's randomart image is:
    +--[ED25519 256]--+
    |                .|
    |               oo|
    |            . .++|
    |         . o .oo*|
    |        S + =+E*.|
    |         + X X*o.|
    |        o B B.%. |
    |       . B o B * |
    |        o +   +  |
    +----[SHA256]-----+
    PS C:\Users\hugom>
    ```

    Aquí se ve que he introducido el nombre de archivo prueba examen.

</detail>

1. Entrar en portal.azure.com y registrarte cumplimentando con la cuenta corporativa @iescastelar.com.
2. Elegir la suscripción de Azure For Students.
3. Buscar en la barra superior Servicios Gratuitos.
4. Seleccionar Máquina Virtual de Linux.
5. Cumplimentar de la siguiente manera (en mi caso):
    - Suscripción: Azure For Students
    - Grupo de recursos: hugopruebaexamen
    - Nombre de la máquina virtual: maquinapruebaexamen
    - Región: France Central.
    - Imagen: Ubuntu Server 22.04 LTS - x64 gen. 2
    - Tamaño: Standard_B1s - 1 vcpu, 1 GiB de memoria (8,61 US$/mes) (servicios gratuitos elegibles)
    - Tipo de autenticación: Clave pública ssh
    - Nombre de usuario: hugomoruno
    - Origen de clave pública ssh: Usar la clave pública existente
    - Clave pública: Contenido de la clave pública, en mi caso:
    ```powershell
    ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIHTqsXHc62lExNUoq3dLvO1vpMYTuwA6Iva2rdHMQVDl hugom@M5
    ```
    - Puertos de entrada públicos: Permitir los puertos seleccionados
    - Seleccionar puertos de entrada: HTTP (80), HTTPS (443), SSH (22)

Pulsamos en siguiente: Etiquetas
Pulsamos en siguiente: Revisar y Crear
Una vez nos aparezca el siguiente texto en el cual se encuentra el contenido del contrato de la máquina, podemos crearla:

Suscripción: Azure for Students
Grupo de recursos: (nuevo) hugopruebaexamen
Nombre de máquina virtual: maquinapruebaexamen
Región: France Central
Imagen: Ubuntu Server 22.04 LTS - Gen2
Tamaño: Standard B1s (1 vcpu, 1 GiB de memoria)
Tipo de autenticación: Clave pública SSH
Nombre de usuario: hugomoruno
Formato de clave SSH: Ed25519
Puertos de entrada públicos: SSH, HTTP, HTTPS

Y Creamos la máquina.

## Obtención del subdominio de DuckDNS

Una vez creada la máquina, vamos a duckdns.org, nos registramos y creamos un subdominio con la ip pública de la máquina recién creada.
La IP pública se puede consultar en la página de información de la propia máquina. (51.103.96.53)

Una vez dentro de la página, estando registrado, pongo pruebaexamenhugocastelar en el campo de añadir subdominio y le doy a añadir,
entonces aparece este mensaje: **success: ip address for pruebaexamenhugocastelar.duckdns.org updated to 51.103.96.53**

## Instalación de docker en la máquina

Ahora, una vez hayamos creado el subdominio, abro una terminal de powershell e introduzco el siguiente comando:

```powershell
ssh -i ~/.ssh/pruebaexamen hugomoruno@51.103.96.53

# En este caso, uso -i porque como tengo varias claves en el directorio, no la reconoce automáticamente.
```

Y la salida sería la siguiente:
```powershell
PS C:\Users\hugom> ssh -i ~/.ssh/pruebaexamen hugomoruno@51.103.96.53
Enter passphrase for key 'C:\Users\hugom/.ssh/pruebaexamen':
Welcome to Ubuntu 22.04.5 LTS (GNU/Linux 6.5.0-1025-azure x86_64)

 * Documentation:  https://help.ubuntu.com
 * Management:     https://landscape.canonical.com
 * Support:        https://ubuntu.com/pro

 System information as of Mon Oct 28 09:33:27 UTC 2024

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

hugomoruno@maquinapruebaexamen:~$
```

Para instalar Docker, ejecuto los siguientes comandos:
```bash
curl -fsSL https://get.docker.com -o get-docker.sh
```
```bash
sudo sh get-docker.sh
```

La salida será la siguiente: 

<details>

```bash
hugomoruno@maquinapruebaexamen:~$ curl -fsSL https://get.docker.com -o get-docker.sh
hugomoruno@maquinapruebaexamen:~$ sudo sh get-docker.sh
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

hugomoruno@maquinapruebaexamen:~$
```

</details>

Ahora configuro el usuario actual para que tenga permisos de usuario docker

```bash
sudo usermod -aG docker $USER
newgrp docker
```

Una vez instalado, instalaremos el módulo de docker compose
```bash
sudo apt update
sudo apt install docker compose
```

La salida será la siguiente: 

<details>

```bash
hugomoruno@maquinapruebaexamen:~$ sudo apt update
Hit:1 http://azure.archive.ubuntu.com/ubuntu jammy InRelease
Hit:2 http://azure.archive.ubuntu.com/ubuntu jammy-updates InRelease
Hit:3 http://azure.archive.ubuntu.com/ubuntu jammy-backports InRelease
Hit:4 http://azure.archive.ubuntu.com/ubuntu jammy-security InRelease
Hit:5 https://download.docker.com/linux/ubuntu jammy InRelease
Reading package lists... Done
Building dependency tree... Done
Reading state information... Done
12 packages can be upgraded. Run 'apt list --upgradable' to see them.
hugomoruno@maquinapruebaexamen:~$ sudo apt install docker compose
Reading package lists... Done
Building dependency tree... Done
Reading state information... Done
The following additional packages will be installed:
  python3-docker python3-dockerpty python3-docopt python3-dotenv python3-texttable python3-websocket
Recommended packages:
  docker.io
The following NEW packages will be installed:
  docker compose python3-docker python3-dockerpty python3-docopt python3-dotenv python3-texttable python3-websocket
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
Fetched 290 kB in 0s (4998 kB/s)
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
hugomoruno@maquinapruebaexamen:~$
```

</details>

## Creación de las redes internas a usar 

Para este ejercicio voy a usar dos redes:

La red del proxy y los servicios: red_interna
La red de kuma y los servicios: red_monitor

Ejecuto los comandos de creación de redes:

```bash
docker network create red_interna
docker network create red_monitor
```

Ahora compruebo que se hayan creado:
```bash
hugomoruno@maquinapruebaexamen:~$ docker network ls
NETWORK ID     NAME          DRIVER    SCOPE
9fa4b0e46723   bridge        bridge    local
9f877b05c328   host          host      local
ead6eb790f4d   none          null      local
410db91c1b31   red_interna   bridge    local
4b990d608d8e   red_monitor   bridge    local
hugomoruno@maquinapruebaexamen:~$
```

Una vez hecho, creo la estructura de carpetas de archivos necesarios:

```bash
mkdir apache apache/public apache/config
touch apache/public/index.php
touch apache/config/security.conf

sudo echo "<?php phpInfo(); ?>" >> apache/public/index.php
sudo echo "
ServerTokens Prod
ServerSignature Off
TraceEnable Off" >> apache/config/security.conf

```

La salida será la siguiente:
<details>

```bash
hugomoruno@maquinapruebaexamen:~$ mkdir apache apache/public apache/config
touch apache/public/index.php
touch apache/config/security.conf

sudo echo "<?php phpInfo(); ?>" >> apache/public/index.php
sudo echo "ServerTokens Prod
ServerSignature Off
TraceEnable Off" >> apache/config/security.conf
hugomoruno@maquinapruebaexamen:~$ ls -R
.:
apache  get-docker.sh

./apache:
config  public

./apache/config:
security.conf

./apache/public:
index.php
hugomoruno@maquinapruebaexamen:~$

hugomoruno@maquinapruebaexamen:~$ cat apache/public/index.php
<?php phpInfo(); ?>
hugomoruno@maquinapruebaexamen:~$ cat apache/config/security.conf

ServerTokens Prod
ServerSignature Off
TraceEnable Off
hugomoruno@maquinapruebaexamen:~$


```

</details>

Una vez creada la estructura, creo el archivo docker-compose.yml

```bash
touch docker-compose.yml
```

Cuyo contenido será:

````yml
    services:
        duckdns:
            image: lscr.io/linuxserver/duckdns:latest
            container_name: duckdns
            network_mode: host #optional
            environment:
                - PUID=1000 #optional
                - PGID=1000 #optional
                - TZ=Etc/UTC #optional
                - SUBDOMAINS=pruebaexamenhugocastelar
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

        httpd:
            image: php:apache
            container_name: apache
            networks:
                - red_interna
                - red_monitor
            volumes:
                - ./apache/public:/var/www/html
                - ./apache/config/security.conf:/etc/apache2/conf-available/security.conf
            labels:
                caddy: "pruebaexamenhugocastelar.duckdns.org"
                caddy.reverse_proxy: "{{upstreams 80}}"
                caddy.tls: "internal"

        uptime-kuma:
            restart: always
            network:
                - red_monitor
            ports:
                - 3001:3001
            volumes:
                - uptime-kuma:/app/data
            container_name: uptime-kuma
            image: louislam/uptime-kuma:1
            
        

    networks:
        red_interna:
            external: true
        red_monitor:
            external: true

    volumes:
    caddy_data: {}
    uptime-kuma:
            name: uptime-kuma

````

Ahora, una vez levantado, comprobamos en internet que podemos ver la página pruebaexamenhugocastelar.duckdns.org.

Una vez comprobado, abro un túnel ssh y entro a 10.1.1.4 (ip privada de la máquina virtual) :3001. Viendo que kuma funciona.
Para abrir el túnel ejecuto lo siguiente:

```bash

```


REALIZADO EN 1H 10M
