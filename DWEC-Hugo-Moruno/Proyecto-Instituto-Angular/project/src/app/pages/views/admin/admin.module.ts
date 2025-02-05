import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RolesComponent } from './roles/roles.component';
import { ClassesComponent } from './classes/classes.component';
import { UsersComponent } from './users/users.component';
import { AdminRoutingModule } from './admin-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';
import { AdminComponent } from './admin.component';
import { MenuAdminComponent } from './menuAdmin/menuAdmin.component';
import { ComponentsModule } from "../../../components/components.module";



@NgModule({
  declarations: [
    AdminComponent,
    RolesComponent,
    ClassesComponent,
    UsersComponent,
    MenuAdminComponent
  ],
  imports: [
    CommonModule,
    ReactiveFormsModule,
    AdminRoutingModule,
    RouterModule,
    ComponentsModule
  ],
  exports: [
    UsersComponent
  ]
})
export class AdminModule { }