import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { urls } from 'src/environments/environment';
import { ClassSchool, ClassWithoutId } from '../interface/class.interface';

@Injectable({
  providedIn: 'root'
})
export class ClassService {

  constructor(
    private httpClient: HttpClient, // Injecting HttpClient for making HTTP requests
  ) { }

  /**
   * Fetches all classes from the server.
   * 
   * @returns {Observable<ClassSchool[]>} An observable with a list of classes
   */
  getAllClasses(): Observable<ClassSchool[]> {
    return this.httpClient.get<ClassSchool[]>(`${urls.URL_ALLCLASSES}`);
  }

  /**
   * Fetches a paginated list of classes, defaults to page 1.
   * 
   * @param {number} page The page number to fetch, default is 1.
   * @returns {Observable<ClassSchool[]>} An observable with a list of classes for the given page
   */
  getClass(page: number = 1): Observable<ClassSchool[]> {
    return this.httpClient.get<ClassSchool[]>(`${urls.URL_ALLCLASSES}?id_ne=-1&_page=${page}&_limit=1`);
  }

  /**
   * Fetches a class by its unique identifier.
   * 
   * @param {any} id The ID of the class to fetch.
   * @returns {Observable<ClassSchool[]>} An observable with the class details
   */
  getClassById(id: any): Observable<ClassSchool[]> {
    return this.httpClient.get<ClassSchool[]>(`${urls.URL_ALLCLASSES}/${id}`);
  }

  /**
   * Creates a new class using the provided class details.
   * 
   * @param {ClassWithoutId} ClassSchool The class object to create (without ID).
   * @returns {Observable<ClassSchool>} An observable with the newly created class
   */
  createClass(ClassSchool: ClassWithoutId): Observable<ClassSchool> {
    return this.httpClient.post<ClassSchool>(`${urls.URL_ALLCLASSES}`, ClassSchool);
  }

  /**
   * Deletes a class by its ID.
   * 
   * @param {ClassSchool} ClassSchool The class object to delete.
   * @returns {Observable<any>} An observable representing the result of the delete request
   */
  deleteClass(ClassSchool: ClassSchool): Observable<any> {
    return this.httpClient.delete(`${urls.URL_ALLCLASSES}/${ClassSchool.id}`);
  }

  /**
   * Updates an existing class with new details.
   * 
   * @param {ClassSchool} ClassSchool The class object with updated data.
   * @returns {Observable<ClassSchool>} An observable with the updated class details
   */
  updateClass(ClassSchool: ClassSchool): Observable<ClassSchool> {
    return this.httpClient.patch<ClassSchool>(`${urls.URL_ALLCLASSES}/${ClassSchool.id}`, ClassSchool);
  }

}
