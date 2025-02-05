import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { RecetasRoutingModule } from './recetas-routing.module';
import { EditarComponent } from './pages/editar/editar.component';
import { ListadoComponent } from './pages/listado/listado.component';
import { VerComponent } from './pages/ver/ver.component';
import { SharedModule } from '../shared/shared.module';
import { ReactiveFormsModule } from '@angular/forms';
import { TablaRecetasComponent } from './components/tabla-recetas/tabla-recetas.component';


@NgModule({
  declarations: [
    ListadoComponent,
    EditarComponent,
    VerComponent,
    TablaRecetasComponent
  ],
  imports: [
    CommonModule,
    ReactiveFormsModule,
    RecetasRoutingModule,
    SharedModule
  ],
  exports: [
    ListadoComponent,
    EditarComponent,
    VerComponent,
  ]
})
export class RecetasModule { }
