import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { DialogService } from 'src/app/shared/services/dialog.service';
import { RecetasService } from '../../services/recetas.service';
import { switchMap, tap } from 'rxjs';
import { Receta } from '../../interfaces/receta.interface';
import { ValidatorService } from 'src/app/shared/services/validator.service';
import { ValidacionNombreService } from '../../validators/validacion-nombre.service';

@Component({
  selector: 'app-editar',
  templateUrl: './editar.component.html'
})
export class EditarComponent implements OnInit {
 // Defino el formulario
  // En esta definición incluyo
  // - Nombres de los campos. Deben coincidir con los del objeto
  // - Opciones de los campos
  // - Validaciones locales
  // - Validaciones asíncronas
  formulario: FormGroup = this.fb.group({
    id                : [-1],

    nombre            : [ '', 
                          [ Validators.required,
                            this.validatorService.validarMasDe3Letras
                           ],
                          [ 
                            this.validacionNombreService.validate
                          ]
                        ],
    descripcion       : ['', [ Validators.required] ],

}, {  
  // 008 Este segundo argumento que puedo enviar al formgroup permite por ejemplo ejecutar
  // validadores sincronos y asíncronos. Son validaciones al formgroup
  validators: [  ]
});

// Indica si la tarea se está actualizando
actualizando: boolean = false;

receta!: Receta;

//-------------------------------------------------------------------------------------
// Inicialización
//-------------------------------------------------------------------------------------

constructor(

  private activatedRoute    : ActivatedRoute,
  private fb                : FormBuilder,
  private router            : Router,

  private dialogService     : DialogService,
  private validatorService  : ValidatorService,
  private validacionNombreService: ValidacionNombreService,
  private recetasService    : RecetasService,

) { }

/**
 * Inicialización de la página
 */
  ngOnInit(): void {

    // Si no estamos en modo edición, sale de aquí
    if(this.router.url.includes('editar')) {    
      this.cargarReceta();
      this.actualizando = true;
    }

  }

  cargarReceta()
  {
  this.activatedRoute.params
    // Si estamos en modo edición, obtiene los parámeros
    // y carga los datos
      .pipe(
          switchMap(({id}) => this.recetasService.getById(id)),
          tap(console.log)
      )
      // Finalmente, este subscribe recibe el resultado, que será el objeto
      .subscribe((receta: Receta) => {
          this.formulario.reset(receta);
      });
    }
    
  actualizarReceta()
  {
    this.recetasService.update(this.formulario.getRawValue())
    .subscribe({
      next:(receta: Receta) => {},

      complete: () => {
        this.dialogService.mostrarToast("Receta guardada");
      },

      error: (error) => {
        this.dialogService.mostrarMensaje("No ha sido posible guardar la receta.");
        console.log(error);
      }
    })
  }  

  guardar()
  {
    if(this.formulario.invalid)
    {
      this.formulario.markAllAsTouched();

      this.dialogService.mostrarMensaje('Por favor revise los datos');

      return;
    }

    if(this.formulario.get('id')?.value > 0)
    {
      this.actualizarReceta();
    }
    else
    {
      this.crearReceta();
    }

  }
    
  crearReceta()
  {
    this.recetasService.crear(this.formulario.getRawValue())
    .subscribe({
      
      next:(receta: Receta) => {
        this.router.navigate(['/recetas/editar', receta.id]);

        this.dialogService.mostrarToast("Receta creada");
      },
      error: (error) => {
        this.dialogService.mostrarMensaje("No ha sido posible crear la receta.");
        console.log(error);
      }
    })
  }

}
