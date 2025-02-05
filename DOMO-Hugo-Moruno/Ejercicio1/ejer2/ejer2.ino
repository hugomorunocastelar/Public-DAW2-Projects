int pin = 12;
  
void setup() {
  // put your setup code here, to run once:
}

void loop() {
  // put your main code here, to run repeatedly:
  bucleLed(pin);
}

bucleLed(codigo) {
  digitalWrite(codigo, HIGH);
  delay(1000);
  digitalWrite(codigo, LOW);
  delay(1000);
}