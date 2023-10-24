drop DATABASE if EXISTS empleados;
create database empleados;
use empleados;

create table recursos (
	cod_recursos int primary key not null auto_INCREMENT, 
	nombre varchar(200) not null ,
	apellido varchar(200) not null,
	disponibilidad varchar(200)  not null,
	rol varchar(100) not null
);

create table proyecto(
	cod_proy int primary key not null auto_INCREMENT, 
	nombre varchar(200) not null,
	tipo varchar(200) not null,
	responsableCom varchar(200) not null,
	responsableGest varchar(200) not null,
	fecha_in_ideal date not null,
	fecha_in_real date not null,
	fecha_fin_ideal date not null,
	fecha_fin_real date not null,
	asigRecursos varchar(200) not null,
	horas_estimadas int not null	

);


create table jornada(
	cod_jornada int not null,
	codigo_recursos int not null,
	codigo_proyecto int not null,
	fecha date not null,
	horas int not null,
	FOREIGN KEY (codigo_recursos) REFERENCES recursos(cod_recursos),
	FOREIGN KEY (codigo_proyecto) REFERENCES proyecto(cod_proy)
);

CREATE TABLE tareas (
    tarea_id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(200) NOT NULL,
    descripcion TEXT NOT NULL,
    horas_requeridas INT NOT NULL,
    asignado_a INT,
    FOREIGN KEY (asignado_a) REFERENCES recursos(cod_recursos),
	id_proyecto INT, foreign key(id_proyecto) REFERENCES proyecto(cod_proy)
);

CREATE TABLE rec_proyec (
    codigo_recursos INT NOT NULL,
    codigo_proyecto INT NOT NULL,
    tarea_id INT NOT NULL,
    CONSTRAINT pk_rec_proyec PRIMARY KEY (codigo_recursos, codigo_proyecto),
    FOREIGN KEY (codigo_recursos) REFERENCES recursos(cod_recursos),
    FOREIGN KEY (codigo_proyecto) REFERENCES proyecto(cod_proy),
    FOREIGN KEY (tarea_id) REFERENCES tareas(tarea_id)
);

CREATE TABLE horas_trabajo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_recursos INT,
    codigo_proyecto INT,
    mes VARCHAR(255),
    horas_trabajadas DECIMAL(10, 2),
    FOREIGN KEY (codigo_recursos) REFERENCES recursos(cod_recursos),
    FOREIGN KEY (codigo_proyecto) REFERENCES proyecto(cod_proy)
);

