import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Receta } from '../interfaces/receta.interface';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class RecetasService {

  private URL_RECETAS = `${environment.recetasAppBaseUrl}/recetas`;

  constructor(
    private httpClient: HttpClient
  ) { }

  crear(receta: Receta): Observable<Receta>
  {
    const url = `${this.URL_RECETAS}`;
    delete receta.id;
    return this.httpClient.post<Receta>(url, receta);
  }

  get(pagina: number = 0): Observable<Receta []> {
    if (pagina > 0)
    {
      return this.httpClient.get<Receta []>(this.URL_RECETAS+'?_page='+pagina+'&_limit='+environment.infolimittable);
    }
    else
    {
      return this.httpClient.get<Receta []>(this.URL_RECETAS);
    }
  }

  update(receta: Receta): Observable<Receta>
  {
    const url = `${this.URL_RECETAS}/${receta.id}`;

    return this.httpClient.put<Receta>(url, receta);
  }

  borrar(receta: Receta)
  {
    console.log(receta.id);
    console.log(`${this.URL_RECETAS}/4`);
    return this.httpClient.delete(`${this.URL_RECETAS}/${receta.id}`);
  }

  getById(id: Number)
  {
    return this.httpClient.get(`${this.URL_RECETAS}/${id}`);
  }

  getByNombre(nombre: String)
  {
    return this.httpClient.get<Receta>(`${this.URL_RECETAS}/?nombre=${nombre}`);
  }



}
