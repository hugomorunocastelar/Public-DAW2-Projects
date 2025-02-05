import { Injectable } from '@angular/core';
import { map, Observable, of } from 'rxjs';
import { urls } from 'src/environments/environment';
import { LoginRequest, RegisterRequest, UserResponse } from '../interfaces/autentication';
import { HttpClient } from '@angular/common/http';
import { session } from 'src/environments/userdata';
import { jwtDecode } from 'jwt-decode';

@Injectable({
  providedIn: 'root'
})
export class AutenticacionService {

  constructor(
    private httpClient: HttpClient
  ) { }

  iniciarSesion(login: string, password: string) : Observable<boolean>
  {
    const credenciales: LoginRequest = {
      email: login,
      password: password
    }

    return this.httpClient.post<UserResponse>(urls.URL_LOGIN, credenciales)
    .pipe(
      map((response) => {
        session.jwtToken = response.accessToken;
        session.classes = response.user.classes;
        session.email = response.user.email;
        session.name = response.user.name;
        session.rol = response.user.rol;
        session.age = response.user.age;
        session.id = response.user.id;
        this.saveSession();
        return true;
      })
    )
  }

  register(mail: string, password: string, name: string, age: number) : Observable<boolean>
  {
    const credenciales: RegisterRequest = {
      email: mail,
      password: password,
      name: name,
      rol: 'unassigned',
      age: age,
      classes: []
    }

    return this.httpClient.post<UserResponse>(urls.URL_REGISTER, credenciales)
    .pipe(
      map((response) => {
        session.jwtToken = response.accessToken;
        session.classes = response.user.classes;
        session.email = response.user.email;
        session.name = response.user.name;
        session.rol = response.user.rol;
        session.age = response.user.age;
        session.id = response.user.id;
        this.saveSession();
        return true;
      })
    )
  }

  /**
   * Method based in https://jwt.io/ documentation. And using the 
   * jwtDecodify library to get the expiration time of the token.
   * 
   * Gets the expiration time of the token and compares it to the actual time.
   * 
   * @returns {Boolean} false if jwt has expired, true if not.
   */
  trySession(): Observable<boolean> { 
    //Take the token
    const token = localStorage.getItem("token");
    
    //Checks for token, if there's no one, it returns false.
    if (!token) { return of(false); }

    //Decodify the token
    const payload =  jwtDecode<any>(token);
    
    //Get actual time in UNIX time
    const now = Math.floor(Date.now() / 1000); 
    
    //Compare and return
    return of(payload.exp > now);
  }

  token(): string | null{
    return session.jwtToken;
  }

  saveSession()
  {
      localStorage.setItem("token", session.jwtToken),
      localStorage.setItem("classes", this.saveClasses()),
      localStorage.setItem("email", session.email),
      localStorage.setItem("name", session.name),
      localStorage.setItem("rol", session.rol),
      localStorage.setItem("age", `${session.age}`),
      localStorage.setItem("id", `${session.id}`);
  }

  /**
   * Closses the session. To do it, cleans the variables and the Menú.
   */
  cleanSession()
  {
      //Cleans the session variables
      session.jwtToken = "";
      session.classes = [];
      session.email = "";
      session.name = "";
      session.rol = "";
      session.age = 0;
      session.id = 0;
      

      //Cleans the localStorage
      this.cleanLocalStorage();
  }

  /**
   * Formats the clases of the user to a string to save them into the browser
   * 
   * @returns {String} Returns the String of the classes
  */
  saveClasses()
  {
    var classesList = "";
    
    //For every class, loads the id into the String
    for (let clas of session.classes)
    {
        // classesList = classesList + clas.id + ",";
    }
        
    return classesList;
  }
    
  /**
   * 
   * @param {String} classesList It admits the string with the classes Id, and
   * converts it to a object
   * @returns {Object} Returns a object with the formatted clases of the String
  */
  getClasses(classesList: string | null)
  {
      var classesObj = [];
      
      if( classesList != null)
      {
        //Formatts the String into a Object
        for (let classId of classesList.split(","))
        {
            if (classId != null && classId != "")
            {
                classesObj.push({ id: classId });
            }
        }
      }
      return classesObj;
  }

  /**
   * Saves the session data into the browser
  */

  /**
   * Gets the session data from the browser
  */
  getLocalStorage()
  {
      session.jwtToken = localStorage.getItem("token") ?? '';
      session.classes = this.getClasses(localStorage.getItem("classes")) ?? [];
      session.email = localStorage.getItem("email") ?? '';
      session.name = localStorage.getItem("name") ?? '';
      session.rol = localStorage.getItem("rol") ?? '';
      session.age = Number(localStorage.getItem("age") ?? 0);
      session.id = Number(localStorage.getItem("id") ?? 0);
  }
     
/**
 * Cleans the localStorage
 */
  cleanLocalStorage()
  {
      localStorage.setItem("token", ""),
      localStorage.setItem("classes", ""),
      localStorage.setItem("email", ""),
      localStorage.setItem("name", ""),
      localStorage.setItem("rol", ""),
      localStorage.setItem("age", ""),
      localStorage.setItem("id", "");
  }
}

