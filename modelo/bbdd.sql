DROP DATABASE IF EXISTS mi_app;
CREATE DATABASE mi_app;
USE mi_app;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;


CREATE TABLE publicaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    
    dificultad TINYINT NOT NULL CHECK (dificultad BETWEEN 1 AND 4),
    
    tiempo_estimado VARCHAR(50),
    kilometros DECIMAL(5,2),
    
    punto_inicio VARCHAR(150),
    
    desnivel_positivo INT,
    desnivel_negativo INT,
    
    cimas VARCHAR(255),
    
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE imagenes (
    id INT AUTO_INCREMENT PRIMARY KEY,  
    publicacion_id INT NOT NULL,
    usuario_id INT NOT NULL,
    fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (publicacion_id) REFERENCES publicaciones(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB;

ALTER TABLE imagenes
ADD url_imagen VARCHAR(255) NOT NULL;

CREATE TABLE likes_publicaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    publicacion_id INT NOT NULL,
    usuario_id INT NOT NULL,
    fecha_like TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    UNIQUE KEY like_unico (publicacion_id, usuario_id),
    FOREIGN KEY (publicacion_id) REFERENCES publicaciones(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB;
