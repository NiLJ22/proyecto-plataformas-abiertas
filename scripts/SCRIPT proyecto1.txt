/** Creación de la base de datos
CREATE DATABASE TiendaRopa;

/** Usar la base de datos
USE TiendaRopa;

/** Creación de la tabla Marca
CREATE TABLE Marca (
    id_marca INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    estilo VARCHAR(50)
);

/** Creación de la tabla Prendas
CREATE TABLE Prendas (
    id_prenda INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    talla VARCHAR(10),
    color VARCHAR(50),
    precio DECIMAL(10, 2),
    id_marca INT,
    FOREIGN KEY (id_marca) REFERENCES Marca(id_marca)
);

/** Creación de la tabla Ventas
CREATE TABLE Ventas (
    id_venta INT PRIMARY KEY AUTO_INCREMENT,
    fecha DATE,
    total DECIMAL(10, 2),
    id_prenda INT,
    FOREIGN KEY (id_prenda) REFERENCES Prendas(id_prenda)
);

/** Inserción de datos de ejemplo
INSERT INTO Marca (nombre, descripcion, estilo) VALUES
('NIKE', 'CONJUNTOS DEPORTIVOS', 'FUTBOL'),
('ADIDAS', 'CONJUNTOS DEPORTIVOS', 'VOLEIBOL'),
('DC', 'CONJUNTOS DEPORTIVOS', 'SKATE');
('ASICS', 'CONJUNTOS DEPORTIVOS', 'VOLEIBOL'),
('PIRMA', 'CONJUNTOS DEPORTIVOS', 'FUTBOL'),
('PUMA', 'CONJUNTOS DEPORTIVOS', 'ATLETISMO');

**INSERT INTO Prendas (nombre, talla, color, precio, id_marca) VALUES
('Camiseta y Pantaloneta', 'M', 'Rojo', 19.99, 1),
('Camiseta y Pantaloneta', 'L', 'Azul', 39.99, 1),
('Camiseta y Pantaloneta', 'S', 'Negro', 59.99, 1);

**INSERT INTO Prendas (nombre, talla, color, precio, id_marca) VALUES
('Camiseta y Pantaloneta', 'M', 'Azul', 10.99, 2),
('Camiseta y Pantaloneta', 'L', 'Verde', 20.00, 2),
('Camiseta y Pantaloneta', 'S', 'Celeste', 59.05, 2);

**INSERT INTO Prendas (nombre, talla, color, precio, id_marca) VALUES
('Camiseta y Pantaloneta', 'M', 'Negro', 19.99, 3),
('Camiseta y Pantaloneta', 'L', 'Amarillo', 25.00, 3),
('Camiseta y Pantaloneta', 'S', 'Morado', 30.00, 3);
**INSERT INTO Prendas (nombre, talla, color, precio, id_marca) VALUES
('Camiseta y Pantaloneta', 'M', 'Rojo', 19.99, 4),
('Camiseta y Pantaloneta', 'L', 'Azul', 39.99, 4),
('Camiseta y Pantaloneta', 'S', 'Negro', 59.99, 4);

**INSERT INTO Prendas (nombre, talla, color, precio, id_marca) VALUES
('Camiseta y Pantaloneta', 'M', 'Azul', 10.99, 5),
('Camiseta y Pantaloneta', 'L', 'Verde', 20.00, 5),
('Camiseta y Pantaloneta', 'S', 'Celeste', 59.05, 5);

**INSERT INTO Prendas (nombre, talla, color, precio, id_marca) VALUES
('Camiseta y Pantaloneta', 'M', 'Negro', 19.99, 6),
('Camiseta y Pantaloneta', 'L', 'Amarillo', 25.00, 6),
('Camiseta y Pantaloneta', 'S', 'Morado', 30.00, 6);

INSERT INTO Ventas (fecha, total, id_prenda) VALUES
('2024-06-01', 19.99, 1),
('2024-06-01', 39.99, 2),
('2024-06-02', 59.99, 3),
('2024-06-02', 10.99, 4),
('2024-06-03', 20.00, 5),
('2024-06-03', 59.05, 6),
('2024-06-04', 19.99, 2),
('2024-06-04', 25.00, 2),
('2024-06-04', 30.00, 2);

INSERT INTO Ventas (fecha, total, id_prenda) VALUES
('2024-06-01', 19.99, 1),
('2024-06-01', 39.99, 4),
('2024-06-02', 59.99, 1),
('2024-06-02', 10.99, 3),
('2024-06-03', 20.00, 1),
('2024-06-03', 59.05, 3),
('2024-06-04', 19.99, 4),
('2024-06-04', 25.00, 5),
('2024-06-04', 30.00, 5);

INSERT INTO Ventas (fecha, total, id_prenda) VALUES
('2024-06-01', 19.99, 1),
('2024-06-01', 39.99, 4),
('2024-06-02', 59.99, 1),
('2024-06-02', 10.99, 3),
('2024-06-03', 20.00, 6),
('2024-06-03', 59.05, 6),
('2024-06-04', 19.99, 4);

/** Eliminación de algún dato
DELETE FROM Prendas WHERE id_prenda = 2;
/** Actualización de algún dato
UPDATE Prendas SET precio = 24.99 WHERE id_prenda = 1;
/** Consulta de los datos
SELECT * FROM Marca;
SELECT * FROM Prendas;
SELECT * FROM Ventas;

/** Obtener la cantidad vendida de prendas por fecha y filtrarla con una fecha específica
SELECT fecha, COUNT(*) AS cantidad_vendida
FROM Ventas
WHERE fecha = '2024-06-01'
GROUP BY fecha;



/**Obtener prendas vendidas y su cantidad restante en stock
CREATE VIEW PrendasVendidasYStock AS
SELECT p.id_prenda, p.nombre, COUNT(v.id_venta) AS cantidad_vendida
FROM Prendas p
LEFT JOIN Ventas v ON p.id_prenda = v.id_prenda
GROUP BY p.id_prenda, p.nombre;

/** Obtener listado de las 5 marcas más vendidas y su cantidad de ventas
CREATE VIEW Top5MarcasVendidas AS
SELECT m.id_marca, m.nombre, COUNT(v.id_venta) AS cantidad_ventas
FROM Marca m
JOIN Prendas p ON m.id_marca = p.id_marca
JOIN Ventas v ON p.id_prenda = v.id_prenda
GROUP BY m.id_marca, m.nombre
ORDER BY cantidad_ventas DESC
LIMIT 5;






