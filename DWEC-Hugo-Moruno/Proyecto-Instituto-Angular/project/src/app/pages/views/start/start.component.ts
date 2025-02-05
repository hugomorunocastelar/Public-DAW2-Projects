import { Component, OnInit } from '@angular/core';
import { schoolInfo } from './interface/schoolInfo.interface';
import { StartService } from './services/start.service';
import { tap } from 'rxjs';

const OBJ_SCHOOLNAME = '#schoolName';
const OBJ_SCHOOLADDRESS = '#schoolAddress';

@Component({
  selector: 'app-start',
  templateUrl: './start.component.html',
  styleUrls: ['./start.component.css']
})
export class StartComponent implements OnInit {

  schoolData: schoolInfo | undefined = undefined; // Holds school data that will be fetched from the service

  constructor(
    private startService: StartService
  ) { }

  ngOnInit(): void {
    this.setSchoolInfo();
  }

  /**
   * Fetches school data using the StartService and updates the page with the retrieved information.
   * It uses the `tap` operator to log the data and subscribe to the observable for setting the school data.
   */
  setSchoolInfo() {
    this.startService.getSchoolData() // Calls the service to get the school data
      .pipe(
        tap(console.log) // Logs the data to the console for debugging purposes
      )
      .subscribe(data => {
        // Sets the schoolData once the data is received
        this.schoolData = data;
      });

    // Checks if schoolData is available and updates the page content with the school name and address
    if (this.schoolData != undefined) {
      $(OBJ_SCHOOLNAME).text(this.schoolData.name); // Updates the school name on the page
      $(OBJ_SCHOOLADDRESS).text(this.schoolData.address); // Updates the school address on the page
    }
  }
}

