import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AutenticacionGuard } from './auth/guards/autenticacion.guard';

const routes: Routes = [
  {    
    path: 'login',
    loadChildren: () => import('./auth/auth.module').then(m => m.AuthModule),    
  },
  {
    path: 'home',
    loadChildren: () => import('./pages/pages.module').then(m => m.PagesModule),   
    canLoad:[AutenticacionGuard],
    canActivate:[AutenticacionGuard] 
  },
  {
    path: '**',
    redirectTo: 'home' 
  }

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
