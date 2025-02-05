//Ejercicio 1: Escriba un programa que almacene en una matriz de 5*4 números aleatorios entre 1 y 50.
//Después haga lo siguiente:
//a) Muestre la matriz.
//b) Pida al usuario un número de fila y muestre los datos de esa fila. (Controle que el usuario
//no introduzca filas erróneas)
//c) Pida al usuario un número de columna y muestre los datos de esa columna. (Controle que
//el usuario no introduzca columnas erróneas)

import java.util.Scanner;

public class Main {
    public static void main(String[] args) {

        int[][] matriz = new int[5][4]; // Matriz 5x4

        // Llenar la matriz con números aleatorios entre 1 y 50 usando Math.random()
        for (int i = 0; i < 5; i++) {
            for (int j = 0; j < 4; j++) {
                matriz[i][j] = (int) (Math.random() * 50) + 1;
            }
        }

        // Mostrar la matriz
        System.out.println("La matriz es: ");
        for (int i = 0; i < 5; i++) {
            for (int j = 0; j < 4; j++) {
                System.out.print(matriz[i][j] + "\t");
            }
            System.out.println(); // Salto de línea al final de cada fila
        }

        Scanner entrada = new Scanner(System.in);

        // Pedir al usuario un número de fila y mostrar los datos de esa fila
        int fila;
        do {
            System.out.println("Introduce un número de fila (1 a 5):");
            fila = entrada.nextInt() - 1;
            if (fila < 0 || fila > 4) {
                System.out.println("Error, no has introducido un valor válido. Inténtalo de nuevo.");
            }
        } while (fila < 0 || fila > 4);

        // Mostrar los datos de la fila seleccionada
        System.out.println("Datos de la fila número " + (fila+1) + ":");
        for (int j = 0; j < 4; j++) {
            System.out.print(matriz[fila][j] + "\t");
        }
        System.out.println();

        // Pedir al usuario un número de columna y mostrar los datos de esa columna
        int columna;
        do {
            System.out.println("Introduce un número de columna (1 a 4):");
            columna = entrada.nextInt() -1;
            if (columna <= 0 || columna >= 4) {
                System.out.println("Error, no has introducido un número válido. Inténtalo de nuevo.");
            }
        } while (columna <= 0 || columna >= 4);

        // Mostrar los datos de la columna seleccionada
        System.out.println("Datos de la columna número " + (columna+1) + ":");
        for (int i = 0; i < 5; i++) {
            System.out.println(matriz[i][columna]);
        }
    }
}