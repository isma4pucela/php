CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(100) NOT NULL
);

CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    imagen VARCHAR(100),
    estado VARCHAR(100)
);

CREATE TABLE ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,   
    id_producto INT NOT NULL,
    estado VARCHAR(100),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON UPDATE RESTRICT ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto) ON UPDATE RESTRICT ON DELETE CASCADE
);

INSERT INTO productos (id_producto, nombre, imagen) 
VALUES (101, '1ª Equipación', '1equipación.png'), 
       (102, '2ª Equipación', '2equipación.png'),
       (103, 'Chándal', 'chándal.png'),
       (104, 'Sudadera', 'sudadera.png'), 
       (105, 'Cazadora','cazadora.png'),
       (106, 'Mochila de espalda', 'mochila1.png'),
       (107, 'Mochila tipo bandolera', 'mochila2.png'),
       (108, 'Guardabotas', 'guardabotas.png');