import { HttpClient } from '@angular/common/http'; 
import { Injectable } from '@angular/core'; 
import { Observable } from 'rxjs';
import { urls } from 'src/environments/environment';
import { schoolInfo } from '../interface/schoolInfo.interface';

@Injectable({
  providedIn: 'root'
})
export class StartService {

  constructor(
    private httpClient: HttpClient,
  ) { }

  /**
   * Method to retrieve school information from the API.
   * @returns An Observable that will emit an array of schoolInfo objects.
   */
  getSchoolData(): Observable<schoolInfo []> {
    // Sending a GET request to fetch school information from the server using the URL defined in the environment
    return this.httpClient.get<schoolInfo []>(`${urls.URL_SCHOOLINFO}`);
  }
}
