import React, { useState } from 'react';
import './App.css';
import Aside from './common/Aside';
import Footer from './common/Footer';
import Nav from './common/Nav';
import Home from './content/Home';
import Viento from './content/Viento';
import Cuerda from './content/Cuerda';
import Percusion from './content/Percusion';
import Idiofono from './content/Idiofonos';
import Electro from './content/Electrofonos';
import { Routes, Route } from 'react-router-dom';

function App() {

  const [showAside, setShowAside] = useState(true);

  const toggleAside = () => {
    setShowAside(!showAside);
  };

  return (
    <div className="App">
      <Nav toggleAside={toggleAside}/>
      <div className='cuerpo'>
      {showAside && <Aside />} {/* Mostrar/ocultar Aside */}
        <div className={showAside ? 'main-content container home' : 'main-content full container home'}>
          <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/viento" element={<Viento />} />
            <Route path="/cuerda" element={<Cuerda />} />
            <Route path="/percusion" element={<Percusion />} />
            <Route path="/idiofono" element={<Idiofono />} />
            <Route path="/electro" element={<Electro />} />
          </Routes> 
        </div>
      </div>   
      <Footer />
    </div>
  );
}

export default App;
