import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AutenticacionService } from '../../services/autenticacion.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html'
})
export class LoginComponent implements OnInit {

  credenciales = {
    login: '',
    pass: ''
  }

  errorInicioSesion: boolean = false;

  constructor(
    private router: Router,
    private autenticationService: AutenticacionService
  ) { }

  ngOnInit(): void {
  }

  login() {
    this.autenticationService.iniciarSesion(this.credenciales.login, this.credenciales.pass)
    .subscribe({
      next: (Autenticado: boolean) => {
        this.router.navigate([ '/dashboard' ]);
      },
      complete: () => {},
      error: () => {
        this.errorInicioSesion = true;
      }
    });
  }
}
