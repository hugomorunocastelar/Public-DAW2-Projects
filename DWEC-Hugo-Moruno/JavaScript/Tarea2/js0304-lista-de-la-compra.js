"use strict";
const prompt = require('prompt-sync')();
        
var vacio = false;
var listaCompra = [];                                   //Se crea la lista de la compra (Array)

do
{
    console.log('Introduce un objeto a la lista (Vacio para terminar): ')
    var objetoIntroducido = prompt();
    if (objetoIntroducido.trim().valueOf() != "")       //Se comprueba que el objeto de la lista de la compra no está vacío
    {
        listaCompra.push(objetoIntroducido);
    } 
    else
    {
        vacio = true;
    }

} while (!vacio)

console.log("Ordenando la lista...");

listaCompra.sort();                                     //Se ordena la lista según orden de caracteres de la Unicode.

console.log('Ordenada!');

listaCompra.forEach((objeto) =>                         //Se muestra la lista ordenada
{
    console.log(objeto)
});