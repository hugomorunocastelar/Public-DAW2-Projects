import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  // Page title displayed in the component
  pageTitle: string = '';

  constructor(
    private router: Router,
  ) { }

  ngOnInit(): void {
    // Animate the home screen display
    this.animatedShowHome();

    // Set the page title based on the current route
    this.setPageTitle(this.router.routerState.snapshot.url);

    // Subscribe to router events to dynamically change page title based on the route
    this.router.events.subscribe(() => {
      const currentRoute = this.router.url;
      this.setPageTitle(currentRoute); // Update page title on route change
    });
  }

  /**
   * Sets the page title based on the current route.
   * Updates the `pageTitle` property to match the route name.
   * 
   * @param {string} route The current route URL.
   */
  setPageTitle(route: string): void {
    switch (route) {
      case '/home/start':
        this.pageTitle = 'Home';
        break;
      case '/home/admin/users':
        this.pageTitle = 'Admin - Users';
        break;
      case '/home/admin/classes':
        this.pageTitle = 'Admin - Classes';
        break;
      case '/home/admin/roles':
        this.pageTitle = 'Admin - Roles';
        break;
      case '/home/classes':
        this.pageTitle = 'Classes';
        break;
      case '/home/profile':
        this.pageTitle = 'Profile';
        break;
      default:
        this.pageTitle = 'Unknown page';
    }
  }

  /**
   * Animates the home window to take up 100% of the width and height.
   * This is used to create an animated effect when the home page is loaded.
   */
  animatedShowHome(): void {
    $('#window').animate({
      width: '100%', // Expanding the width
      height: '100%' // Expanding the height
    }, 1000); // Duration of the animation
  }

}
