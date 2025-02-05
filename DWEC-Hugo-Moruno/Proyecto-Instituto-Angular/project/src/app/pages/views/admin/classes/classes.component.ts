import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { ClassSchool, ClassWithoutId, idUser } from './interface/class.interface';
import { ClassService } from './service/class.service';
import { User } from '../users/interface/user.interface';
import { UserService } from '../users/service/user.service';
import { DialogService } from 'src/app/components/services/dialog.service';

@Component({
  selector: 'app-classes',
  templateUrl: './classes.component.html'
})
export class ClassesComponent implements OnInit {

  page: number = 1;

  @Input() crudClasses = true; // Input to control whether CRUD operations are enabled for classes

  @Output() classSchoolChange: EventEmitter<ClassSchool> = new EventEmitter<ClassSchool>(); // EventEmitter to notify parent component of class changes

  classSchool: ClassSchool = {
    id: -1,
    name: 'Class Name',
    alums: [],
    profs: []
  };

  users: User[] = []; // List of all users

  newClassName: any;

  constructor(
    private classService: ClassService,      // Service for managing class data
    private userService: UserService,        // Service for managing user data
    private dialogService: DialogService     // Service for showing dialogs
  ) { }

  ngOnInit(): void {
    // Initialize component by fetching users and class data
    this.getUsers();
    this.getClass();
  }

  /**
   * Fetches the class data for the current page and loads users into the class.
   * Emits the class data to the parent component.
   */
  getClass(): void {
    this.classService.getClass(this.page)
      .subscribe(classSchool => {
        this.classSchool = classSchool[0]; // Assuming we get one class
        this.loadUsersToClass(); // Load users into the class (professors and students)
        this.classSchoolChange.emit(this.classSchool); // Emit the updated class data
      });
  }

  /**
   * Maps user objects (professors and students) to their respective class objects.
   * Updates the classSchool's alums and profs properties with the full user objects.
   */
  loadUsersToClass(): void {
    const profs: idUser[] = this.classSchool.profs;
    const alums: idUser[] = this.classSchool.alums;

    let filledProfs: User[] = [];
    let filledAlums: User[] = [];

    // Map professors by user ID
    for (let prof of profs) {
      let userFound = this.users.find(user => user.id === Number(prof.id));
      if (userFound != undefined) {
        filledProfs.push(userFound);
      }
    }

    // Map students by user ID
    for (let alum of alums) {
      let userFound = this.users.find(user => user.id === Number(alum.id));
      if (userFound != undefined) {
        filledAlums.push(userFound);
      }
    }

    this.classSchool.alums = filledAlums; // Set the updated alums
    this.classSchool.profs = filledProfs; // Set the updated professors
  }

  /**
   * Fetches all users to be used in mapping to class professors and students.
   */
  getUsers(): void {
    this.userService.getAllUsers()
      .subscribe(user => {
        this.users = user; // Store the list of users
      });
  }

  /**
   * Changes the current page of classes and fetches the class data for that page.
   * 
   * @param {number} page The new page number to fetch class data for.
   */
  changePage(page: number): void {
    this.page = page; // Update the page number
    this.getClass();  // Fetch class data for the new page
  }

  /**
   * Creates a new class using the class name input by the user.
   * Sends the new class data to the server and displays a success dialog.
   */
  createClass(): void {
    if ($('#className').val().trim() != '') {
      const newClass: ClassWithoutId = {
        name: $('#className').val().trim(),
        alums: [],
        profs: []
      };
      this.classService.createClass(newClass)
        .subscribe(() => {
          this.getClass(); // Refresh the class data after creation
          $('#className').val(""); // Clear the input field
          this.dialogService.mostrarMensaje('Class created correctly!', 'Class creation'); // Show success message
        });
    }
  }

  /**
   * Deletes the current class after user confirmation.
   * Calls the service to delete the class and refreshes the class data.
   */
  deleteClass(): void {
    this.dialogService.solicitarConfirmacion("You're going to delete the class. Sure?", 'Warning!', () => {
      this.classService.deleteClass(this.classSchool)
        .subscribe(() => {
          this.getClass(); // Refresh the class data after deletion
        });
    });
  }

}
