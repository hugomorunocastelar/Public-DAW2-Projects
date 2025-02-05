import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { DashboardRoutingModule } from './dashboard-routing.module';
import { CanvasJSChart } from 'src/lib/canvasjs.angular.component';
import { DashboardComponent } from './pages/dashboard/dashboard.component';
import { RecetasGraphComponent } from './components/recetas-graph/recetas-graph.component';


@NgModule({
  declarations: [
    CanvasJSChart,
    DashboardComponent,
    RecetasGraphComponent
  ],
  imports: [
    CommonModule,
    DashboardRoutingModule
  ]
})
export class DashboardModule { }
