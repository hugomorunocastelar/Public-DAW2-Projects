import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map, Observable } from 'rxjs';
import { environment, urls } from 'src/environments/environment';
import { User } from '../interface/user.interface';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  constructor(
    private httpClient: HttpClient, // HttpClient service for making HTTP requests
  ) { }

  /**
   * Fetches all users from the server.
   * 
   * @returns {Observable<User[]>} An observable of the list of users.
   */
  getAllUsers(): Observable<User []> {
    return this.httpClient.get<User []>(`${urls.URL_ALLUSERS}`);
  }

  /**
   * Fetches users filtered by role, page, and filter text.
   * 
   * @param {string} rol The role of the users to be fetched (e.g., 'prof', 'alum', or 'all').
   * @param {number} page The page number for pagination.
   * @param {string} filter A text filter for searching users (optional).
   * 
   * @returns {Observable<User[]>} An observable of the filtered list of users.
   */
  getUsersByRoles(rol: string = 'all', page: number = 1, filter: string = '') {
    let url = '';
    if (rol == 'all') {
      url = `${urls.URL_ALLUSERS}?`; // If role is 'all', fetch all users.
    } else {
      url = `${urls.URL_ALLUSERS}?rol=${rol}&`; // Fetch users by the specified role.
    }

    if (filter != '') {
      url = url + `q=${filter}&`; // Add search filter if provided.
    }

    url = url + `_page=${page}&limit=${environment.DATA_PER_TABLE_PAGE}`; // Pagination.

    return this.httpClient.get<User []>(url); // Return the observable of users.
  }

  /**
   * Updates an existing user.
   * 
   * @param {User} user The user object to be updated.
   * 
   * @returns {Observable<User>} An observable of the updated user.
   */
  updateUser(user: User): Observable<User> {
    return this.httpClient.patch<User>(`${urls.URL_ALLUSERS}/${user.id}`, user); // Send a PATCH request to update the user.
  }

  /**
   * Deletes a user.
   * 
   * @param {User} user The user object to be deleted.
   * 
   * @returns {Observable<void>} An observable that completes when the user is deleted.
   */
  deleteUser(user: User) {
    return this.httpClient.delete(`${urls.URL_ALLUSERS}/${user.id}`); // Send a DELETE request to remove the user.
  }

  /**
   * Fetches a user by their email address.
   * 
   * @param {string} email The email address of the user to be fetched.
   * 
   * @returns {Observable<User | null>} An observable that resolves to the user if found, or null if not found.
   */
  getUserByEmail(email: string): Observable<User | null> {
    return this.httpClient.get<User[]>(`${urls.URL_USERS}?email=${email}`)
      .pipe(
        map(users => users.length > 0 ? users[0] : null) // If a user is found, return the first user, otherwise return null.
      );
  }

}
