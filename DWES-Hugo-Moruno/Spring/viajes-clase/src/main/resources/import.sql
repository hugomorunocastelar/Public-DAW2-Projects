-- Datos para la tabla clientes
INSERT INTO clientes (nif, nombre, apellido1, apellido2, fecha_nacimiento, foto, observaciones, active) VALUES
('000A', 'Juan', 'Pérez', 'Gómez', '1985-06-15', 'foto1.jpg', 'Cliente preferente.', true),
('001A', 'María', 'López', 'Martínez', '1990-09-20', 'foto2.jpg', 'Observaciones cliente.', true),
('002A', 'Carlos', 'García', 'Fernández', '1978-03-12', 'foto3.jpg', NULL, true),
('003A', 'Ana', 'Martín', NULL, '1992-07-08', NULL, 'Falta información adicional.', true),
('004A', 'Luis', 'Torres', 'Sánchez', NULL, NULL, NULL, true),
('005A', 'Elena', 'Hernández', 'Ramírez', '1988-12-05', 'foto4.jpg', 'Cliente frecuente.', true),
('006A', 'David', 'Ruiz', NULL, '1975-11-23', NULL, NULL, true),
('007A', 'Laura', 'Jiménez', 'Álvarez', '1995-02-17', 'foto5.jpg', 'Participante en promociones.', true),
('008A', 'Jorge', 'Navarro', NULL, NULL, NULL, NULL, true),
('009A', 'Marta', 'Castillo', 'Moreno', '1983-08-14', 'foto6.jpg', NULL, true);

-- Datos para la tabla empleados
INSERT INTO empleados (nif, nombre, apellido1, apellido2, fecha_nacimiento, foto, observaciones, active) VALUES
('100E', 'Pedro', 'Gómez', 'Hernández', '1980-10-22', 'fotoE1.jpg', 'Empleado del mes.', true),
('101E', 'Sofía', 'López', NULL, '1991-04-30', 'fotoE2.jpg', NULL, true),
('102E', 'Manuel', 'Díaz', 'Martínez', '1979-01-15', NULL, 'Disponible para horas extras.', true),
('103E', 'Lucía', 'Vega', 'García', NULL, NULL, NULL, true),
('104E', 'Pablo', 'Romero', 'Navarro', '1986-06-25', 'fotoE3.jpg', NULL, true),
('105E', 'Claudia', 'Martínez', 'Ruiz', '1990-11-12', NULL, 'Nueva contratación.', true),
('106E', 'Andrés', 'Ortega', NULL, '1977-03-18', 'fotoE4.jpg', NULL, true),
('107E', 'Isabel', 'Gil', 'Fernández', '1993-05-27', NULL, 'Promovida recientemente.', true),
('108E', 'Victor', 'Morales', NULL, '1984-07-19', 'fotoE5.jpg', NULL, true),
('109E', 'Raquel', 'Pérez', 'Sánchez', '1996-09-03', 'fotoE6.jpg', 'Empleado nuevo.', true);

-- Datos para la tabla viajes
INSERT INTO viajes (referencia, titulo, slug, precio, participantes, salida, llegada, foto, observaciones, active) VALUES
('V001', 'Viaje a París', 'viaje-a-paris', 1200.50, 20, '2024-05-15', '2024-05-22', 'paris.jpg', 'Incluye visitas guiadas.', true),
('V002', 'Crucero por el Caribe', 'crucero-caribe', 2500.00, 100, '2024-06-10', '2024-06-20', 'caribe.jpg', NULL, true),
('V003', 'Tour por Japón', 'tour-japon', 3000.75, 15, '2024-09-05', '2024-09-20', 'japon.jpg', 'Guía en español.', true),
('V004', 'Ruta por la Toscana', 'ruta-toscana', 1500.30, 10, '2024-07-01', '2024-07-10', 'toscana.jpg', 'Hoteles incluidos.', true),
('V005', 'Safari en Kenia', 'safari-kenia', 3200.00, 8, '2024-08-15', '2024-08-25', 'kenia.jpg', NULL, true),
('V006', 'Aventura en Islandia', 'aventura-islandia', 2800.00, 12, '2024-10-10', '2024-10-18', 'islandia.jpg', 'Actividades al aire libre.', true),
('V007', 'Descubre Nueva York', 'descubre-nueva-york', 1800.50, 25, '2024-03-12', '2024-03-18', 'nueva-york.jpg', 'Incluye entradas a espectáculos.', true),
('V008', 'Maravillas de Egipto', 'maravillas-egipto', 2200.90, 18, '2024-04-10', '2024-04-20', 'egipto.jpg', 'Guía en inglés y español.', true),
('V009', 'Escapada a Roma', 'escapada-roma', 1000.00, 30, '2024-02-20', '2024-02-25', 'roma.jpg', 'Ideal para familias.', true),
('V010', 'Vacaciones en Maldivas', 'vacaciones-maldivas', 4500.00, 6, '2024-11-01', '2024-11-10', 'maldivas.jpg', 'Resort 5 estrellas.', true);
