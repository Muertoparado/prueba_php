el siguiente codigo muestra la estructura de un crud basado en php en este caso, se realizo la base de datos la cual muestra a continuacion.



CREATE DATABASE campusland;

USE campusland;

CREATE TABLE pais(

idPais INT (10) NOT NULL PRIMARY KEY COMMENT 'ID PAIS LLAVE PRIMARIA',

nombrePais INT(10) COMMENT 'NOMBRE PAIS'

);



CREATE TABLE departamento(

idDep INT(10) NOT NULL PRIMARY KEY COMMENT 'ID DEPARTAMENTO',

nombreDep VARCHAR(50) COMMENT 'NOMBRE DEPARTAMENTO',

idPais INT(10) COMMENT 'ID TABLA PAIS'

);



CREATE TABLE region(

idReg INT(10) NOT NULL PRIMARY KEY COMMENT ' ID REGION ',

nombreReg VARCHAR(60) COMMENT 'NOMBRE REGION',

idDep INT(10) COMMENT 'ID DEPARTAMENTO'

);



CREATE TABLE campers(

idCamper VARCHAR(20) NOT NULL PRIMARY KEY COMMENT 'ID CAMPER',

nombreCamper VARCHAR(50) COMMENT 'NOMBRE CAMPER',

apellidoCamper VARCHAR(50) COMMENT 'APELLIDO CAMPER',

fechaNac DATETIME COMMENT 'FECHA NACIMIENTO',

idReg INT(10) COMMENT 'ID REGION'

);

ALTER TABLE departamento ADD CONSTRAINT nombreDep FOREIGN KEY (nombreDep) REFERENCES pais (idPais);

ALTER TABLE region ADD CONSTRAINT idDep FOREIGN KEY (idDep) REFERENCES departamento (idDep);

ALTER TABLE campers ADD CONSTRAINT idReg FOREIGN KEY (idReg) REFERENCE region (idReg);

al generar los join respectivos de las tablas se puede generar la conexion la cual se encuentra en la carpeta database,
mediante las rutas especificadas en routes/api.php  se basan en conectar con la tabla ( ...api/{nombre de la tabla }/{metodo})

/  get completo 

/add post

/delete/id  delete especifico id

/put/id  actualizar especifico id