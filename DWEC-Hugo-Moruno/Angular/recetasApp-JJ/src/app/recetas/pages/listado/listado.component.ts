import { Component, OnInit } from '@angular/core';
import { Receta } from '../../interfaces/recetas.interface';
import { RecetasService } from '../../services/recetas.service';
import { tap } from 'rxjs/operators';
import { DialogService } from 'src/app/shared/services/dialog.service';
import { environment } from 'src/environments/environment';

@Component({
  selector: 'app-listado',
  templateUrl: './listado.component.html'
})
export class ListadoComponent implements OnInit {

  /** Recetas cargadas */
  recetas: Receta[] = [];

  /** Página actual */
  paginaActual = environment.paginaInicial;

  constructor(
      // Necesitamos este objeto para hacer peticiones. 
      private recetasService: RecetasService,
      private dialogService: DialogService
  ) { }


  ngOnInit(): void {
    this.cargarRecetas();
  }


  private cargarRecetas() {
    
    // Cuando la pantalla se muestra se tienen que mostrar las tareas.
    this.recetasService.get(this.paginaActual)
     
      .pipe(

        // Este tap lo hago solo para mostrar los datos que pasan por aquí
        tap(console.log)
      )      
      .subscribe( recetas => {                 
          this.recetas = recetas;    
      });
  }

  /**
   * Bara borrar receta se pasa el índice dentro de la tabla de recetas.
   * Más que nada porque luego se evita tener que recorrer la tabla para hacer la eliminación
   * 
   * @param indice 
   */
  borrarReceta(receta: Receta): void {

    // Solicita confirmación para eliminar la receta
    this.dialogService.solicitarConfirmacion(
      "¿Está seguro de que desea eliminar el registro?", 
      "Atención", 
      () => {
      
        // Registra información acerca de la receta
        console.debug("borrarReceta");
        console.debug(receta);

        // Borra la receta
        this.recetasService.del(receta).subscribe(() => {
          console.log("Eliminada");

          // Fuerza que la kusta de recetas se refesque
          this.cargarRecetas();
        });
      }
    );
  }  

  //------------------------------------------------------------------------
  // Gestores de eventos
  //------------------------------------------------------------------------
  cambiarPagina(pagina: number) {
    
    // Carga la página actual
    this.paginaActual = pagina;
    this.cargarRecetas();
  }

}
