const MAXNUMBER = 1000;                                                 
const NUMEROSECRETO = parseInt(MAXNUMBER*Math.random());
const prompt = require('prompt-sync')();

let numeroDeIntentos = 5;
let numeroencontrado = false;

// console.log("No se lo digas a nadie (chsssss): " + NUMEROSECRETO);  //Te chiva el número

do 
{
    // console.log(numeroDeIntentos);       // Te lee el número de intentos
    // console.log(numeroencontrado);       // Te lee el estado del booleano de salida
    entradaDeNumero = prompt('¿Qué número crees que es el ganador? (Entre el 0 y el 1000) (Intentos restantes: ', numeroencontrado,' ): ');      //Lee por consola el número
    if (entradaDeNumero == 'exit')      //Cierra la aplicación
    {
        window.close();
    }
    if (parseInt(entradaDeNumero))      //Comprueba si el texto introducido es un número
    { 
        if (entradaDeNumero >= 0 && entradaDeNumero <= 1000)  //Comprueba que el número está en el arco especificado
        {
            if (entradaDeNumero == NUMEROSECRETO)             //Comprueba que el número es el correcto y si lo es, cierra el bucle.
            {
                console.log("ENHORABUENA!")
                numeroencontrado = true;
                numeroDeIntentos = 0;
            }
            else
            {
                console.log("Número incorrecto")
                numeroDeIntentos = numeroDeIntentos - 1;
}                                                             //Si el número no es el correcto, repite el bucle restanto un intento.
        }
        else
            console.log("Numero fuera del rango.")
    } 
    else 
    {
        console.log("No es un número.")
    }
} 
while (!numeroencontrado || numeroDeIntentos > 0)               //Condición del bucle
    
console.log("SE ACABÓ!")