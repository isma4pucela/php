CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(100) NOT NULL
);

CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE ventas (
    id_usuario INT NOT NULL,   
    id_producto INT NOT NULL,   
    PRIMARY KEY (id_usuario, id_producto), 
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
);

INSERT INTO productos (id_producto, nombre) 
VALUES (101, '1ª Equipación'), 
       (102, '2ª Equipación');