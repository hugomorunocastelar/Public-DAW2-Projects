import { Component, OnInit } from '@angular/core';
import { ClassService } from 'src/app/pages/views/admin/classes/service/class.service';

@Component({
  selector: 'classes-graph',
  templateUrl: 'classes-graph.component.html'
})
export class ClassesGraphComponent implements OnInit
{
  dataPoints: any[] = []; // Stores the data for the chart
  chart: any; // Holds the chart instance
  chartOptions: any = {}; // Configuration for the chart

  constructor(private classService: ClassService) { }

  ngOnInit(): void { }

  ngAfterViewInit(): void
  {
    // Fetch all classes and create data points for the chart
    this.classService.getAllClasses().subscribe(classes =>
    {
      for (let classobj of classes)
      {
        const point = { name: classobj.name, y: Number(classobj.alums.length) };
        this.dataPoints.push(point);
      }

      // Set up chart options and display the data
      this.chartOptions = {
        animationEnabled: true,
        title: { text: "Alums per class" },
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
