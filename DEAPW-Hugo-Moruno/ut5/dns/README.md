# Practica 5 DNS

## Índice

- [Practica 5 DNS](#practica-5-dns)
  - [Índice](#índice)
  - [Lista de requisitos](#lista-de-requisitos)
  - [Base del ejercicio](#base-del-ejercicio)
      - [Requisitos del ejercicio](#requisitos-del-ejercicio)
      - [Pasos](#pasos)
        - [vagrantfile](#vagrantfile)
  - [Núcleo del Ejercicio](#núcleo-del-ejercicio)
  - [Microservicio: dnsmasq](#microservicio-dnsmasq)
    - [Configuración del servicio](#configuración-del-servicio)
    - [Direcciones](#direcciones)


## Lista de requisitos 

[-> Índice](#índice)

- [x] Crear la máquina virtual.
  - [x] Instalación de Docker (A través del provision).
- [x] Estructura.
- [x] Creación del microservicio: dnsmasq.
  - [x] Configuración de dnsmasq.

## Base del ejercicio 

[-> Índice](#índice)

*Vagrant y VirtualBox*

#### Requisitos del ejercicio

- Máquina con Windows 10 o superior.
- Conexión a internet.
- Instalación de Vagrant 2.x.x.
- Instalación de VirtualBox 7.0.x (Las distribuciones de 7.1.x no soportan vagrant; 3/10/2024).

#### Pasos

- Una vez hecho todo lo anterior, comenzaremos creando una máquina virtual genérica con el sistema debian12 (3/10/2024; v4.3.12 [Vagrant box debian12](https://app.vagrantup.com/generic/boxes/debian12)) basado en la versión del núcleo de Linux: 6.1.0-17-amd64

  - Para ello abriremos una terminal en powershell y nos situamos en la carpeta que deseemos.
  - Una vez situados, ejecutaremos el siguiente comando:
  ```powershell
  vagrant init generic/debian12
  ```

  ##### vagrantfile

  - Debemos comprobar que se nos ha creado el archivo *vagrantfile* sin extensión.
  - Una vez creado, sustituiremos todo su contenido por el siguiente:
  [Vagrantfile](./Vagrantfile)
  - Ahora, crearemos el archivo provision.sh e introduciremos el siguiente contenido:
  [provision.sh](./provision.sh)
  - En la misma carpeta, ejecutamos el comando:
  ```powershell
  vagrant up
  ```

## Núcleo del Ejercicio 

[-> Índice](#índice)

*ADVERTENCIA*

Todos los comandos a continuación se ejecutan dentro de la máquina virtual, para ello debemos hacer lo siguiente:
1. Comprobar el hash de las máquinas disponibles:
```powershell
vagrant global-status

PS E:\DEAPW-Hugo-Moruno\ut5\dns> vagrant global-status
id       name    provider   state   directory
--------------------------------------------------------------------------
84bed71  default virtualbox running E:/Vagrant
ebe1aea  default virtualbox running E:/DEAPW-Hugo-Moruno/ut5/dns
```
2. Una vez comprobado, copiamos el que nos interesa, en este caso **ebe1aea**.
3. Ahora ejecutamos el siguiente comando:
```powershell
vagrant ssh ebe1aea

PS E:\DEAPW-Hugo-Moruno\ut5\dns> vagrant ssh ebe1aea
vagrant@debian12:~$     #Ya estamos dentro de la máquina.
```

## Microservicio: dnsmasq

[-> Índice](#índice)

Para ello, creamos una carpeta en ~ (/home/vagrant) de nombre dnsmasq.
```bash
mkdir dnsmasq
```

Dentro, creamos un docker-compose.yml.
```bash
touch docker-compose.yml
```

Y creamos el siguiente contenido:
[docker-compose.yml](./dnsmasq/docker-compose.yml)


### Configuración del servicio

Para poder configurar el servicio, necesitamos el archivo dnsmasq.conf. Entonces, seguiremos los siguientes pasos:

1. Comentar lo siguiente en el docker-compose.yml.

```yml
#    volumes:
#      - ./dnsmasq.conf:/etc/dnsmasq.conf
```

2. Levantar el servicio.

```bash 
docker compose up -d
```

3. Hacer una copia del archivo de configuración predeterminado que hay dentro del microservicio.

```bash
docker exec -it dnsmasq-dns-1 cat /etc/dnsmasq.conf > dnsmasq.conf
```

4. Descomentar las anteriores líneas del docker-compose y relanzar el microservicio (```docker compose up -d```)

### Direcciones

```conf
address=/profesor.local/192.168.60.100  
address=/alumno.local/192.168.60.194  
address=/youtube.com/127.0.0.1 
mx-host=ejemplout5hugo.com,mail.example.com,1
```
