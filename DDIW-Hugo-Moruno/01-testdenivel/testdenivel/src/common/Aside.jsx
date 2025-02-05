import React from 'react'
import './styles/Aside.css'

export default function Aside() {
  return (
    <div>
        <aside>
            <div class="list-group pt-2 mx-2">
            <a href="/viento" class="list-group-item">Viento</a>
            <a href="/cuerda" class="list-group-item">Cuerda</a>
            <a href="/percusion" class="list-group-item">Percusión</a>
            <a href="/idiofono" class="list-group-item">Idiófonos</a>
            <a href="/electro" class="list-group-item">Electrófonos</a>
            </div>
        </aside>
    </div>
  )
}
