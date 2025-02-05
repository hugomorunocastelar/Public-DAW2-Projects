import { Component, Input, OnInit } from '@angular/core';
import { User } from './interface/user.interface';
import { UserService } from './service/user.service';
import { tap } from 'rxjs';
import { DialogService } from 'src/app/components/services/dialog.service';

const SELECTOR_ROLES = '#rolSelector';
const TEXT_SEARCH = '#lookForText';
const BTN_SEARCH = '#btnLookForUser';

@Component({
  selector: 'app-users',
  templateUrl: './users.component.html'
})
export class UsersComponent implements OnInit {

  users: User[] = [];
  page: number = 1;

  @Input() canEdit: boolean = true;
  disabledActions: boolean = false;

  constructor(
    private userService: UserService,
    private dialogService: DialogService
  ) { }

  /**
   * Initializes the component by loading users and setting up event listeners.
   */
  ngOnInit(): void {
    this.getUsers();

    $(SELECTOR_ROLES).on('change', () => { this.page = 1; this.getUsers() });
    $(BTN_SEARCH).on('click', () => { this.page = 1; this.getUsers() });
  }

  /**
   * Fetches users based on selected role, search filter, and current page.
   */
  getUsers() {
    let roles = $(SELECTOR_ROLES).val();
    let filter = $(TEXT_SEARCH).val();

    this.userService.getUsersByRoles(roles, this.page, filter)
      .subscribe(user => {
        this.users = user;
      });
  }

  /**
   * Updates the selected user with the data entered in the form.
   */
  updateSelectedUser() {
    const userPrev = this.users.find(user => user.id === Number($('#idForm').val()));
    let userToUpdate: User;

    if (userPrev != undefined) {
      userToUpdate = {
        email: userPrev.email,
        name: $('#nameForm').val(),
        age: Number($('#ageForm').val()),
        rol: $('#rolSelectorForm').val(),
        id: userPrev.id,
        classes: userPrev.classes
      };

      if (userToUpdate != undefined) {
        this.userService.updateUser(userToUpdate)
          .subscribe(() => {
            this.getUsers();
          });
      }
    }
  }

  /**
   * Deletes the selected user after confirming the action.
   * 
   * @param {User} user The user to be deleted.
   */
  deleteUser(user: User) {
    this.dialogService.solicitarConfirmacion("You're going to delete the user. Sure?", 'Warning!', () => {
      this.userService.deleteUser(user)
        .subscribe(() => {
          this.getUsers();
        });
    });
  }

  /**
   * Changes the current page and reloads the users list.
   * 
   * @param {number} page The new page number to load.
   */
  changePage(page: any) {
    this.page = page;
    this.getUsers();
  }

  /**
   * Opens the form to edit the selected user's information.
   * 
   * @param {User} user The user whose details are to be loaded into the form.
   * @param {boolean} editable Flag to determine if the form should be editable.
   */
  openForm(user: User, editable: boolean = false) {
    this.loadUser(user, editable);
    this.animatedForm(true);
  }

  /**
   * Closes the user form, saving the changes if indicated.
   * 
   * @param {boolean} isGoingToSave Flag to indicate if changes should be saved.
   */
  closeForm(isGoingToSave: boolean) {
    if (isGoingToSave) {
      this.animatedForm(false);
      this.disabledActions = false;
      this.updateSelectedUser();
    } else {
      this.animatedForm(false);
      this.disabledActions = false;
    }
  }

  /**
   * Loads the user's details into the form fields and enables/disables form inputs based on editability.
   * 
   * @param {User} user The user whose details will be loaded.
   * @param {boolean} editable Flag to determine if the form should be editable.
   */
  loadUser(User: User, editable: boolean = false) {
    if (editable) {
      $("#mailForm").val(User.email).removeAttr('disabled', false);
      $("#nameForm").val(User.name).removeAttr('disabled', false);
      $("#ageForm").val(User.age).removeAttr('disabled', false);
      $("#rolSelectorForm").val(User.rol).removeAttr('disabled', false);
      $("#idForm").val(User.id);
      $('#btnSaveUser').removeAttr('disabled', false);
      this.disabledActions = true;
    } else {
      $("#mailForm").val(User.email).attr('disabled', true);
      $("#nameForm").val(User.name).attr('disabled', true);
      $("#ageForm").val(User.age).attr('disabled', true);
      $("#rolSelectorForm").val(User.rol).attr('disabled', true);
      $("#idForm").val(User.id);
      $('#btnSaveUser').attr('disabled', true);
      this.disabledActions = true;
    }
  }

  /**
   * Animates the form to open or close with a smooth transition.
   * 
   * @param {boolean} isOpening Flag to indicate if the form is opening (true) or closing (false).
   */
  animatedForm(isOpening: boolean = true) {
    if (isOpening) {
      $("#editForm").removeClass("d-none");
      $("#editForm").animate({
        height: '260px'
      }, 1000);
    } else {
      $("#editForm").animate({
        height: '0px'
      }, 1000, () => {
        $("#editForm").addClass("d-none");
      });
    }
  }

}
