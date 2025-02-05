import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { MenuComponent } from './menu/menu.component';
import { ReactiveFormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';
import { PagerComponent } from './pager/pager.component';
import { CanvasJSChart } from 'src/lib/canvasjs.angular.component';
import { ClassesGraphComponent } from './classesGraph/classes-graph.component';

@NgModule({
  declarations: [
    MenuComponent,
    CanvasJSChart,
    ClassesGraphComponent,
    PagerComponent
  ],
  imports: [
    CommonModule,
    ReactiveFormsModule,
    RouterModule
  ],
  exports: [
    MenuComponent,
    PagerComponent,
    ClassesGraphComponent
  ]
})
export class ComponentsModule { }
