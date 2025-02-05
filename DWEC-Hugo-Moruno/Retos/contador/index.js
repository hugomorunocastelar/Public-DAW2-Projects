
const mas = document.getElementById('mas');
const menos = document.getElementById('menos');
const num = document.getElementById('num');


window.addEventListener('load', () => {

    mas.addEventListener('click', sumar);
    menos.addEventListener('click', restar);

});

function sumar()
{
    num.value = Number(num.value) + 1;
}

function restar()
{
    num.value = Number(num.value) - 1;
}