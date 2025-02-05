"use strict";
const prompt = require('prompt-sync')();

const FORMATO_OPERACION = /^\s*\d+\s*([+\-*/%^])\s*\d+\s*$/;
const FORMATO_FACTORIAL = /^\d+!$/;

//INICIO DEL PROGRAMA {main}

var acumulador = 0;
var memoria = 0;
var terminado = false;

do
{
    var opcion = menu();
    if (opcion != 'exit')
    {
        var resultado = identificarOperacion(opcion);
        acumulador = parseFloat(resultado);
        console.log(resultado);
    }
    else 
    {
        terminado = true;
    }
    
} while(!terminado);

//FUNCIONES

//Dibujar el menú de selección

function menu()
{
    console.log(
        '\n CALCULADORA',
        '\n Introduzca una operación de un solo símbolo',
        '\n( M => guarda el último resultado )',
        '\n( R => muestra el último resultado )',
        '\n( B => reinicia la calculadora )',
        '\n( + , - , * , / , % , ! , ^ ):'
    )
    return opcion = prompt();
}

//Con expresiones regulares comprueba la cadena de entrada y actúa en consecuencia

function identificarOperacion(operacion)
{
    if (FORMATO_OPERACION.test(operacion)) 
    {
        var operador = operacion.match(FORMATO_OPERACION)[1];

        var operacionArray = operacion.split(operador);
        var operando1 = parseInt(operacionArray[0]),
            operando2 = parseInt(operacionArray[1]);

        switch (operador) 
        {
            case '+':

                return operando1 + operando2;

            case '-':

                return operando1 - operando2;

            case '*':

                return operando1 * operando2;
                
            case '/':

                return operando1 / operando2;

            case '%':

                return operando1 % operando2;

            case '^':

                return Math.pow(operando1, operando2);
        }
    }
    else if (FORMATO_FACTORIAL.test(operacion))
    {
        var valores = operacion.split('!');
        var operando = parseInt(valores[0]);
        return (factorial(operando));
    }
    else if(operacion.trim() == 'M')
    {
        memoria = acumulador;
        return memoria; 
    }
    else if(operacion.trim() == 'R')
    {
        acumulador = memoria;
        return acumulador;
    }
    else if(operacion.trim() == 'B')
    {
        acumulador = 0;
        memoria = 0;
    }
    else 
    {
        return 'Operación invalida';
    }
}

//Calcula el factorial del número introducido

function factorial(n) 
{
    let resultado = 1;
    for (let iteraciones = 2; iteraciones <= n; iteraciones++) 
    {
        resultado = resultado * iteraciones;
    }
    return resultado;
}