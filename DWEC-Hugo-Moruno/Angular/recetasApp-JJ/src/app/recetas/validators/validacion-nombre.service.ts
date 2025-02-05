import { Injectable } from '@angular/core';
import { AbstractControl, AsyncValidator, ValidationErrors } from '@angular/forms';
import { delay, map, Observable, tap } from 'rxjs';
import { ValidacionService } from 'src/app/shared/services/validacion.service';
import { RecetasService } from '../services/recetas.service';

@Injectable({
  providedIn: 'root'
})
export class ValidacionNombreService  implements AsyncValidator {

  constructor(
    private validacionService   : ValidacionService,
    private recetasService      : RecetasService
  ) {
    
    // Registra menajes de error en el servicio de validaciones
    validacionService.registrarMensajeError("nombreDuplicado", "Existe una receta con ese nombre");
  }

  validate(control: AbstractControl): Promise<ValidationErrors | null> | Observable<ValidationErrors | null> {
     
    // Obtengo el titulo como argumento
    const nombre = control.value;

    // Tendré que usar un pipe que evalue y me retorne el objeto que necesito para generar validation errors
    // Utilizo el operador map para cambiar el objeto que recibo por el objeto con el error
    return this.recetasService.getPorNombre(nombre)
       .pipe(
         
         // Esta pausa me permite comprobar como cambia el estado del formulario de INVALID a PENDING a VALID
         //delay(5000),
         tap(console.log),
         map( recetas => {
          
           if(recetas.length > 0) {
             return { nombreDuplicado: true }
           } else {
             return null;
           }            
         })  
       );
  }

  registerOnValidatorChange?(fn: () => void): void {
    throw new Error('Method not implemented.');
  }
}
