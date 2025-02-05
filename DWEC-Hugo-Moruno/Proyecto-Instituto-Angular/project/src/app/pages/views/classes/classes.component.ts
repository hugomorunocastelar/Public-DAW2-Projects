import { Component, OnInit } from '@angular/core';
import { idUser } from '../admin/classes/interface/class.interface';
import { User } from '../admin/users/interface/user.interface';
import { UserService } from '../admin/users/service/user.service';
import { ClassService } from '../admin/classes/service/class.service';

@Component({
  selector: 'app-classes',
  templateUrl: './classes.component.html'
})
export class ClassesComponent implements OnInit {
  page: number = 1; // Current page for pagination
  
  classList: number[] = []; // List to store class IDs

  classSchool: any = {
    id: -1,
    name: 'Class Name', // Placeholder name for class
    alums: [], // List of students (alums)
    profs: [] // List of professors
  };
  users: User[] = []; // List of all users (professors + students)

  constructor(
    private classService: ClassService, // Inject Class service
    private userService: UserService // Inject User service
  ) { }

  /**
   * ngOnInit is called when the component is initialized
   * It loads the classes, users, and current class data
   */
  ngOnInit(): void {
    this.getClassesOfUser(); // Get the list of classes for the user
    this.getUsers(); // Get all users from the API
    this.getClass(); // Load the class based on the current page
  }

  /**
   * Get the classes the user belongs to from local storage
   */
  getClassesOfUser() {
    let ids = localStorage.getItem('classes')?.split(','); // Get class IDs from localStorage
    if (ids != undefined) {
      for (let id of ids) {
        this.classList.push(Number(id)); // Add class IDs to the list
      }
    }
  }

  /**
   * Fetch the class details for the current page
   */
  getClass() {
    this.classService.getClassById(this.classList[this.page - 1]) // Fetch class by ID using the page number
      .subscribe(classSchool => {
        let classObj: any = classSchool; // Assign class data to a variable
        this.classSchool = classObj; // Update the classSchool object
        this.loadUsersToClass(); // Populate the class with its users
      });
  }

  /**
   * Load users into the class (professors and students)
   */
  loadUsersToClass() {
    const profs: idUser[] = this.classSchool.profs; // Get professors from class data
    const alums: idUser[] = this.classSchool.alums; // Get students from class data

    var filledProfs: User[] = [];
    var filledAlums: User[] = [];

    // Add professors to the class
    for (let prof of profs) {
      let userFound = this.users.find(user => user.id === Number(prof.id));
      if (userFound != undefined) {
        filledProfs.push(userFound); // Add user to filledProfs if found
      }
    }

    // Add students to the class
    for (let alum of alums) {
      let userFound = this.users.find(user => user.id === Number(alum.id));
      if (userFound != undefined) {
        filledAlums.push(userFound); // Add user to filledAlums if found
      }
    }

    this.classSchool.alums = filledAlums; // Update students in the class
    this.classSchool.profs = filledProfs; // Update professors in the class
  }

  /**
   * Fetch all users from the UserService
   */
  getUsers() {
    this.userService.getAllUsers() // Call service to get users
      .subscribe(user => {
        this.users = user; // Update users list with the data
      });
  }

  /**
   * Change the page and fetch the class data for the new page
   * @param page - The page number to change to
   */
  changePage(page: number) {
    this.page = page; // Update the current page
    this.getClass(); // Load class data for the new page
  }
}
