import React from 'react';
import './styles/Cuerda.css';

export default function Cuerda() {
  return (
    <div>
      <section className="container" style={{ textAlign: 'center', padding: '50px' }}>
        <h1>Instrumentos de Cuerda</h1>
        <hr />
        <p>
          Los instrumentos de cuerda, o cordófonos, son aquellos que producen sonido mediante la vibración de una o más cuerdas. Ejemplos populares son la guitarra, el violín y el arpa.
        </p>
        <p>
          Estos instrumentos son muy versátiles y pueden encontrarse en casi todos los géneros musicales, desde la música clásica hasta el rock y el folk.
        </p>
        <img src="https://cdn.pixabay.com/photo/2017/05/01/18/18/guitar-2276181_1280.jpg" alt="Instrumentos de cuerda" />
        <p>
          La imagen muestra una guitarra acústica, uno de los instrumentos de cuerda más populares en todo el mundo.
        </p>
      </section>
    </div>
  );
}
