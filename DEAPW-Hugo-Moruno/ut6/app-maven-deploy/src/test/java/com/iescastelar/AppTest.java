package com.iescastelar;

import org.junit.jupiter.api.*;

public class AppTest {
    @Test
    @DisplayName("Prueba Roja")
    void testPruebaRoja() {
        Assertions.assertTrue(true);
    }

    @Test
    @DisplayName("Prueba Suma")
    void testPruebaSuma() {
        Assertions.assertAll(
//            ()->Assertions.assertEquals(0, Main.suma(1, 4)),
            ()->Assertions.assertEquals(5, Main.suma(1, 4)),
            ()->Assertions.assertEquals(-3, Main.suma(2, -5)),
            ()->Assertions.assertEquals(0, Main.suma(5, -5))
        );
    }

}
