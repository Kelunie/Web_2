-- Creancion de la base de datos lab5y6
create database lab5y6;

-- Colocamos el foco en la nueva base de datos
use lab5y6;

-- creamos la tabla usuario
CREATE TABLE usuarios (
    ID INT PRIMARY KEY,
    contraseña VARCHAR(50) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    correopersonal VARCHAR(255) NOT NULL,
    tipo_usuario INT NOT NULL
);

-- creamos la tabla empleados
CREATE TABLE empleados (
    ID INT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    FOREIGN KEY (ID) REFERENCES usuarios(ID)
);

-- creamos la tabla encomienda
CREATE TABLE encomienda (
    tracking_number VARCHAR(10) PRIMARY KEY,
    peso_kilogramos DECIMAL(10, 2) NOT NULL,
    quien_envia VARCHAR(255) NOT NULL,
    quien_recibe VARCHAR(255) NOT NULL,
    fecha_registro DATETIME NOT NULL,
    costo_reportado DECIMAL(10, 2) NOT NULL,
    costo_flete DECIMAL(10, 2) NOT NULL,
    empleado_generador INT,
    FOREIGN KEY (empleado_generador) REFERENCES empleados(ID)
) engine InnoDB, char set = utf8; 

-- creamos la tabla escalitas
CREATE TABLE escalitas (
    codigo VARCHAR(20) PRIMARY KEY,
    pais VARCHAR(255) NOT NULL,
    ciudad VARCHAR(255) NOT NULL
) engine InnoDB, char set = utf8;

-- creamos la tabla escala
CREATE TABLE escala (
    consecutivo INT PRIMARY KEY,
    tracking_number VARCHAR(20),
    codigo_escala VARCHAR(20),
    fecha_registro DATETIME NOT NULL,
    FOREIGN KEY (tracking_number) REFERENCES encomienda(tracking_number),
    FOREIGN KEY (codigo_escala) REFERENCES escalitas(codigo)
) engine InnoDB, char set = utf8;

-- funcion para general el tracking #
DELIMITER //
CREATE FUNCTION generar_tracking_number() RETURNS VARCHAR(10) DETERMINISTIC
BEGIN
    DECLARE salida VARCHAR(10);
    
    -- Generar un número de 10 dígitos único
    SET salida = (SELECT LPAD(FLOOR(RAND() * 10000000000), 10, '0'));
    
    RETURN salida;
END //
DELIMITER ;

-- creamos los procedimientos de almacenados

-- procedimiento de almacenado de usuarios
DELIMITER //
CREATE PROCEDURE ins_usuario(
    IN p_id INT,
    IN p_nom VARCHAR(50),
    IN p_apels VARCHAR(100),
    IN p_fecha_nacimiento DATE,
    IN p_correopersonal VARCHAR(255),
    IN p_tipo_usuario INT,
    IN p_clave VARCHAR(255)
)
BEGIN
    INSERT INTO usuarios(ID, contraseña, nombre, apellidos, fecha_nacimiento, correopersonal, tipo_usuario)
    VALUES (p_id, MD5(p_clave), p_nom, p_apels, p_fecha_nacimiento, p_correopersonal, p_tipo_usuario);
END //
DELIMITER ;


-- procedimiento de almacenado de empleados
DELIMITER //
CREATE PROCEDURE ins_empleado(
    IN nom VARCHAR(50),
    IN apels VARCHAR(100)
)
BEGIN
    INSERT INTO empleados(ID, nombre, apellidos)
    VALUES (NULL, nom, apels);
END //
DELIMITER ;

-- procedimiento de almacenado de encomienda
DELIMITER //
CREATE PROCEDURE ins_encomienda(
    IN peso DECIMAL(10, 2),
    IN quien_envia VARCHAR(255),
    IN quien_recibe VARCHAR(255),
    IN costo_reportado DECIMAL(10, 2),
    IN costo_flete DECIMAL(10, 2),
    IN empleado_generador INT
)
BEGIN
    INSERT INTO encomienda(tracking_number, peso_kilogramos, quien_envia, quien_recibe, fecha_registro, costo_reportado, costo_flete, empleado_generador)
    VALUES (generar_tracking_number(), peso, quien_envia, quien_recibe, NOW(), costo_reportado, costo_flete, empleado_generador);
END //
DELIMITER ;

-- procedimiento de almacenado de escalitas
DELIMITER //
CREATE PROCEDURE ins_escalita(
    IN pais VARCHAR(255),
    IN ciudad VARCHAR(255)
)
BEGIN
    INSERT INTO escalitas(codigo, pais, ciudad)
    VALUES (LPAD(FLOOR(RAND() * 10000000000), 10, '0'), pais, ciudad);
END //
DELIMITER ;

-- procedimiento de almacenado de escala
DELIMITER //
CREATE PROCEDURE ins_escala(
    IN tracking_number VARCHAR(20),
    IN codigo_escala VARCHAR(20)
)
BEGIN
    INSERT INTO escala(consecutivo, tracking_number, codigo_escala, fecha_registro)
    VALUES (NULL, tracking_number, codigo_escala, NOW());
END //
DELIMITER ;

select * from usuarios;