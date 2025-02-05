/**
 * Represents a class in a school with details like the class ID, name,
 * students (alums), and professors (profs).
 */
export interface ClassSchool {
  id: number;           // Unique identifier for the class
  name: string;         // Name of the class
  alums: any[];         // Array of students enrolled in the class
  profs: any[];         // Array of professors assigned to the class
}

/**
 * Represents a user with a unique ID.
 */
export interface idUser {
  id: number;           // Unique identifier for the user
}

/**
 * Represents a class without an ID. This is used for creating or updating
 * classes where the ID is not needed.
 */
export interface ClassWithoutId {
  name: string;         // Name of the class
  alums: any[];         // Array of students to be assigned to the class
  profs: any[];         // Array of professors to be assigned to the class
}
