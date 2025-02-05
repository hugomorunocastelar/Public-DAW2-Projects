import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { AdminComponent } from './views/admin/admin.component';
import { StartComponent } from './views/start/start.component';
import { ClassesComponent } from './views/classes/classes.component';
import { ProfileComponent } from './views/profile/profile.component';
import { AutenticacionGuard } from '../auth/guards/autenticacion.guard';

const routes: Routes = [{

  path: '',
  component: HomeComponent,  
  children: [
      {
        path: 'admin',
        loadChildren: () => import('./views/admin/admin.module').then(m => m.AdminModule),   
        canLoad:[AutenticacionGuard],
        canActivate:[AutenticacionGuard] 
      },
      {
        path: 'start',
        component: StartComponent,   
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
        path: 'profile',
        component: ProfileComponent,   
        canLoad:[AutenticacionGuard],
        canActivate:[AutenticacionGuard] 
      },
      {
        path: '**',
        redirectTo: 'start'
      },
    ]
}];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class PagesRoutingModule { }
