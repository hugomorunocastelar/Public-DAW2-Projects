const INPUT = document.getElementById('input');

var intervalo;

window.addEventListener('load', () => {

    INPUT.addEventListener('mouseenter', ponerRojo);
    INPUT.addEventListener('mouseleave', quitarRojo);

});

function ponerRojo(){
    INPUT.style.backgroundColor = '#F00';
    clearInterval(intervalo);
}

function quitarRojo()
{
    intervalo = setTimeout(()=>{
        INPUT.style.backgroundColor = '#FFF'; 
    }, 1000);
}