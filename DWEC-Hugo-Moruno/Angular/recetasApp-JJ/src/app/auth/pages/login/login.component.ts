import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AutenticacionService } from '../../services/autenticacion.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html'
})
export class LoginComponent implements OnInit {

  // Credenciales en la página
  credenciales = {

    login: '',
    pass: ''

  };

  errorInicioSesion: boolean = false;

  constructor(
    private router: Router,
    private autenticacionService: AutenticacionService
  ) { }

  ngOnInit(): void {
  }

  /** 
   * Inicia sesión en la aplicación
   */
  login() {
    this.autenticacionService.iniciarSesion(this.credenciales.login, this.credenciales.pass)
    
    // TODO Pasar objeto con next y error como atributos de modo que se pueda procesar el 
    // resultado ok y el fallo.
    .subscribe({

      // Reciebe el siguiente valor
      next: (autenticado: boolean) =>  {

        // Si todo está ok, redirige al dashboard
        this.router.navigate([ '/dashboard' ]);
      },

      // El observer ha recibido una notificación completa
      complete: () => {     
      },

      // El observer ha recibido un error
      error: (error: any) => {

        // Si no puede iniciar sesión, marca que hay error de inicio de sesión
        this.errorInicioSesion = true;
      }        
    });
  }


}
