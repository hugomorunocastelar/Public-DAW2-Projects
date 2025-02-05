import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AutenticacionGuard } from './auth/guards/autenticacion.guard';

const routes: Routes = [

  {    
    path: 'auth',
    loadChildren: () => import('./auth/auth.module').then(m => m.AuthModule),    
  },

  {
    path: 'dashboard',
    loadChildren: () => import('./dashboard/dashboard.module').then(m => m.DashboardModule),   
    canLoad:[AutenticacionGuard],
    canActivate:[AutenticacionGuard] 
  },

  {
    path: 'recetas',
    loadChildren: () => import('./recetas/recetas.module').then(m => m.RecetasModule),
    canLoad:[AutenticacionGuard],
    canActivate:[AutenticacionGuard]
  },

  {
    path: '**',
    redirectTo: 'dashboard' 
  }

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
