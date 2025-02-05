import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';

@Component({
  selector: 'app-paginador',
  templateUrl: './paginador.component.html'
})
export class PaginadorComponent implements OnInit {

  /**
   * Pagina actual. Por defecto vale 0.
   */
  @Input() paginaActual: number = 0;

  /**
   * Evento cuando se cambia de página
   */
  @Output() onPaginaCambiada : EventEmitter<number> = new EventEmitter();

  constructor() { }

  ngOnInit(): void {
  }

  //-----------------------------------------------------------------
  // Gestión de eventos
  //-----------------------------------------------------------------

  /**
   * Invocado cuando se solicita pasar a la página anterior
   */
  paginaAnterior() {

    // Si la página es mayor que cero la decrementa
    if(this.paginaActual > 0) {
      
      // Decrementa
      this.paginaActual--;

      // Notifica el cambio
      this.onPaginaCambiada.emit(this.paginaActual);
    }    
  }

  /**
   * Invocado cuando se solicita pasar a la página siguiente
   */
  paginaSiguiente() {

    //Incrementa la página actual
    this.paginaActual++;

    // Emite el cambio
    this.onPaginaCambiada.emit(this.paginaActual);
  }

}
