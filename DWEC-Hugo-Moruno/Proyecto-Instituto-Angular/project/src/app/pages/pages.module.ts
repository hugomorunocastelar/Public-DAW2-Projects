import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HomeComponent } from './home/home.component';
import { PagesRoutingModule } from './pages-routing.module';
import { ComponentsModule } from "../components/components.module";
import { StartComponent } from './views/start/start.component';
import { ReactiveFormsModule } from '@angular/forms';
import { ClassesComponent } from './views/classes/classes.component';
import { ProfileComponent } from './views/profile/profile.component';
import { AdminModule } from "./views/admin/admin.module";

@NgModule({
  declarations: [
    HomeComponent,
    StartComponent,
    ClassesComponent,
    ProfileComponent
  ],
  imports: [
    CommonModule,
    ReactiveFormsModule,
    PagesRoutingModule,
    ComponentsModule,
    AdminModule
]
})
export class PagesModule { }
