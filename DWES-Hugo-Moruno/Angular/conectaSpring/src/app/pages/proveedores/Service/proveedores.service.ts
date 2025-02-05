import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';
import { Proveedor } from '../Interface/proveedor.interface';

@Injectable({
  providedIn: 'root'
})
export class ProveedoresService {

  private URL_PROVEEDORES = `${environment.urlbase}/proveedores`;
  
  constructor(
    private httpClient: HttpClient
  ) { }

  getAll(): Observable<Proveedor []> {
    return this.httpClient.get<Proveedor []>(`${this.URL_PROVEEDORES}/all`);
  }

  borrar(proveedor: Proveedor)
  {
    return this.httpClient.delete(`${this.URL_PROVEEDORES}/delete`, { body: proveedor });
  }

}
