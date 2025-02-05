import { Injectable } from '@angular/core';
import { FormControl, ValidationErrors } from '@angular/forms';

@Injectable({
  providedIn: 'root'
})
export class ValidatorService {
  
  private mensajesError : any = {
    primeraNoEsMayuscula: "El valor debe comenzar por mayúscula",
    required: "Campo requerido"
  }

  constructor() { }

  validarPrimeraMayuscula(control: FormControl): ValidationErrors | null
  {
    var valor = control.value?.trim()[0];

    var mayus = valor.upperCase();

    if(valor != mayus)
    {
      return {
        primeraNoEsMayuscula: true
      }
    }
    return null;
  }

  validarMasDe3Letras(control: FormControl): ValidationErrors | null
  {
    var valor = control.value?.trim();

    if(valor.length <= 3)
    {
      return {
        validarMasDe3Letras: true
      }
    }
    return null;
  }
  
  getMensajeError(error: string): string {
    return this.mensajesError[error];
  } 

  registrarMensajeError(clave: string, valor: string) {
    this.mensajesError[clave] = valor;
  }
}
