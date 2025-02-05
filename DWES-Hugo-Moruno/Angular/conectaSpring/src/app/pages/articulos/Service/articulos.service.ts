import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';
import { Articulo } from '../Interface/articulo.interface';

@Injectable({
  providedIn: 'root'
})
export class ArticulosService {

  private URL_ARTICULOS = `${environment.urlbase}/articulos`;
  
  constructor(
    private httpClient: HttpClient
  ) { }

  getAll(): Observable<Articulo []> {
      return this.httpClient.get<Articulo []>(`${this.URL_ARTICULOS}/all`);
  }

}
