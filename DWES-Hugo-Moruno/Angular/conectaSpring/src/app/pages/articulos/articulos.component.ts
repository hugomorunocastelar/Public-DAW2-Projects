import { Component, OnInit } from '@angular/core';
import { ArticulosService } from './Service/articulos.service';
import { tap } from 'rxjs';
import { Articulo } from './Interface/articulo.interface';

@Component({
  selector: 'app-articuloes',
  templateUrl: './articulos.component.html',
  styleUrls: ['./articulos.component.css']
})
export class ArticulosComponent implements OnInit {

  articulos: Articulo[] = [];

  constructor(
    private articulosService: ArticulosService
  ) { }

  ngOnInit(): void {

    this.getArticulos();

  }

  getArticulos()
  {
    this.articulosService.getAll()
      .pipe(
        tap(console.log)
      )
      .subscribe( articulo => {
          this.articulos = articulo;
        }
      )
  }


  borrarArticulo(articulo: Articulo)
  {

  }
}
