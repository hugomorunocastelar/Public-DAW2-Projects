import { Component, OnInit } from '@angular/core';
import { session } from 'src/environments/userdata';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html'
})
export class ProfileComponent implements OnInit {

  actualSession: any = session; // Store the current session data

  constructor() { }

  ngOnInit(): void {
    this.loadRelativeData(this.actualSession.rol); // Call function to load data based on the role
  }

  /**
   * Load the relevant data based on the user's role
   * @param rol - The role of the user (admin, prof, alum, unassigned)
   */
  loadRelativeData(rol: string) {
    switch (rol) {
      case 'admin':
        this.loadAdmin(); // Load admin-specific data
        break;
      case 'prof':
        this.loadProfessor(); // Load professor-specific data
        break;
      case 'alum':
        this.loadAlum(); // Load alum-specific data
        break;
      case 'unassigned':
        this.loadUnassigned(); // Load unassigned user message
        break;
    }
  }

  /**
   * Load alum-specific data and display alum-related information
   */
  loadAlum() {
    $('#profName').text('Classes of ' + this.actualSession.name); // Display the user's name as 'Classes of'
  }
  
  /**
   * Load professor-specific data and display professor-related information
   */
  loadProfessor() {
    $('#profName').text('Classes of ' + this.actualSession.name); // Display the user's name as 'Classes of'
  }
  
  /**
   * Load admin-specific data and display admin-related information
   */
  loadAdmin() {
    $('#profName').text('Users'); // Display 'Users' for admin
  }
  
  /**
   * Display a message for unassigned users, instructing them to wait for role assignment
   */
  loadUnassigned() {
    $('#profName').text('Without role');
    $('#classesDiv')
      .append(
        $('<div>')
          .append(
            $('<h3>')
              .text('Unassigned profile, wait for the admin to assign your user to one role.')
          )
      )
  }

}
