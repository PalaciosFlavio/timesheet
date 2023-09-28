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

create table rec_proyec(
	codigo_recursos int not null,
	codigo_proyecto int not null,
	constraint pk_rec_proyec primary key (codigo_recursos, codigo_proyecto),
	FOREIGN KEY (codigo_recursos) REFERENCES recursos(cod_recursos),
	FOREIGN KEY (codigo_proyecto) REFERENCES proyecto(cod_proy)
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