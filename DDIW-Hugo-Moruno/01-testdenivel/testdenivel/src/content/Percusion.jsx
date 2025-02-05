import React from 'react';
import './styles/Percusion.css';

export default function Percusion() {
  return (
    <div>
      <section className="container" style={{ textAlign: 'center', padding: '50px' }}>
        <h1>Instrumentos de Percusión (Membrana)</h1>
        <hr />
        <p>
          Los instrumentos de membrana, o membranófonos, producen sonido mediante la vibración de una membrana estirada. Ejemplos incluyen los tambores, bongos y la batería.
        </p>
        <p>
          Estos instrumentos son fundamentales en géneros musicales que dependen del ritmo, como la música africana, el rock y el pop.
        </p>
        <img src="https://cdn.pixabay.com/photo/2014/01/17/09/57/drums-246840_1280.jpg" alt="Instrumentos de membrana" />
        <p>
          La imagen muestra un tambor tradicional, uno de los instrumentos de membrana más antiguos y utilizados en todo el mundo.
        </p>
      </section>
    </div>
  );
}
