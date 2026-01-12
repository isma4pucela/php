CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(100) NOT NULL
);

CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,   
    id_producto INT NOT NULL,  
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON UPDATE RESTRICT ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto) ON UPDATE RESTRICT ON DELETE CASCADE
);

INSERT INTO productos (id_producto, nombre, imagen, stock, estado) 
VALUES (101, '1ª Equipación'), 
       (102, '2ª Equipación'),
       (103, 'Chándal'),
       (104, 'Sudadera'), 
       (105, 'Cazadora'),
       (106, 'Mochila de espalda'),
       (107, 'Mochila tipo bandolera'),
       (108, 'Guardabotas');