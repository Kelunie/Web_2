-- Creación de la base de datos de Agenda
create database agenda;

-- Coloca el foco en la nueva base de datos
use agenda;

-- Crea tabla de usuarios
create table usuarios(
	token varchar(8) not null primary key,
    nombre varchar(18) not null,
    apellidos varchar(25) not null,
    email varchar(50) unique not null,
    contra varchar(55) not null
) engine InnoDB, char set = utf8;    

-- Crea tabla de tareas a realizar
create table tareas(
	id int unsigned not null auto_increment primary key,
    token varchar(8) not null,
    descripcion varchar(500) not null,
    registrada timestamp default current_timestamp,
    estado char(1) not null
) engine InnoDB, char set = utf8;

-- Crea llaves foraneas para las tablas
alter table tareas add constraint fk_tarUsuario foreign key(token)
references usuarios(token);    
    
-- Crea la funcion que genera el Token
delimiter //
create function token()	returns varchar(8) deterministic
    begin
		declare salida varchar(8);
		set salida = (select rpad(cast(hex((timestampdiff(second,'1970-01-01 00:00:00',curtime()) *
                                            round(rand()*1000,0))/1000) as char),8,'0') as token);
        return salida;
	end//
delimiter ;

-- Crea procedimiento almacenado para insertar usuarios
delimiter //
create procedure insusuario(in nom   varchar(18), 
                            in apels varchar(25), 
                            in mail  varchar(50), 
                            in clave varchar(15))
	begin
		insert into usuarios(token,nombre,apellidos,email,contra)
        values(token(),nom,apels,mail,md5(clave));
    end//    
delimiter ;

-- Crea el procedimiento almacenado para insertar tareas
delimiter //
create procedure instarea(in token varchar(8), 
                          in tarea varchar(500))
	begin
		insert into tareas(token,descripcion,estado) values(token,tarea,'P');
    end//    
delimiter ;

-- Crea el procedimiento almacenado para modificar tareas
delimiter //
create procedure modtarea(in tok varchar(8), 
                          in ide int, 
                          in tarea varchar(500),
                          in est char(1))
	begin
		update tareas set descripcion = tarea , estado = est where token = tok and id = ide;
    end//    
delimiter ;

-- Crea el procedimiento almacenado para borrar tareas
delimiter //
create procedure bortarea(in tok varchar(8), 
                          in ide int)
	begin
		delete from tareas where token = tok and id = ide;
    end//    
delimiter ;
