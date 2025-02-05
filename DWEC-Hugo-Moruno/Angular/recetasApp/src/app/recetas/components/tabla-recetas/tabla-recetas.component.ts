import { Component, OnInit } from "@angular/core";
import { Receta } from "../../interfaces/receta.interface";
import { RecetasService } from "../../services/recetas.service";
import { DialogService } from "src/app/shared/services/dialog.service";
import { tap } from "rxjs";

@Component({
  selector: 'app-tabla-recetas',
  templateUrl: './tabla-recetas.component.html'
})
export class TablaRecetasComponent implements OnInit {

  recetas: Receta[] = [];

  paginaActual = 1;

  constructor(
    private recetasService: RecetasService,
    private dialogService: DialogService,
  ) { }

  ngOnInit(): void {
    this.getRecetas(this.paginaActual);
  }

  private getRecetas(pagina: number)
  {
    this.recetasService.get(pagina)
      .pipe(
        tap(console.log)
      )
      
      .subscribe( receta => {
          this.recetas = receta;    
      });
  }

  borrarReceta(receta: Receta): void
  {
    this.dialogService.solicitarConfirmacion('Seguro que quiere borrar?', 'Atención!', () => {

      this.recetasService.borrar(receta).subscribe(() => {
        console.log('Eliminada receta');
        this.getRecetas(this.paginaActual);
      });

    });
  }

  cambiarPagina(pagina: number)
  {
    this.paginaActual = pagina;
    this.getRecetas(this.paginaActual);
  }

}
