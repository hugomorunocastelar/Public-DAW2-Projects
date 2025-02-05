#include <WiFi.h>
#include <WebServer.h>
#include "config.h"
#include "ESP32_Utils.hpp"

// Variables para simular el estado de los LEDs
bool led1State = false;
bool led2State = false;
bool led3State = false;
bool led4State = false;

// Página HTML con el formulario
String htmlForm = R"rawliteral(
<!DOCTYPE html>
<html>
<head>
  <title>Control de LEDs</title>
</head>
<body>
  <h1>Control de LEDs</h1>
  <form action="/SetLeds" method="post">
    <p>LED 1: 
      <input type="radio" name="led1" value="on"> ON
      <input type="radio" name="led1" value="off" checked> OFF
    </p>
    <p>LED 2: 
      <input type="radio" name="led2" value="on"> ON
      <input type="radio" name="led2" value="off" checked> OFF
    </p>
    <p>LED 3: 
      <input type="radio" name="led3" value="on"> ON
      <input type="radio" name="led3" value="off" checked> OFF
    </p>
    <p>LED 4: 
      <input type="radio" name="led4" value="on"> ON
      <input type="radio" name="led4" value="off" checked> OFF
    </p>
    <button type="submit">Enviar</button>
  </form>
</body>
</html>
)rawliteral";

// Declaración del servidor HTTP
WebServer server(80);

// Función para manejar la raíz (GET "/")
void handleRoot()
{
  server.send(200, "text/html", htmlForm);
}

// Función para manejar la configuración de LEDs (POST "/SetLeds")
void handleSetLeds()
{
  if (server.method() == HTTP_POST)
  {
    // Leer parámetros del formulario
    String led1 = server.arg("led1");
    String led2 = server.arg("led2");
    String led3 = server.arg("led3");
    String led4 = server.arg("led4");

    // Actualizar estados
    led1State = (led1 == "on");
    led2State = (led2 == "on");
    led3State = (led3 == "on");
    led4State = (led4 == "on");

    // Responder al cliente
    String response = "LEDs configurados:<br>";
    response += "LED 1: " + String(led1State ? "ON" : "OFF") + "<br>";
    response += "LED 2: " + String(led2State ? "ON" : "OFF") + "<br>";
    response += "LED 3: " + String(led3State ? "ON" : "OFF") + "<br>";
    response += "LED 4: " + String(led4State ? "ON" : "OFF") + "<br>";
    response += "<a href='/'>Volver</a>";
    server.send(200, "text/html", response);
  }
  else
  {
    server.send(405, "text/plain", "Método no permitido");
  }
}

// Función para inicializar el servidor
void InitServer()
{
  server.on("/", handleRoot);
  server.on("/SetLeds", HTTP_POST, handleSetLeds);
  server.begin();
  Serial.println("Servidor HTTP iniciado");
}

// Configuración inicial
void setup()
{
  Serial.begin(115200);
  ConnectWiFi_STA();
  InitServer();
}

// Bucle principal
void loop()
{
  server.handleClient();
}
