package com.iescastelar;

/** Clase Main.
 */
public final class Main {
    /** Método Inicial.
     * @param args
     */
    public static void main(final String[] args) {
        Main app = new Main();
        int resultado = app.suma(
                Integer.parseInt(args[0]),
                Integer.parseInt(args[1])
        );
        System.out.println(resultado);
    }

    /** Método suma.
     *
     * @param a
     * @param b
     * @return suma de a y b.
     */
    static int suma(final int a, final int b) {
        return a + b;
    }

    /** Constructor.
     */
    private Main() { }
}
