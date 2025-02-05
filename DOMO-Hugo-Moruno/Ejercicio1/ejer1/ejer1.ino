int pin = 13;

void setup() {
  pinMode(pin, OUTPUT);  // Set pin as OUTPUT
}

void loop() {
  // Call the bucleLed function to blink the LED
  bucleLed(pin);
}

void bucleLed(int codigo) {
  digitalWrite(codigo, HIGH);  // Turn the LED on
  delay(500);                  // Wait for 500 milliseconds
  digitalWrite(codigo, LOW);   // Turn the LED off
  delay(500);                  // Wait for 500 milliseconds
}
