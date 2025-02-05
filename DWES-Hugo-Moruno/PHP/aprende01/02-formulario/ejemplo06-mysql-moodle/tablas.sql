CREATE TABLE IF NOT EXISTS curriculos (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nombre VARCHAR(20) NOT NULL,
                    apellidos VARCHAR(40) NOT NULL,
                    email VARCHAR(255) UNIQUE,
                    fecha_nacimiento DATE,
                    sexo CHAR(1),
                    aficiones VARCHAR(255),
                    estudios VARCHAR(255),
                    observaciones TEXT,
                    imagen VARCHAR(255)
);