import { Component, OnInit } from '@angular/core';
import { Receta } from '../../interfaces/receta.interface';
import { RecetasService } from '../../services/recetas.service';
import { tap } from 'rxjs';
import { DialogService } from 'src/app/shared/services/dialog.service';

@Component({
  selector: 'app-listado',
  templateUrl: './listado.component.html',
  styles:[
    '#box{ border: 1px solid black; margin: 25px; padding: 5px 30px }',
    'div > p{ margin: 0}'
  ]
})
export class ListadoComponent implements OnInit {

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
