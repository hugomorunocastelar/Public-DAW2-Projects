int pinRojo = 13;
int pinVerde = 12;

unsigned long tiempoRojo = 0;
unsigned long tiempoVerde = 0;

void setup() {
  pinMode(pinRojo, OUTPUT);
  pinMode(pinVerde, OUTPUT);
}

void loop() {
  unsigned long contador = millis();
  if (contador - tiempoRojo >= 500) {
    digitalWrite(pinRojo, !digitalRead(pinRojo));
    tiempoRojo = tiempoActual;
  }

  if (contador - tiempoVerde >= 2000) {
    digitalWrite(pinVerde, !digitalRead(pinVerde));
    tiempoVerde = contador;
  }
}