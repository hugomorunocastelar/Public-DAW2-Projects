"use strict";
const prompt = require('prompt-sync')();

var equipos = new Map();
var exit = false;

var equipoPrueba = new Map();
equipoPrueba.set(0, 'A');
equipoPrueba.set(2, 'B');
equipoPrueba.set(10, 'C');
equipoPrueba.set(4, 'D');
equipoPrueba.set(99, 'E');
equipos.set('prueba', equipoPrueba);

do
{
    console.log(                                                            //Imprime menú del programa
        '\n Equipos de futbol 5 / Sala',
        '\n 1. Introducir Equipo.',
        '\n 2. Buscar jugador en un equipo por numero.',
        '\n 3. Pintar un equipo.',
        '\n 4. Salir',
        '\n Opción:'
    )
    var opcion = prompt();

    switch (opcion)                                                         //Evalúa qué opción se ha elegido
    {
        case '1':                                                           //Opción para introducir un equipo nuevo

            var equipo = new Map();                                         //Crea el equipo vacío     
            console.log('Introduce el nombre del Equipo:')                  
            var nombreEquipo = prompt();                                    //Nombre del equipo
            for(let jugadores = 0; jugadores < 5;)
            {
                console.log('Introduce el número del jugador (Desde el 0 al 99):')          //Se introducen los 5 jugadores, su número y nombre
                var numero = prompt()
                if (parseInt(numero))
                {
                    if (parseInt(numero) < 100 && parseInt(numero) >= 0)
                    {
                        console.log('Introduce el nombre del jugador:')
                        var nombre = prompt();
                        equipo.set(numero, nombre);                         //Aquí se guarda el jugador
                        jugadores++;
                    }
                    else
                    {
                        console.log('El número está fuera del rango predeterminado.')
                    }
                }
                else
                {
                    console.log('El término introducido no es un número');
                }
            }
            equipos.set(nombreEquipo, equipo);                              //Aquí se guarda el equipo creado

            break;

        case '2':                                                           //Opción para elegir un equipo y dentro del equipo el jugador a inspeccionar

            equipos.forEach((equipo, key) =>                                //Menciona los equipos existentes
            {
                console.log('Nombre: ',key);
            })

            console.log('Introduce el nombre del equipo que deseas inspeccionar:')
            var equipoBuscado = prompt();

            if (equipos.has(equipoBuscado))                                 //Si existe el equipo, lo inspecciona y muestra los indices de los jugadores     
            {
                var equipoQueSeInspecciona = equipos.get(equipoBuscado);
                console.log('Números: ');
                equipoQueSeInspecciona.forEach((jugador, key) =>
                {
                    console.log(key);
                });
                console.log('Introduce el número del jugador del equipo que desees conocer:');      //Se introduce el número del jugador que se requiere
                var jugadorBuscado = prompt();
                if (parseInt(jugadorBuscado))
                {
                    console.log('Nombre del jugador: ',equipoQueSeInspecciona.get(parseInt(jugadorBuscado)));
                }
                else
                {
                    console.log('Jugador no registrado.');
                }
            }
            else
            {
                console.log('Equipo no registrado.')
            }

            break;
        case '3':                                                           //Opción que dibuja la alineación del equipo que se seleccione
            
            equipos.forEach((equipo, key) => 
            {
                console.log('Nombre: ',key);
            })

            console.log('Introduce el nombre del equipo que deseas pintar:')
            var equipoBuscado = prompt();

            if (equipos.has(equipoBuscado))                                 //Si se ha elegido un equipo correctamente se procede a dar         
            {                                                               //  formato a los números para que se mantenga el dibujo visualmente
                var equipoAPintar = equipos.get(equipoBuscado);
                var contador = 0, jug1, jug2, jug3, jug4, jug5;
                equipoAPintar.forEach((valor, key) => 
                    {
                        switch(contador)
                        {
                            case 0:
                                jug1 = key;
                                if (jug1 < 10 && !(toString(jug1).includes('0')))
                                {
                                    jug1 = '0'+jug1;
                                }
                                break;
                            case 1:
                                jug2 = key;
                                if (jug2 < 10 && !(toString(jug2).includes('0')))
                                {
                                    jug2 = '0'+jug2;
                                }
                                break;
                            case 2:
                                jug3 = key;
                                if (jug3 < 10 && !(toString(jug3).includes('0')))
                                {
                                    jug3 = '0'+jug3;
                                }
                                break;
                            case 3:
                                jug4 = key;
                                if (jug4 < 10 && !(toString(jug4).includes('0')))
                                {
                                    jug4 = '0'+jug4;
                                }
                                break;
                            case 4:
                                jug5 = key;
                                if (jug5 < 10 && !(toString(jug5).includes('0')))
                                {
                                    jug5 = '0'+jug5;
                                }
                                break;
                        }
                        contador++;
                    });
                console.log(                                                //Se dibuja por consola el campo y a los jugadores
                    ' _________________',
                 '\n|                 |',
                 '\n|      ',jug1,'       |',
                 '\n|                 |',
                 '\n|  ',jug2,'     ',jug3,'  |',
                 '\n|                 |',
                 '\n|      ',jug4,'       |',
                 '\n|                 |',
                 '\n|      ',jug5,'       |',
                 '\n|_________________|'
                )

            }
            else
            {
                console.log('Equipo no registrado.')
            }

            break;

        case '4':                                                           //Opción para salir del menú y cerrar la aplicación 

            exit = true;

            break;

        default:

            console.log('Opción incorrecta.');
    }

}while(!exit)