import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { UsersComponent } from './users/users.component';
import { RolesComponent } from './roles/roles.component';
import { ClassesComponent } from './classes/classes.component';
import { AdminComponent } from './admin.component';
import { AutenticacionGuard } from 'src/app/auth/guards/autenticacion.guard';

const routes: Routes = [{

  path: '',
  component: AdminComponent,  
  children: [
      {
        path: 'users',
        component: UsersComponent,   
        canLoad:[AutenticacionGuard],
        canActivate:[AutenticacionGuard] 
      },
      {
        path: 'roles',
        component: RolesComponent,   
        canLoad:[AutenticacionGuard],
        canActivate:[AutenticacionGuard] 
      },
      {
        path: 'classes',
        component: ClassesComponent,   
        canLoad:[AutenticacionGuard],
        canActivate:[AutenticacionGuard] 
      },
      {
        path: '**',
        redirectTo: 'users'
      },
    ]
}];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AdminRoutingModule { }
