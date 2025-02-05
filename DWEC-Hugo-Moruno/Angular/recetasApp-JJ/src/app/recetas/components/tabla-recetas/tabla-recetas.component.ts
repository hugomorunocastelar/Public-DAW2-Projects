import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { Receta } from '../../interfaces/recetas.interface';

@Component({
  selector: 'app-tabla-recetas',
  templateUrl: './tabla-recetas.component.html'
})
export class TablaRecetasComponent implements OnInit {

  /** Recetas cargadas */
  @Input() recetas: Receta[] = [];

  /** Evento cuando se elimina una receta */
  @Output() onBorrar : EventEmitter<Receta> = new EventEmitter();

  constructor() { }

  ngOnInit(): void {
  }

}
