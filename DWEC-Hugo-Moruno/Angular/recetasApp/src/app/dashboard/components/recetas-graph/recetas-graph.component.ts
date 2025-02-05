import { Component, OnInit } from '@angular/core';
import { RecetasService } from 'src/app/recetas/services/recetas.service';

@Component({
  selector: 'app-recetas-graph',
  templateUrl: './recetas-graph.component.html'
})
export class RecetasGraphComponent implements OnInit {
  dataPoints: any[] = [];

  chart: any;

  chartOptions: any = {};

  constructor(

    private recetasService: RecetasService

  ) { }

  ngOnInit(): void {

  }

  ngAfterViewInit(): void {

    // Carga los datos del gráfico
    this.recetasService.get().subscribe(recetas => {

      // Obtiene la respuesta
      for (let receta of recetas)
      {

        const punto = {
          name: receta.nombre,
          y: Number(receta.puntuacion)
        }

        this.dataPoints.push(punto);  
      }

      console.log(this.dataPoints);

      this.chartOptions = {
        animationEnabled: true,
        title: {
          text: "Recetas por puntuación"
        },
        data: [{
          type: "pie",
          showInLegend: true,
          indexLabelPlacement: "outside",
          dataPoints: this.dataPoints
        }]
      };
    });
  }
}
