import { Component, EventEmitter, OnInit, Output } from '@angular/core';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html'
})
export class MenuComponent {

  @Output() onCerrarSesion : EventEmitter<any> = new EventEmitter();

  cerrarSesion() {
    // Genera evento de cerrar sesión
    this.onCerrarSesion.emit();
  }

}
