import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AutenticacionService } from '../../services/autenticacion.service';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ValidatorService } from '../../services/validator.service';

const OBJ_FORM = '#formDiv';
const OBJ_FORMDIV = '#loginForm';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit
{

  formulario = this.fb.group(
  {
    mail: ['',  [ Validators.required, 
                 Validators.email
                ], 
                [
                  this.validatorService.validateEmailAsync.bind(this.validatorService)
                ]],
    pass: ['',  [ Validators.required, 
                  Validators.minLength(6)
                ]],
    name: ['',  [ Validators.required, 
                  Validators.pattern('^[a-zA-Z ]*$'), 
                  this.validatorService.validateFirstUppercase,
                  this.validatorService.validateMoreThan3Characters
                ], 
                [ this.validatorService.validateNameUniqueAsync.bind(this.validatorService)
                ]],
    age: ['',   [ Validators.required, 
                  Validators.min(18), 
                  Validators.max(99)
                ]]
  });

  


  credenciales = {
    mail: '',
    pass: ''
  }

  registro = {
    mail: '',
    pass: '',
    name: '',
    age: 0
  }

  errorInicioSesion: boolean = false;

  constructor(
    private fb: FormBuilder,
    private router: Router,
    private autenticationService: AutenticacionService,
    private validatorService: ValidatorService
  ) { }

  ngOnInit(): void
  {
    this.animatedShowLogin();
  }


  login()
  {
    this.autenticationService.iniciarSesion(this.credenciales.mail, this.credenciales.pass)
      .subscribe({
        next: (Autenticado: boolean) =>
        {
          this.moveFormToConfirmation(() => {
            $('#loginForm').animate({
              width: '0px',
              height: '0px'
            }, 1000)
            setTimeout(() => {
              this.autenticationService.saveSession();
              this.router.navigate(['/home']);
            }, 1000)
          })
        },
        complete: () => { },
        error: () =>
        {
          this.moveFormToEmail();
          this.failedLogin();
        }
      });
  }

  validateRegister() {
    if (this.formulario.invalid) {
      Object.keys(this.formulario.controls).forEach(key => {
        const control = this.formulario.get(key);
        if (control?.invalid) {
          console.log(`${key} is invalid`);
        }
      });
      this.showGeneralErrorMessage("Please fill out the form correctly.");
    } else {
      this.register();
    }
  }

  showGeneralErrorMessage(message: string) {
    const errorDiv = document.createElement('div');
    errorDiv.classList.add('error-message');
    errorDiv.textContent = message;
    document.querySelector(OBJ_FORMDIV)?.appendChild(errorDiv);
  }

  register()
  {
    this.autenticationService.register(this.registro.mail, this.registro.pass, this.registro.name, this.registro.age)
      .subscribe({
        next: (Autenticado: boolean) =>
        {
          $('#loginForm').animate({
            width: '0px',
            height: '0px'
          }, 1000)
          setTimeout(() => {
            console.log('webo');
            this.router.navigate(['/home']);
          }, 1000)
        },
        complete: () => { },
        error: () =>
        {
          this.moveFormToEmail();
          this.failedLogin();
        }
      });
  }

  animatedShowLogin()
  {
    $('#loginForm').animate({
      width: '400px',
      height: '400px'
    }, 1000)
  }

  moveFormToRegister()
  {
    $(OBJ_FORM).animate({
      rotate: '0deg',
      top: '-400px'
    }, 1000)
  }

  moveBackToLogin()
  {
    $(OBJ_FORM).animate({
      rotate: '0deg',
      top: '0px'
    }, 1000)
  }

  moveFormToPassword()
  {
    $(OBJ_FORM).animate({
      rotate: '-90deg'
    }, 1000)
  }

  moveFormToEmail()
  {
    $(OBJ_FORM).animate({
      rotate: '0deg'
    }, 1000)
  }

  moveFormToValidate()
  {
    $(OBJ_FORM).animate({
      rotate: '-180deg'
    }, 1000)
    this.login();
  }

  moveFormToConfirmation(functionToPass: any)
  {
    $(OBJ_FORM).animate({
      rotate: '-270deg'
    }, 1000, () => {
      functionToPass();
    })
  }

  moveFormForRegistering(functionToPass: any)
  {
    $(OBJ_FORM).animate({
      rotate: '-270deg'
    }, 1000, () => {
      functionToPass();
    })
  }

  failedLogin()
  {
    console.log($(OBJ_FORMDIV));
    $(OBJ_FORM).addClass('failedAndPulse');
    
    setTimeout(() => {
      $(OBJ_FORM).removeClass('failedAndPulse');
    }, 6000);
  }

}
