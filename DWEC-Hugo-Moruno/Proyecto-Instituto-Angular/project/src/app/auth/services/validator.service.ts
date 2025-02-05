import { Injectable } from '@angular/core';
import { AbstractControl, FormControl, ValidationErrors } from '@angular/forms';
import { catchError, map, Observable, of, switchMap } from 'rxjs';
import { UserService } from 'src/app/pages/views/admin/users/service/user.service';

@Injectable({
  providedIn: 'root'
})
export class ValidatorService {
  
  constructor(
    private userService: UserService
  ) {}

  private errorMessages: any = {
    firstIsNotUppercase: "The value must start with an uppercase letter",
    required: "Field is required",
    moreThan3Characters: "The value must be more than 3 characters long",
    invalidEmail: "Invalid email format"
  }

  validateFirstUppercase(control: FormControl): ValidationErrors | null {
    var value = control.value?.trim()[0];
    var uppercase = value?.toUpperCase();
    if (value !== uppercase) {
      return { firstIsNotUppercase: true };
    }
    return null;
  }

  validateMoreThan3Characters(control: FormControl): ValidationErrors | null {
    var value = control.value?.trim();
    if (value?.length <= 3) {
      return { moreThan3Characters: true };
    }
    return null;
  }

  validateEmail(control: FormControl): ValidationErrors | null {
    const regex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
    if (!regex.test(control.value)) {
      return { invalidEmail: true };
    }
    return null;
  }

  getErrorMessage(error: string): string {
    return this.errorMessages[error];
  }

  registerErrorMessage(key: string, value: string) {
    this.errorMessages[key] = value;
  }

  validateEmailAsync(control: AbstractControl): Observable<ValidationErrors | null> {
    const value = control.value;
    if (!value) {
      return of(null);
    }

    return of(value).pipe(
      switchMap(email => 
        this.userService.getUserByEmail(email).pipe(
          map(user => user ? { emailTaken: true } : null),
          catchError(() => of(null)) 
        )
      )
    );
  }

  validateNameUniqueAsync(control: AbstractControl): Observable<ValidationErrors | null> {
    const value = control.value;
    if (!value) {
      return of(null);
    }

    return of(value).pipe(
      switchMap(name => 
        this.userService.getUsersByRoles('all', 1, name)
        .pipe(
          map(users => users.length > 0 ? { nameNotUnique: true } : null),
          catchError(() => of(null))
        )
      )
    );
  }

}
