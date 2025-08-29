CREATE TABLE agenda_medica (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_medico INT NOT NULL,
    fecha DATE NOT NULL,  -- Nueva columna fecha
    dia_semana ENUM('lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo') NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    intervalo_minutos INT NOT NULL DEFAULT 30,
    sede_id INT NOT NULL,
    disponible TINYINT(1) DEFAULT 1,  -- Nueva columna disponible
    FOREIGN KEY (id_medico) REFERENCES medicos(id_medico),
    FOREIGN KEY (sede_id) REFERENCES sedes(id)
);

INSERT INTO agenda_medica (id_medico, fecha, dia_semana, hora_inicio, hora_fin, intervalo_minutos, sede_id, disponible)
VALUES 
    (1, '2025-08-27', 'Martes', '09:00:00', '09:30:00', 30, 1, 1),
    (1, '2025-08-27', 'Martes', '09:30:00', '10:00:00', 30, 1, 1),
    (1, '2025-08-28', 'Miercoles', '10:00:00', '10:30:00', 30, 1, 1), 
    (2, '2025-08-29', 'Jueves', '09:00:00', '09:30:00', 30, 1, 1),
    (2, '2025-09-29', 'Jueves', '09:30:00', '10:00:00', 30, 1, 1),
    (2, '2025-08-30', 'Sabado', '10:00:00', '10:30:00', 30, 1, 1);