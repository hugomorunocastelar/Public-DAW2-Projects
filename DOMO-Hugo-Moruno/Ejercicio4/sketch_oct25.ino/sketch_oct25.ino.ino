#include <WiFi.h>
#include <WebServer.h>

WebServer server(80);

#include "config.h"
#include "ESP32_Utils.hpp"
#include "server.hpp"

void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);

  ConnectWiFi_STA();

  server.on("/", handleRoot);
  server.on("/test", handleTest);
  server.onNotFound(handleNotFound);
  server.begin();
  Serial.println("Servidor HTTP iniciado");
}

void loop() {
  // put your main code here, to run repeatedly:
  server.handleClient();
}
