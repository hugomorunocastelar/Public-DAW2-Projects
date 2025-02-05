import { Component, Input, OnInit } from '@angular/core';
import { Receta } from '../../interfaces/receta.interface';
import { switchMap, tap } from 'rxjs';
import { RecetasService } from '../../services/recetas.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-ver',
  templateUrl: './ver.component.html'
})
export class VerComponent implements OnInit {
  
  receta!: Receta;

  constructor(
    private recetasService: RecetasService,
    private activatedRoute: ActivatedRoute
  ) { }

  ngOnInit(): void {
    this.cargarReceta();
  }

  cargarReceta() {
    
    this.activatedRoute.params
    // Si estamos en modo edición, obtiene los parámeros
    // y carga los datos
      .pipe(
          switchMap(({id}) => this.recetasService.getById(id)),
          tap(console.log)
      )
      // Finalmente, este subscribe recibe el resultado, que será el objeto
      .subscribe((receta: Receta) => {
          this.receta = receta;
      });
    }


}
