import { Component, Input, OnInit } from '@angular/core';
import { ClassSchool } from '../classes/interface/class.interface';
import { UserService } from '../users/service/user.service';
import { User } from '../users/interface/user.interface';
import { ClassService } from '../classes/service/class.service';
import { DialogService } from 'src/app/components/services/dialog.service';

@Component({
  selector: 'app-roles',
  templateUrl: './roles.component.html'
})
export class RolesComponent implements OnInit {

  users: User[] = [];

  profs: User[] = [];

  alums: User[] = [];

  @Input() classSchool!: ClassSchool; // The class object to which users will be assigned

  constructor(
    private userService: UserService,       // Service to handle user operations
    private classService: ClassService,     // Service to handle class operations
    private dialogService: DialogService    // Service to show dialog messages
  ) { }

  ngOnInit(): void {
    this.getUsers(); // Fetch the list of all users when the component initializes
  }
  
  /**
   * Fetches the list of all users and separates them into professors and students.
   */
  getUsers(): void {
    this.userService.getAllUsers()
      .subscribe(user => {
        this.users = user;
        this.searchForRoles(this.users); // Assign users to roles based on their "rol" property
      });
  }

  /**
   * Separates the users into professors and students based on their roles.
   * 
   * @param {User[]} users List of users to be sorted into roles.
   */
  searchForRoles(users: User[]): void { 
    for (let user of users) {
      if (user.rol == 'prof') {
        this.profs.push(user); // Add to profs list if user is a professor
      } else if (user.rol == 'alum') {
        this.alums.push(user); // Add to alums list if user is a student
      }
    }
  }

  /**
   * Adds or removes selected users (professors and students) to/from the class.
   * 
   * @param {boolean} isGoingToAddTheUsers Whether users should be added or removed from the class.
   */
  modifyUsersToClass(isGoingToAddTheUsers: boolean): void {
    // Get the selected professors and students from the checkbox inputs
    let profsSelected = $('input[chkboxProfs]:checked');
    let alumsSelected = $('input[chkboxAlums]:checked');

    // Create arrays of selected users
    let profs: User[] = this.chargeSelected(profsSelected);
    let alums: User[] = this.chargeSelected(alumsSelected);

    // Update the class's professors and students
    this.classSchool.profs = this.mixLists(profs, this.classSchool.profs, isGoingToAddTheUsers);
    this.classSchool.alums = this.mixLists(alums, this.classSchool.alums, isGoingToAddTheUsers);

    // Create an updated class object with only the user IDs
    const updatedClassSchool: ClassSchool = {
      id: this.classSchool.id,
      name: this.classSchool.name,
      alums: this.classSchool.alums.map(user => ({ id: user.id })),
      profs: this.classSchool.profs.map(user => ({ id: user.id }))
    };

    // Update the class in the system
    this.classService.updateClass(updatedClassSchool)
      .subscribe(response => {
        this.dialogService.mostrarMensaje('Class updated correctly!', 'Class modified'); // Show success message
      });

    // Update users' associated classes
    this.updateUsersClasses(profs, updatedClassSchool.profs, isGoingToAddTheUsers);
    this.updateUsersClasses(alums, updatedClassSchool.alums, isGoingToAddTheUsers);
  }

  /**
   * Updates the list of classes for a given set of users (professors or students).
   * 
   * @param {User[]} users List of users whose classes will be updated.
   * @param {Object[]} classWithId List of classes with IDs that the users will be added/removed from.
   * @param {boolean} isGoingToAddTheUsers Whether users are being added or removed from the class.
   */
  updateUsersClasses(users: User[], classWithId: { id: number }[], isGoingToAddTheUsers: boolean): void {
    for (let user of users) {
      const hasClass = user.classes.some(classItem => classItem.id === this.classSchool.id);

      if (isGoingToAddTheUsers) {
        if (!hasClass) {
          user.classes.push({ id: this.classSchool.id }); // Add class to user's list of classes
          this.userService.updateUser(user).subscribe(() => {
            console.log(`User ${user.name} added to the class.`);
          });
        }
      } else {
        if (hasClass) {
          user.classes = user.classes.filter(classItem => classItem.id !== this.classSchool.id); // Remove class from user's list
          this.userService.updateUser(user).subscribe(() => {
            console.log(`User ${user.name} removed from the class.`);
          });
        }
      }
    }
  }

  /**
   * Combines the selected users with the existing list of users in the class, either adding or removing them.
   * 
   * @param {User[]} idSelected The list of selected users to be added/removed.
   * @param {User[]} idOriginal The original list of users in the class.
   * @param {boolean} isAdding Whether users should be added or removed.
   * 
   * @returns {User[]} The updated list of users in the class.
   */
  mixLists(idSelected: User[], idOriginal: User[], isAdding: boolean): User[] {
    let finalList: User[];

    if (isAdding) {
      finalList = [...idOriginal, ...idSelected.filter(user => !idOriginal.some(existingUser => existingUser.id === user.id))];
    } else {
      finalList = idOriginal.filter(user => !idSelected.some(selectedUser => selectedUser.id === user.id));
    }

    return finalList;
  }
  
  /**
   * Retrieves the selected users from the checkboxes and returns them as a list.
   * 
   * @param {any} profsSelected The jQuery object representing the selected professor checkboxes.
   * 
   * @returns {User[]} The list of selected users.
   */
  chargeSelected(profsSelected: any): User[] {
    let finalList: User[] = [];
    
    // Iterate over each selected checkbox
    profsSelected.each((index: any, checkbox: any) => {
      const userId = $(checkbox).val();
      const userFound = this.users.find(user => user.id === Number(userId));
  
      if (userFound) {
        finalList.push(userFound); // Add the user to the final list
      }
    });
    
    return finalList;
  }
}
