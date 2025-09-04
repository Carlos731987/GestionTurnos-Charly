CREATE TABLE roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO roles (nombre_rol) VALUES
('Paciente'),
('Medico'),
('Administrador');

CREATE TABLE perfiles (
    id_perfil INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    rol_id INT NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (rol_id) REFERENCES roles(id_rol)
);

ALTER TABLE medicos 
ADD COLUMN id_perfil INT UNIQUE,
ADD FOREIGN KEY (id_perfil) REFERENCES perfiles(id_perfil);

ALTER TABLE pacientes 
ADD COLUMN id_perfil INT UNIQUE,
ADD FOREIGN KEY (id_perfil) REFERENCES perfiles(id_perfil);

CREATE TABLE administradores (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    id_perfil INT UNIQUE,
    FOREIGN KEY (id_perfil) REFERENCES perfiles(id_perfil)
);
