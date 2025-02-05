void handleRoot()
{
  server.send(200, "text/plain", "Hola mundo!");
}

void handleTest()
{
  server.send(200, "text/plain", "Hola mundo! 2");
}

void handleNotFound()
{
  server.send(404, "text/plain", "Error");
}

void InitServer()
{
  server.on("/", handleRoot);
  server.on("/test", handleTest);
  server.onNotFound(handleNotFound);
  server.begin();
  Serial.println("Servidor HTTP iniciado");
}