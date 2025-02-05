import React from 'react';
import './styles/Idiofonos.css';

export default function Idiofonos() {
  return (
    <div>
      <section className="container" style={{ textAlign: 'center', padding: '50px' }}>
        <h1>Instrumentos de Percusión (Idiófonos)</h1>
        <hr />
        <p>
          Los idiófonos son instrumentos que producen sonido mediante la vibración de su propio cuerpo. Ejemplos incluyen el xilófono, el triángulo y las maracas.
        </p>
        <p>
          Son esenciales en muchos géneros y culturas, ofreciendo tanto ritmos como melodías únicas.
        </p>
        <img src="https://cdn.pixabay.com/photo/2016/11/23/15/36/close-up-1853572_1280.jpg" alt="Idiófonos" />
        <p>
          La imagen muestra un xilófono, un idiófono utilizado comúnmente en la música educativa y orquestas.
        </p>
      </section>
    </div>
  );
}
