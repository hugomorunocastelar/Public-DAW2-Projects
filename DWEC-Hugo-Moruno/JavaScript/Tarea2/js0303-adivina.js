"use strict";
const prompt = require('prompt-sync')();

const generaNumeros = () =>                                             //Función que asigna los números secretos a la constante NUMEROS_ALEATORIOS
    {
        var listaDeNumeros = [];
        for(let numeros = 0; numeros < 10; numeros++)
        {
            listaDeNumeros.push(parseInt(Math.random()*20));            //Se rellena la lista con randoms
        }
        return listaDeNumeros;
    }

const NUMEROS_ALEATORIOS = generaNumeros();                             //Se asignan los números a la constante 

var numerosDelUsuario = [];
for(let numeros = 1; numeros <= 5;numeros++)                            //Bucle de lectura de números
{
    console.log('Introduce el ',numeros,'º número: ')
    var numeroIntroducido = prompt();
    if (parseInt(numeroIntroducido))
    {
        numerosDelUsuario.push(parseInt(numeroIntroducido));
    } 
    else 
    {
        console.log('Esto no es un número entero.');
    }
}

console.log('Final!\n \nRESULTADOS:')

var numerosEncontrados = [];
NUMEROS_ALEATORIOS.forEach( (numero) =>                                 //Bucle que lee los números aleatorios,      
{                                                                       //  los compara con los introducidos y 
    if(numerosDelUsuario.includes(numero))                              //  pinta de verde los que se han adivinado 
    {                                                                   //  y más tarde escribe todos los números acertados
        console.log('\x1b[32m%s\x1b[0m',numero);
        numerosEncontrados.push(numero);
    }
    else
    {
        console.log(numero);
    }
});

console.log('Números encontrados: ',numerosEncontrados);