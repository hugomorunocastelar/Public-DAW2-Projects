import React from 'react';
import './styles/Home.css'

export default function Home() {
  return (
    <div>
      <section className="container" style={{ textAlign: 'center', padding: '50px' }}>
        <h1>¡Bienvenido a la Guía de Instrumentos Musicales!</h1>
        <p>
          En este sitio aprenderás sobre los cinco tipos principales de instrumentos musicales. 
          Ya seas un principiante o un experto, aquí encontrarás información útil sobre cada uno de ellos.
        </p>
        <p>
          Descubre las características de los diferentes instrumentos y cómo han dado forma a la música a lo largo del tiempo.
        </p>
      </section>

      <section id="types" className="container">
        <h2>Los 5 Tipos de Instrumentos Musicales</h2>
        <ul>
          <li><strong>Aerófonos:</strong> Instrumentos que generan sonido mediante el aire, como las flautas, clarinetes o trompetas.</li>
          <li><strong>Cordófonos:</strong> Instrumentos que producen sonido a través de la vibración de cuerdas, como la guitarra, el violín o el piano.</li>
          <li><strong>Membranófonos:</strong> Instrumentos de percusión que utilizan una membrana estirada para producir sonido, como el tambor o la batería.</li>
          <li><strong>Idiófonos:</strong> Instrumentos que producen sonido por la vibración de su propio cuerpo, como los xilófonos, triángulos o campanas.</li>
          <li><strong>Electrófonos:</strong> Instrumentos que generan sonido de manera electrónica, como los sintetizadores o las guitarras eléctricas.</li>
        </ul>
        <p>
          Cada uno de estos tipos tiene su propio encanto y un papel único en la creación de música. ¡Sigue explorando para aprender más sobre cada tipo de instrumento!
        </p>
      </section>
    </div>
  );
}
