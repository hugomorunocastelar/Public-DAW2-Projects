import React from 'react';
import './styles/Electrofonos.css';

export default function Electrofonos() {
  return (
    <div>
      <section className="container" style={{ textAlign: 'center', padding: '50px' }}>
        <h1>Instrumentos Electrónicos</h1>
        <hr />
        <p>
          Los instrumentos electrónicos, o electrófonos, producen sonido mediante circuitos eléctricos. Ejemplos incluyen el sintetizador, la guitarra eléctrica y el teclado.
        </p>
        <p>
          Son la base de muchos géneros modernos como la música electrónica, el rock y el pop.
        </p>
        <img src="https://cdn.pixabay.com/photo/2016/08/05/21/52/dj-1573332_1280.jpg" alt="Instrumentos electrónicos" />
        <p>
          La imagen muestra un sintetizador, un instrumento clave en la música electrónica.
        </p>
      </section>
    </div>
  );
}
