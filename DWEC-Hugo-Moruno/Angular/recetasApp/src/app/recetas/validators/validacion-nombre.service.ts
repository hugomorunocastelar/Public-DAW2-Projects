import { Injectable } from '@angular/core';
import { AbstractControl, AsyncValidator, ValidationErrors } from '@angular/forms';
import { map, Observable } from 'rxjs';
import { ValidatorService } from 'src/app/shared/services/validator.service';
import { RecetasService } from '../services/recetas.service';

@Injectable({
  providedIn: 'root'
})
export class ValidacionNombreService implements AsyncValidator {

  constructor(

    private validatorService: ValidatorService,
    private recetasService: RecetasService
  ) { 
    validatorService.registrarMensajeError("nombreDuplicado", "Existe una receta con el nombre.")
  }
  validate(control: AbstractControl): Promise<ValidationErrors | null> | Observable<ValidationErrors | null> {
    // Obtengo el titulo como argumento
    const nombre = control.value;

    // Tendré que usar un pipe que evalue y me retorne el objeto que necesito para generar validation errors
    // Utilizo el operador map para cambiar el objeto que recibo por el objeto con el error
    return this.recetasService.getByNombre(nombre)
      .pipe(

        map( recetas => {
          
          if(recetas.nombre != '' && recetas.nombre == nombre) {
            return { tituloDuplicado: true }
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
