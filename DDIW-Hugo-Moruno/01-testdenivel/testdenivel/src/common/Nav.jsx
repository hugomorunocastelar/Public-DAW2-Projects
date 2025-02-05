import React from 'react'
import './styles/Nav.css';

export default function Nav({ toggleAside }) {
  return (
    <div id='navegacion'>
        <nav className='container pt-3'>
          <div className="nav-header">
            <button className="toggle-btn" onClick={toggleAside}>
              &#9776; Menú
            </button>
            <a href="/" ><h1 className='fs-3'>Instrumentos de Hugo Moruno Parra</h1></a>
          </div>
        </nav>
    </div>
  )
}
