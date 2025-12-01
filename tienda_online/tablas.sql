CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(100) NOT NULL,
    tipo VARCHAR(100) 
);

CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    stock INT,
    estado VARCHAR(100)
);

CREATE TABLE ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,   
    id_producto INT,  
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON UPDATE ON DELETE,
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto) ON UPDATE ON DELETE
);

INSERT INTO productos (id_producto, nombre) 
VALUES (101, '1ª Equipación'), 
       (102, '2ª Equipación'),
       (103, 'Chándal'),
       (104, 'Sudadera'), 
       (105, 'Cazadora'),
       (106, 'Mochila de espalda'),
       (107, 'Mochila tipo bandolera'),
       (108, 'Guardabotas');