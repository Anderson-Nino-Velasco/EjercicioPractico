CREATE DATABASE basedatos;
USE basedatos;

CREATE TABLE vehiculos(
    placa varchar(6) NOT NULL PRIMARY KEY,
    tipo_vehiculo text NOT NULL,
    kilometraje int NOT NULL,
    estado text NOT NULL,
    propietario text NOT NULL
);

CREATE TABLE orden_de_servicio(
    numero_de_orden int NOT NULL AUTO_INCREMENT,
    vehiculo varchar(6) NOT NULL,
    tipo_orden text NOT NULL,
    fecha date NOT NULL,
    PRIMARY KEY (numero_de_orden)
);

CREATE TABLE items_orden_de_servicio(
    id int NOT NULL AUTO_INCREMENT,
    ordenservicioid int NOT NULL,
    descripcion text NOT NULL,
    cantidad int NOT NULL,
    valor_unitario float NOT NULL,
    PRIMARY KEY (id)
);


INSERT INTO vehiculos (
    placa, 
    tipo_vehiculo, 
    kilometraje, 
    estado, 
    propietario
) 
VALUES
    ('ABC123', 'Automóvil', 50000, 'activo', 'Doctor Strange'),
    ('DEF456', 'Camión',    15000, 'activo', 'Viuda negra'),
    ('AAA11H', 'Moto',      1500,  'activo', 'Thor');

INSERT INTO orden_de_servicio (
    numero_de_orden, 
    vehiculo, 
    tipo_orden, 
    fecha
) 
VALUES
    (100001, 'ABC123', 'Correctivo', '2024-06-01'),
    (100002, 'DEF456', 'Preventivo', '2024-06-01'),
    (100003, 'ABC123', 'Correctivo', '2024-06-04'),
    (100004, 'AAA11H', 'Preventivo', '2024-06-12');

INSERT INTO items_orden_de_servicio (
    id,
    ordenservicioid, 
    descripcion, 
    cantidad, 
    valor_unitario
) 
VALUES
    (1, 100001,'Cambio de bujías', 12,  25000),
    (2, 100001,'Limpieza carter',   1, 130000),
    (3, 100002,'Lavado de motor',   3,  45000);