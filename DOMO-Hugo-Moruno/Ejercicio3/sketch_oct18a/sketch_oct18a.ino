void setup() {
  Serial.begin(115200);
}
void loop() {
  float temp = temperatureRead();
  Serial.print("Temperatura CPU ");
  Serial.print(temp);
  Serial.println("°C");
  delay(1000);
}