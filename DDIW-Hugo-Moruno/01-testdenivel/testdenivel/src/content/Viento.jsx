import React from 'react';
import './styles/Viento.css'

export default function Viento() {
  return (
    <div>
      <section className="container" style={{ textAlign: 'center', padding: '50px' }}>
        <h1>Instrumentos de Viento</h1>
        <hr />
        <p>
          Los instrumentos de viento, o aerófonos, son aquellos que producen sonido mediante el movimiento del aire a través de ellos. Algunos ejemplos populares incluyen la flauta, el clarinete y la trompeta.
        </p>
        <p>
          Estos instrumentos tienen una rica historia y son esenciales en muchas formas de música, desde orquestas clásicas hasta bandas de jazz.
        </p>
        <img src="https://cdn.pixabay.com/photo/2021/09/01/14/20/saxophone-6591475_1280.jpg" alt="Instrumentos de viento" />
        <p>
          La imagen muestra un saxofón que es actualmente el instrumento de viento más aprendido junto con la Flauta de pan.
        </p>
      </section>
    </div>
  );
}
