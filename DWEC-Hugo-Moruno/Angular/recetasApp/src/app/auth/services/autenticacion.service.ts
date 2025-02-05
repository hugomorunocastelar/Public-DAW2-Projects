import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map, Observable, of } from 'rxjs';
import { environment } from 'src/environments/environment';
import { LoginRequest, LoginResponse } from '../interfaces/autentication';

@Injectable({
  providedIn: 'root'
})
export class AutenticacionService {

  private URL_LOGIN = `${environment.recetasAppBaseUrl}`+'/login';

  private jwtToken : string | null = null

  constructor(
    private httpClient: HttpClient
  ) { }

  iniciarSesion(login: string, password: string) : Observable<boolean>
  {
    const credenciales: LoginRequest = {
      email: login,
      password: password
    }

    return this.httpClient.post<LoginResponse>(this.URL_LOGIN, credenciales)
    .pipe(
      map((response) => {
        this.jwtToken = response.accessToken;
        return true;
      })
    )

  }

  isSesionIniciada(): Observable<boolean> { 
    return of(this.jwtToken != null);
  }

  token(): string | null{
    return this.jwtToken;
  }

}
