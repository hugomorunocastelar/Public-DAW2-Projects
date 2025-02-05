import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AutenticacionService } from 'src/app/auth/services/autenticacion.service';

// Constants for menu elements
const BTN_TOGGLEMENU = '#menuProfileToggleButton';
const OBJ_WINDOW = '#window';
const OBJ_MENUPROFILE = '#menuProfile';
const OBJ_CONTAINER = '#appContainerOrganizator';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {

  constructor(
    private router: Router,
    private autenticationService: AutenticacionService
  ) {}

  ngOnInit(): void {
    // Configures menu options based on user role from localStorage
    this.configMenuFromRole(localStorage.getItem('rol'));
    this.autenticationService.getLocalStorage(); // Retrieve local storage data
  }
  
  /**
   * Toggles the visibility of the profile menu
   */
  toggleMenu(): void {
    console.log($(OBJ_MENUPROFILE).css('top'))
    if($(OBJ_MENUPROFILE).css('top') == '0px' )
    {
      // Move the profile menu down
      $(OBJ_MENUPROFILE).animate({
        top: '140px'
      }, 1000)
      // Rotate the button
      $(BTN_TOGGLEMENU).animate({
        rotate: '0deg'
      }, 1000)
    }
    else
    {
      // Move the profile menu up
      $(OBJ_MENUPROFILE).animate({
        top: '0px'
      }, 1000)
      // Rotate the button
      $(BTN_TOGGLEMENU).animate({
        rotate: '180deg'
      }, 1000)
    }
  }

  /** 
   * Logs out the user and redirects to login
   */ 
  logout(): void {
    this.autenticationService.cleanSession(); // Clears user session
    $(OBJ_WINDOW).animate({
      width: '0px',
      height: '0px'
    }, 1000)
    setTimeout(() => {
      this.router.navigate(['/login']); // Navigates to login page
    }, 1200)
  }

  /**
   * Configures the menu options based on the user role
   * @param {String} rol User role from localStorage
   */
  configMenuFromRole(rol: string | null ) {
    // Define menu options
    const home = $("#menuOptionsHome");
    const admin = $("#menuOptionsAdmin");
    const profile = $("#menuProfileConfigButton");
    const classes = $("#menuOptionsClasses");

    switch (rol) {
      case "admin":
        this.showOption(home, "yes");
        this.showOption(admin, "yes");
        this.showOption(profile, "yes");
        this.showOption(classes, "no");
        break;
      case "prof":
        this.showOption(home, "yes");
        this.showOption(admin, "no");
        this.showOption(profile, "yes");
        this.showOption(classes, "yes");
        break;
      case "alum":
        this.showOption(home, "yes");
        this.showOption(admin, "no");
        this.showOption(profile, "yes");
        this.showOption(classes, "yes");
        break;
      case "unassigned":
        this.showOption(home, "yes");
        this.showOption(admin, "no");
        this.showOption(profile, "yes");
        this.showOption(classes, "no");
        break;
      default:
        this.showOption(home, "yes");
        this.showOption(admin, "no");
        this.showOption(profile, "no");
        this.showOption(classes, "no");
        break;
    }
  }

  /**
   * Shows or hides a menu option based on input
   * @param {JQuery object} obj Menu item
   * @param {String} YOrN "yes" shows it, "no" hides it
   */
  showOption(obj: any, YOrN: string) {
    YOrN == "yes" ? obj.removeClass("d-none") : obj.addClass("d-none");
  }
}
