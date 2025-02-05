#include <WiFi.h>
#include <WebServer.h>

WebServer server(80);

#include "config.h"
#include "ESP32_Utils.hpp"
#include "server.hpp"

bool ledStates[5] = {false, false, false, false, false}; // Estados de los LEDs

void setup() {
  Serial.begin(115200);
  
  // Inicializa la conexión Wi-Fi
  ConnectWiFi_STA(); 
  
  // Inicializa el servidor HTTP
  InitServer();
  
  // Ruta GET "/led?id={id}"
  server.on("/led", HTTP_GET, []() {
    if (server.hasArg("id")) {
      int id = server.arg("id").toInt();
      if (id >= 0 && id < 5) {
        server.send(200, "text/plain", ledStates[id] ? "ON" : "OFF");
      } else {
        server.send(400, "text/plain", "ID inválido");
      }
    } else {
      server.send(400, "text/plain", "Parámetro 'id' requerido");
    }
  });

  // Ruta POST "/led"
  server.on("/led", HTTP_POST, []() {
    if (server.hasArg("id") && server.hasArg("status")) {
      int id = server.arg("id").toInt();
      bool status = server.arg("status") == "1";
      if (id >= 0 && id < 5) {
        ledStates[id] = status;
        server.send(200, "text/plain", "Estado cambiado");
      } else {
        server.send(400, "text/plain", "ID inválido");
      }
    } else {
      server.send(400, "text/plain", "Parámetros 'id' y 'status' requeridos");
    }
  });

  server.begin(); // Inicia el servidor
  Serial.println("Servidor HTTP iniciado");
}

void loop() {
  server.handleClient(); // Maneja las solicitudes de cliente

  HTTPClient http;
  http.begin('http:\\192.168.60.189\led?=0');
  int httpResponseCode = http.GET();
  if (httpResponseCode > 0) 
  {
    Serial.print("HTTP ");
    Serial.println(httpResponseCode);
    String html = http.getString();
    Serial.println();
    Serial.println(html);
  }
  else 
  {
    Serial.println("Error.");
  }

}
