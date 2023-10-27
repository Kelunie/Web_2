create database lab4;

use lab4;

create table usuarios(
	id tinyint unsigned not null auto_increment,
	nombre varchar(45)  not null,
	contrasena varchar(80) not null,
	primary key (id)
)engine=innodb default charset=utf8 collate=utf8_bin;

CREATE TABLE blogs (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    usuario TINYINT UNSIGNED NOT NULL,
    fecha DATETIME NOT NULL,
    titulo varchar(50),
    contenido VARCHAR(500),
    imagen LONGBLOB,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario) REFERENCES usuarios(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE comentarios (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    blog_id INT UNSIGNED NOT NULL,
    usuario_id tinyint UNSIGNED NOT NULL,
    fecha DATETIME NOT NULL,
    contenido VARCHAR(500) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (blog_id) REFERENCES blogs(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

insert into usuarios(nombre,contrasena) values('Caleb',md5('culep1711'));
select * from usuarios;
INSERT INTO blogs (usuario, fecha, titulo, contenido, imagen)
VALUES (1, '2023-10-21 10:00:00', 'loid mejor personaje', 'Este es el contenido del blog', NULL);
INSERT INTO blogs (usuario, fecha, titulo, contenido, imagen)
VALUES (2, '2023-10-21 11:00:00', 'Gobling slayer', 'Uno de los mejores animes de temporada', NULL);

select * from usuarios;
select * from blogs where usuario = 2;
