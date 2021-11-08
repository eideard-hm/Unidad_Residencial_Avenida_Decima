DROP DATABASE IF EXISTS PROYECTO_CONJUNTO_RESIDENCIAL;
create database PROYECTO_CONJUNTO_RESIDENCIAL;/*creación de la base de datos*/
use PROYECTO_CONJUNTO_RESIDENCIAL;/*usando la base de datos*/

create table ADMINISTRADOR/*creando la tabla*/
(
id int auto_increment PRIMARY KEY not null,/*campo de la tabla*/
correo varchar (50) not null,/*campo de la tabla*/
passwordU varchar (80) not null,/*campo de la tabla*/
nombres varchar (30) not null,/*campo de la tabla*/
apellidos varchar (30) not null,/*campo de la tabla*/
tipoDocumento varchar (30) not null,/*campo de la tabla*/
numDocumento varchar (10) not null,/*campo de la tabla*/
telefono varchar (10) not null,/*campo de la tabla*/
estado varchar (20) not null, /*campo de la tabla*/
tipoUsuario int not null /*campo de la tabla*/
);

create table RESIDENTE
(
id int auto_increment PRIMARY KEY not null,
correo varchar (50) not null,
passwordU varchar (80) not null,
nombres varchar (30) not null,
apellidos varchar (30) not null,
tipoDocumento varchar (30) not null,
numDocumento varchar (10) not null,
telefono varchar (10) not null,
telFijo int not null,
numTorre varchar (1) not null,
numBloque varchar (1) not null,
numApartamento varchar (3) not null,
estado varchar (20) not null, /*campo de la tabla*/
tipoUsuario int not null /*campo de la tabla*/
);

create table GUARDA_SEGURIDAD
(
id int auto_increment PRIMARY KEY not null, /*campo de la tabla*/
correo varchar (50) not null,/*campo de la tabla*/
passwordU varchar (80) not null,/*campo de la tabla*/
nombres varchar (30) not null,/*campo de la tabla*/
apellidos varchar (30) not null,/*campo de la tabla*/
tipoDocumento varchar (30) not null,/*campo de la tabla*/
numDocumento varchar (10) not null,/*campo de la tabla*/
telefono varchar (10) not null,/*campo de la tabla*/
estado varchar (20) not null, /*campo de la tabla*/
tipoUsuario int not null, /*campo de la tabla*/
idAdministradorFK int/*campo de la tabla*/
);

create table EMPLEADO
(
idEmpleado int auto_increment PRIMARY KEY not null,/*campo de la tabla*/
nombresEmpleado varchar (30) not null,/*campo de la tabla*/
apellidosEmpleado varchar (30) not null,/*campo de la tabla*/
tipoDocumentoEmpleado varchar (30) not null,/*campo de la tabla*/
numDocumentoEmpleado int not null,/*campo de la tabla*/
telefonoEmpleado int not null,/*campo de la tabla*/
cargoEmpleado varchar (30) not null,/*campo de la tabla*/
ARLEmpleado varchar (30) not null,/*campo de la tabla*/
estadoEmpleado varchar (20) not null, /*campo de la tabla*/
idAdministradorFK int /*campo de la tabla*/
);

create table PARQUEADERO
(
idParqueadero int auto_increment PRIMARY KEY not null,/*campo de la tabla*/
usoParqueadero varchar (8) not null,/*campo de la tabla*/
estadoParqueadero varchar (13) not null,/*campo de la tabla*/
tipoParqueadero varchar (15) not null,/*campo de la tabla*/
idResidenteFK int,/*campo de la tabla*/
idAdministradorFK int,/*campo de la tabla*/
idVehiculoFK int/*campo de la tabla*/
);

create table VEHICULO
(
idVehiculo int PRIMARY KEY auto_increment, 
placaVehiculo varchar  (6) not null,/*campo de la tabla*/
modeloVehiculo year not null,/*campo de la tabla*/
marcaVehiculo varchar (15) not null,/*campo de la tabla*/
colorVehiculo varchar (15) not null,/*campo de la tabla*/
tipoVehiculo varchar (7) not null/*campo de la tabla*/
);

create table CUENTACOBRO
(
idCuenta int auto_increment PRIMARY KEY not null,/*campo de la tabla*/ 
fechaExpideCuenta date not null,/*campo de la tabla*/
fechaVencimientoPago date not null,/*campo de la tabla*/
estadoCuenta varchar (20) not null,/*campo de la tabla*/
periodoCuenta varchar (40) not null,/*campo de la tabla*/
fechaPagoOportuno date not null,/*campo de la tabla*/
fechaConsignacion date not null,/*campo de la tabla*/
valorPagoCuenta decimal not null,/*campo de la tabla*/
idResidenteFK int,/*campo de la tabla*/
idAdministradorFK int/*campo de la tabla*/
);

create table ANUNCIO
(
idAnuncio int auto_increment PRIMARY KEY not null,/*campo de la tabla*/
tituloAnuncio varchar (30) not null,/*campo de la tabla*/
cuerpoAnuncio varchar (200) not null,/*campo de la tabla*/
fechaInicioAnuncio date not null,/*campo de la tabla*/
fechaFinAnuncio date not null, /*campo de la tabla*/
imagenAnuncio blob not null,/*campo de la tabla*/
estadoAnuncio varchar (20) not null, /*campo de la tabla*/
idAdministradorFK int,/*campo de la tabla*/
idResidenteFK int/*campo de la tabla*/
);

create table DETALLECUENTA
(
idDetalleCuenta int auto_increment PRIMARY KEY not null,/*campo de la tabla*/
idRubroFK int,/*campo de la tabla*/
idCuentaFK int/*campo de la tabla*/
);

create table RUBRO
(
idRubro int auto_increment PRIMARY KEY not null,/*campo de la tabla*/
nombreRubro varchar (30) not null,/*campo de la tabla*/
descripcionRubro varchar (200) not null,/*campo de la tabla*/
valorRubro decimal  not null,/*campo de la tabla*/
estadoRubro varchar (20) not null /*campo de la tabla*/
);

create table VISITANTE_GUARDA
(
idVisitanteGuarda int auto_increment PRIMARY KEY not null,/*campo de la tabla*/
idGuardaFK int,/*campo de la tabla*/
idVisitanteFK int/*campo de la tabla*/
);

create table VISITANTE
(
idVisitante int auto_increment PRIMARY KEY not null,/*campo de la tabla*/
nombreVisitante varchar (30) not null,/*campo de la tabla*/
apellidoVisitante varchar (30) not null,/*campo de la tabla*/
tipoDocumentoVisitante varchar (30) not null,/*campo de la tabla*/
numeroDocumentoVisitante int not null,/*campo de la tabla*/
numTorreDirige varchar (1) not null,/*campo de la tabla*/
numBloqueDirige varchar (1) not null,/*campo de la tabla*/
numApartamentoDirige varchar (3) not null,/*campo de la tabla*/
fechaIngresoVisitante date not null,/*campo de la tabla*/
horaIngresoVisitante time not null,/*campo de la tabla*/
fechaSalidaVisitante date not null,/*campo de la tabla*/
horaSalidaVisitante time not null,/*campo de la tabla*/
estadoVisitante varchar (20) not null,
idResidenteFK int/*campo de la tabla*/
);

/*Realizando las alteraciones de las tablas-ALTER TABLE*/
ALTER TABLE CUENTACOBRO ADD CONSTRAINT FKidAdministrador FOREIGN KEY (idAdministradorFK) REFERENCES ADMINISTRADOR (id);
ALTER TABLE CUENTACOBRO ADD CONSTRAINT FOREIGN KEY (idResidenteFK) REFERENCES RESIDENTE (id);
ALTER TABLE DETALLECUENTA ADD CONSTRAINT FKidCuenta FOREIGN KEY (idCuentaFK) REFERENCES CUENTACOBRO (idCuenta);
ALTER TABLE DETALLECUENTA ADD CONSTRAINT FKidRubro FOREIGN KEY (idRubroFK) REFERENCES RUBRO (idRubro);
ALTER TABLE PARQUEADERO ADD CONSTRAINT FKidResidente1 FOREIGN KEY (idResidenteFK) REFERENCES RESIDENTE (id);
ALTER TABLE PARQUEADERO ADD CONSTRAINT FKidAdministrador1 FOREIGN KEY (idAdministradorFK) REFERENCES ADMINISTRADOR (id);
ALTER TABLE PARQUEADERO ADD CONSTRAINT FKidVehiculo1 FOREIGN KEY (idVehiculoFK) REFERENCES VEHICULO (idVehiculo);
ALTER TABLE VISITANTE ADD CONSTRAINT FKidResidente2 FOREIGN KEY (idResidenteFK) REFERENCES RESIDENTE (id);
ALTER TABLE EMPLEADO ADD CONSTRAINT FKidAdministrador2 FOREIGN KEY (idAdministradorFK) REFERENCES ADMINISTRADOR (id);
ALTER TABLE GUARDA_SEGURIDAD ADD CONSTRAINT FKidAdministrador3 FOREIGN KEY (idAdministradorFK) REFERENCES ADMINISTRADOR (id);
ALTER TABLE VISITANTE_GUARDA ADD CONSTRAINT FKidGuarda FOREIGN KEY (idGuardaFK) REFERENCES GUARDA_SEGURIDAD (id);
ALTER TABLE VISITANTE_GUARDA ADD CONSTRAINT FKidVisitante FOREIGN KEY (idVisitanteFK) REFERENCES VISITANTE (idVisitante);
ALTER TABLE ANUNCIO ADD CONSTRAINT FKidAdministrador4 FOREIGN KEY (idAdministradorFK) REFERENCES ADMINISTRADOR (id);
ALTER TABLE ANUNCIO ADD CONSTRAINT FKidResidente3 FOREIGN KEY (idResidenteFK) REFERENCES RESIDENTE (id);

/*TALLER PROYECTO SENTENCIAS DML*/
/*Registro del usuario Administrador*/

INSERT INTO ADMINISTRADOR (id, correo, passwordU, nombres, apellidos, tipoDocumento, numDocumento, 
telefono, estado, tipoUsuario) VALUES
('', 'edierhernandezmo@gmail.com', 12345, 'Edier Heraldo', 'Hernandez Molano', 'Tarjeta de Identidad',1055550018,
3134387765, 'Activo', 0);
INSERT INTO ADMINISTRADOR (id, correo, passwordU, nombres, apellidos, tipoDocumento, numDocumento, 
telefono, estado, tipoUsuario) VALUES
('', 'unidadresidencialavenidadecima@gmail.com', 'admin1', 'Roger', 'Martinez', 'Cédula de Ciudadania',123456789,
31245677988, 'Activo', 0);
INSERT INTO ADMINISTRADOR (id, correo, passwordU, nombres, apellidos, tipoDocumento, numDocumento, 
telefono, estado, tipoUsuario) VALUES
('', 'ednajudith@gmail.com', 'judithm', 'Edna Judith', 'Molano Mahecha', 'Cédula de Ciudadania',106239887,
3132069129, 'Activo',0);

/*Registro del usuario Residente*/
INSERT INTO RESIDENTE (id, correo, passwordU, nombres, apellidos, tipoDocumento, numDocumento, telefono,
telFijo,numTorre, numBloque,numApartamento, estado,tipoUsuario) VALUES
('', 'javihernandez@gmail.com', 'javi','Javier','Hernandez Arias', 'Cédula de Ciudadania', 123487432, 3108816708,
1234567, 4,1,502,'Activo',1);
INSERT INTO RESIDENTE (id, correo, passwordU, nombres, apellidos, tipoDocumento, numDocumento, telefono,
telFijo,numTorre, numBloque,numApartamento, estado,tipoUsuario) VALUES
('', 'marlonjavier@gmail.com', 'marlon12','Marlon Javier','Hernandez Molano','Cédula de Ciudadania',10887654,312455666,
9876543,5,2,302,'Inactivo',1);
INSERT INTO RESIDENTE (id, correo, passwordU, nombres, apellidos, tipoDocumento, numDocumento, telefono,
telFijo,numTorre, numBloque,numApartamento, estado,tipoUsuario) VALUES
('', 'vane2013@gmail.com', 'vane123','Lincy Vanessa','Hernandez Molano','Cédula de Ciudadania',105555933,3143445567,
7654321,1,2,202,'Inactivo',1);
INSERT INTO RESIDENTE (id, correo, passwordU, nombres, apellidos, tipoDocumento, numDocumento, telefono,
telFijo,numTorre, numBloque,numApartamento, estado,tipoUsuario) VALUES
('', 'ananavarrete@gmail.com', 'anitela','Ana Delina','Navarrete Arias','Cédula de Ciudadania',563445898,3115069281,
7893456,8,2,401,'Inactivo',1);

/*Registro del usuario Guarda de Seguridad*/
INSERT INTO GUARDA_SEGURIDAD (id, correo,passwordU,nombres,apellidos, tipoDocumento,
numDocumento, telefono, estado,tipoUsuario, idAdministradorFK) VALUES
('', 'jesondanilo@gmail.com','dani123', 'Jeison Danilo', 'Hernandez Molano', 'Cédula de Ciudadania', 10555578876,
312345667 ,'Inactivo', 2, 2);
INSERT INTO GUARDA_SEGURIDAD (id, correo,passwordU,nombres,apellidos, tipoDocumento,
numDocumento, telefono, estado,tipoUsuario, idAdministradorFK) VALUES
('', 'mayemolano@gmail.com','mayecita', 'Mayerli', 'Molano Mahecha', 'Cédula de Ciudadania',12386886655,
31345677544 ,'Activo', 2, 2);
INSERT INTO GUARDA_SEGURIDAD (id, correo,passwordU,nombres,apellidos, tipoDocumento,
numDocumento, telefono, estado,tipoUsuario, idAdministradorFK) VALUES
('', 'julianalexis@gmail.com','alexis', 'Julian Alexis', 'Hernandez Molano', 'Cédula de Ciudadania',1055550019,
3227721718,'Activo',  2, 2);

/*realizando inserciones en la tabla EMPLEADO*/
INSERT INTO EMPLEADO (idEmpleado, nombresEmpleado, apellidosEmpleado, tipoDocumentoEmpleado, numDocumentoEmpleado, telefonoEmpleado, cargoEmpleado, ARLEmpleado, idAdministradorFK)
VALUES ('', 'Miguel Angel', 'Montoya Delgado', 'Cédula de ciudadanía', 66559586, 1596950, 'Servicios Generales', 'Sura', 1),
('', 'Johan Santiago', 'Sanchez Angulo', 'Cédula de ciudadanía', 1325076, 9356961, 'Servicios generales', 'Positiva', 2),
('', 'Cristian Camilo', 'Alarcón Medina', 'Cédula de ciudadanía', 8487274, 4263931, 'Contador', 'Axa Colpatria', 3),
('', 'Adrian', 'Tomy Salazar', 'Cédula de ciudadanía', 7506351, 6407101, 'Servicios generales', 'Colmena', 1),
('', 'Camila Alejandra', 'Ruiz Arias', 'Cédula de ciudadanía', 7984489, 8144897, 'Contadora', 'Bolivar', 2);

/*realizando inserciones en la tabla VEHICULO*/
INSERT INTO VEHICULO (placaVehiculo, modeloVehiculo, marcaVehiculo, colorVehiculo, tipoVehiculo)
VALUES ('JICS', '2020', 'Spark GT Active', 'Negro', 'Carro'),
('7ETR', '2021', 'Bajaj Pulsar Ns', 'Negro y amarillo', 'Moto'),
('0AC6', '2020', 'Pulsar Ns 200', 'Negro y rojo', 'Moto'),
('SXFP', '2021', 'Duster Zen', 'Plateado', 'Carro'),
('CHYK', '2021', 'Renault Sandero', 'Plateado', 'Carro');


/*realizando inserciones en la tabla PARQUEADER0*/
INSERT INTO PARQUEADERO (idParqueadero, usoParqueadero, estadoParqueadero, tipoParqueadero, idResidenteFK, idAdministradorFK, idVehiculoFK)
VALUES ('', 'Carro', 'Ocupado', 'Privado', 3, 1, '1'),
('', 'Moto', 'Disponible', 'Comunitario', 2, 2, '2'),
('', 'Moto', 'Ocupado', 'Privado', 1, 3, '1'),
('', 'Carro', 'Ocupado', 'Comunitario', 4, 1, '2'),
('', 'Carro', 'Ocupado', 'Privado', 2, 2, '1');

/*realizando inserciones en la tabla ANUNCIO*/
INSERT INTO ANUNCIO (idAnuncio, tituloAnuncio, cuerpoAnuncio, fechaInicioAnuncio, fechaFinAnuncio, imagenAnuncio, idAdministradorFK, idResidenteFK)
VALUES ('', 'The 1975', 'Somebody else', 2020-07-14, 2020-07-15, 'song.png', 1, 3),
('', 'Receta', 'En mi casa te enseñamos cómo hacer arepas de chócolo', 2020-07-15, 2020-07-16, 'arepa.png', 2, 2),
('', 'Curso', 'Curso de fotografía el día viernes, inscripciones en el apto 100', 2020-07-17, 2020-07-18, 'foto.png', 3, 1),
('', 'Xbox', 'Se alquila xbox por días', 2020-07-19, 2020-07-20, 'xbox.png', 1, 4),
('', 'Club literario', 'Club literario en el salón comunal cada tarde', 2020-07-21, 2020-07-30, 'book.png', 1, 1);

/*realizando inserciones en la tabla RUBRO*/
INSERT INTO RUBRO (idRubro, nombreRubro, descripcionRubro, valorRubro, estadoRubro)
VALUES ('', 'Administracion', 'Pago de la administración', 50000, 'Activo'),
('', 'Mantenimiento', 'Pago mantenimiento parques', 10000, 'Activo'),
('', 'Comunitario', 'Pago voluntario actividades recreativas', 12000, 'Activo'),
('', 'Administracion', 'Pago de la administración', 50000, 'Activo'),
('', 'Administracion', 'Pago de la administración', 50000, 'Activo');

/*realizando inserciones en la tabla VISITANTE*/
INSERT INTO VISITANTE (idVisitante, nombreVisitante, apellidoVisitante, tipoDocumentoVisitante, numeroDocumentoVisitante,
numTorreDirige, numBloqueDirige, numApartamentoDirige, fechaIngresoVisitante, horaIngresoVisitante, 
fechaSalidaVisitante, estadoVisitante, horaSalidaVisitante, 
idResidenteFK)
VALUES ('', 'Sergio', 'Sanchez Ortega', 'Cédula de ciudadanía', 2936370098, 1, 3, 200, 2020-07-14, '11:39', 2020-07-14, '23:39','Activo', 3),
('', 'Juan', 'Morales', 'Cedula de ciudadanía', 7919383166, 2, 3, 149, 2020-07-14, '19:12', 2020-07-15, '18:21', 'Activo',2),
('', 'Nicolas', 'Pachecho Morales', 'Tarjeta de identidad', 2992566722, 3, 2, 401, 2020-07-14, '16:54', 2020-07-15, '11:19','Activo', 1),
('', 'Valeria', 'Castillo', 'Cédula de ciudadanía', 5609492597, 1, 1, 502, 2020-07-14, '19:53', 2020-07-16, '12:53', 'Activo',4);

/*insetando datos en la tabla cuenta de cobro*/
INSERT INTO CUENTACOBRO (idCuenta , fechaExpideCuenta ,fechaVencimientoPago,estadoCuenta,
periodoCuenta, fechaPagoOportuno,fechaConsignacion, valorPagoCuenta,idResidenteFK,idAdministradorFK)
VALUES ('', '2020-01-30', '2020-02-30', 'Pendiente', '2020-02', '2020-01-20', '2020-01-20', 165000, 1, 2);
INSERT INTO CUENTACOBRO (idCuenta , fechaExpideCuenta ,fechaVencimientoPago,estadoCuenta,
periodoCuenta, fechaPagoOportuno,fechaConsignacion, valorPagoCuenta,idResidenteFK,idAdministradorFK)
VALUES ('', '2020-02-30', '2020-03-30', 'Cancelado', '2020-03', '2020-02-20', '2020-02-24', 180000, 2, 2);
INSERT INTO CUENTACOBRO (idCuenta , fechaExpideCuenta ,fechaVencimientoPago,estadoCuenta,
periodoCuenta, fechaPagoOportuno,fechaConsignacion, valorPagoCuenta,idResidenteFK,idAdministradorFK)
VALUES ('', '2020-03-30', '2020-04-30', 'Parcial', '2020-03', '2020-03-20', '2020-03-20',17000, 3, 2);

/*realizando inserciones en la tabla DEBIL DETALLE CUENTA*/
INSERT INTO DETALLECUENTA (idDetalleCuenta, idRubroFK, idCuentaFK)
VALUES ('', '1', 1),
('', '2', 2),
('', '3', 3),
('', '4', 1),
('', '5', 2);

/*realizando inserciones en la tabla DEBIL VISITANTE_GUARDA*/
INSERT INTO VISITANTE_GUARDA (idVisitanteGuarda, idGuardaFK, idVisitanteFK)
VALUES ('', 1, '1'),
('', 2, '2'),
('', 3, '3'),
('', 1, '4');

/*2.Reemplace 5 registros mediante sentencia(Replace).*/

/*3.Realice 5 consultas generales y 15 especificas empleabdo la clausula (where).*/
/*Consultas generales*/
SELECT id, nombres FROM ADMINISTRADOR WHERE nombres='Edier Heraldo';
SELECT * FROM RESIDENTE WHERE numDocumento=10887654;
SELECT * FROM GUARDA_SEGURIDAD WHERE id=2;
SELECT * FROM ADMINISTRADOR WHERE nombres LIKE '%a%';
/*Consultas especificas*/
SELECT id AS ID_ADMINISTRADOR, nombres AS NOMBRES FROM ADMINISTRADOR WHERE 
numDocumento=106239887 and id=3;
SELECT id AS ID_RESIDENTE, nombres AS NOMBRES_RESIDENTE FROM RESIDENTE WHERE nombres
LIKE '%J%' ORDER BY nombres ASC;
SELECT COUNT(*) AS N°_ADMINISTRADORES_REGISTRADOS FROM ADMINISTRADOR;
SELECT COUNT(*) AS N°_RESIDENTES_REGISTRADOS FROM RESIDENTE;  
SELECT COUNT(*)AS N°_GUARDAS_DE_SEGURIDAD_REGISTRADOS FROM GUARDA_SEGURIDAD;  
SELECT id AS ID, nombres AS NOMBRES, numDocumento AS NÚMERO_DOCUMENTO FROM RESIDENTE 
WHERE numApartamento=401;
SELECT id AS ID, nombres AS NOMBRES,apellidos AS APELLIDOS_RESIDENTE, numDocumento
AS NÚMERO_DOCUMENTO FROM RESIDENTE WHERE apellidos='Hernandez Molano';

/*4.Realice 7 consultas empleando operadores relaciones y logicos. Según aplique.*/
SELECT id AS ID_ADMINISTRADOR, nombres AS NOMBRES FROM ADMINISTRADOR WHERE 
numDocumento=106239887 and id=6;
SELECT id AS ID_ADMINISTRADOR, nombres AS NOMBRES FROM ADMINISTRADOR WHERE id>=1;
SELECT id AS ID_RESIDENTE, nombres AS NOMBRES_RESIDENTE FROM RESIDENTE WHERE nombres
LIKE '%J%' OR telefono=3108816708 ORDER BY nombres ASC;
SELECT id AS ID_RESIDENTE, nombres AS NOMBRES_RESIDENTE FROM RESIDENTE WHERE id<=3 ORDER BY nombres ASC;
SELECT id AS ID_ADMINISRADOR, nombres AS NOMBRES_ADMINISTRADOR, numDocumento
AS NÚMERO_DOCUMENTO_ADMINISTRADOR FROM ADMINISTRADOR WHERE id=2 AND numDocumento=123456789
ORDER BY id DESC;
SELECT id AS ID, nombres AS NOMBRES, numDocumento AS NÚMERO_DOCUMENTO FROM RESIDENTE 
WHERE numApartamento<>401;
SELECT id AS ID, nombres AS NOMBRES,apellidos AS APELLIDOS_RESIDENTE, numDocumento
AS NÚMERO_DOCUMENTO FROM RESIDENTE WHERE apellidos<>'Hernandez Molano' ORDER BY nombres DESC;

/*5.Realice 3 consultas de columnas calculadas. Según aplique.*/
/*Para realizar este ejercicio voy a realizar unas inserciones en la tabla cuents de cobro, porque aqui me es facil
realizar las colunas calculadas*/

/*COLUMNAS CALCULADAS*/
/*DESCUENTO DEL 25%*/
SELECT idCuenta, fechaExpideCuenta,estadoCuenta,valorPagoCuenta, valorPagoCuenta-(valorPagoCuenta*25/100) AS VALOR_CON_DESCUENTO
FROM CUENTACOBRO WHERE idCuenta=1;
/*AUMENTAR EL VALOR DE PAGO EN UN 50%*/
SELECT idCuenta, fechaExpideCuenta,estadoCuenta,valorPagoCuenta, valorPagoCuenta+(valorPagoCuenta*50/100) AS VALOR_CON_AUMENTO
FROM CUENTACOBRO WHERE idCuenta=2;
/*SUMARLE 20000 AL VALOR DE PAGO*/
SELECT idCuenta, fechaExpideCuenta,estadoCuenta,valorPagoCuenta, valorPagoCuenta+10000 AS VALOR_CON_AUMENTO_DE_10000
FROM CUENTACOBRO WHERE idCuenta=3;
/*6.Realice 3 consultas empleando busqueda de patrones (like y not like). Según aplique.*/
SELECT id AS ID_ADMIN, nombres AS NOMBRES_ADMIN FROM ADMINISTRADOR WHERE nombres
LIKE '%E%' ORDER BY nombres ASC;
SELECT idResidente AS ID_RESIDENTE, nombres AS NOMBRES_RESIDENTE FROM RESIDENTE WHERE nombres
LIKE '%A%' ORDER BY nombres ASC;
SELECT id AS ID_GUARDA, nombresGuarda AS NOMBRES_GUARDA, apellidos AS APELLIDOS_GURDA FROM GUARDA_SEGURIDAD WHERE
apellidos LIKE '%M%' ORDER BY apellidos ASC;

/*7.Realice 5 consultas empleando la clausula (having).*/
SELECT id AS ID_ADMINISTRADOR, nombres AS NOMBRE_ADMINISTRADOR,numDocumento AS N°_DOCUMENTO_ADMINISTRADOR
FROM ADMINISTRADOR WHERE id>1 GROUP BY tipoDocumento HAVING tipoDocumento='Cédula de Ciudadania';
SELECT id AS ID_ADMINISTRADOR, nombres AS NOMBRE_ADMINISTRADOR,numDocumento AS N°_DOCUMENTO_ADMINISTRADOR
FROM ADMINISTRADOR WHERE id<>3 GROUP BY apellidos HAVING apellidos LIKE '%A%';
SELECT id AS ID_RESIDENTE, nombres AS NOMBRE_RESIDENTE FROM RESIDENTE WHERE 
id<>0;
SELECT id AS ID_GUARDA, nombres AS NOMBRE_GUARDA, numDocumento AS N°_DOCUMENTO_GUARDA FROM 
GUARDA_SEGURIDAD WHERE id<>2 GROUP BY apellidos HAVING apellidos NOT LIKE '%C%';
SELECT id AS ID_GUARDA, nombres AS NOMBRE_GUARDA, numDocumento AS N°_DOCUMENTO_GUARDA FROM 
GUARDA_SEGURIDAD WHERE id<>1 GROUP BY nombres HAVING nombres NOT LIKE '%R%';

/*8.Realiece 5 consultas por agrupamiento de registros (GroupBy).*/
SELECT id AS ID_ADMIN, nombres AS NOMBRES_ADMIN FROM ADMINISTRADOR GROUP BY
tipoDocumento;
SELECT id AS ID_RESIDENTE, nombres AS NOMBRES_RESIDENTE FROM RESIDENTE;
SELECT id AS ID_GUARDA, nombres AS NOMBRES_GUARDA, apellidos AS APELLIDOS_GUARDA FROM 
GUARDA_SEGURIDAD GROUP BY apellidos;
SELECT id AS ID_ADMIN, nombres AS NOMBRES_ADMIN, numDocumento FROM ADMINISTRADOR 
GROUP BY numDocumento;
SELECT id AS ID_GUARDA, nombres AS NOMBRES_GUARDA FROM GUARDA_SEGURIDAD GROUP BY id;

/*9.Actualice 10 de los 25 datos ingresados.*/
UPDATE ADMINISTRADOR SET correo='judicitalamejormama@gmail.com' WHERE id=3; 
UPDATE ADMINISTRADOR SET nombres='Melanie Alejandra' WHERE id=1; 
UPDATE ADMINISTRADOR SET passwordU=12345678, numDocumento=1055550018 WHERE id=1; 
UPDATE RESIDENTE SET nombres='Vanessa' WHERE id=1; 
UPDATE GUARDA_SEGURIDAD SET passwordU='MayeM' WHERE id=2; 

/*10.Elimine 5 registros.*/
DELETE FROM CUENTACOBRO WHERE idCuenta=1;
DELETE FROM CUENTACOBRO WHERE idCuenta=2;
DELETE FROM CUENTACOBRO WHERE idCuenta=3;
DELETE FROM ADMINISTRADOR WHERE idAdministrador=1;
DELETE FROM RESIDENTE WHERE idResidente=3;
DELETE FROM GUARDA_SEGURIDAD  WHERE idGuarda=2;
DELETE FROM GUARDA_SEGURIDAD WHERE idGuarda=1;
DELETE FROM ADMINISTRADOR WHERE idAdministrador=3;

/*11.Ordene los datos en forma ascendente.(OrderBy ) según el criterio que aplique.*/
SELECT * FROM ADMINISTRADOR ORDER BY id ASC;
SELECT * FROM RESIDENTE ORDER BY id ASC;
SELECT * FROM GUARDA_SEGURIDAD ORDER BY id ASC;

/*<-------------------CONSULTAS MULTITABLAS-------------------------->*/

/*Se desea consultar el detalle de cuenta, el nombre, la descripción, el valor del rubro, y la fecha en 
que se expide la cuenta*/

SELECT idDetalleCuenta, nombreRubro, descripcionRubro, fechaExpideCuenta FROM CUENTACOBRO AS cc INNER JOIN
DETALLECUENTA AS dc ON cc.idCuenta= dc.idCuentaFK INNER JOIN RUBRO AS r ON
r.idRubro=dc.idRubroFK;

/*Se desea consultar el nombre, número de documento del Guarda de seguridad ha registrado el ingreso de los
 visitantes número de documento, nombre,fecha y hora de ingresos y de salida, ademá se desea conocer 
 que administrador registro ese guarda de seguridad , su nombre y número de documento */
 
 /*-------------------------------------------VISTAS PROYECTO--------------------------------*/

/*Mostrar la vista de el detalle de cuenta, el nombre, la descripción, el valor del rubro, y la fecha en 
que se expide la cuenta*/

CREATE VIEW CuentasCobroResid AS

SELECT idDetalleCuenta as DetalleCuenta, nombreRubro as NombreRubro, descripcionRubro as Descripción, fechaExpideCuenta as ExpediciónCuenta
FROM CUENTACOBRO AS cc INNER JOIN
DETALLECUENTA AS dc ON cc.idCuenta= dc.idCuentaFK INNER JOIN RUBRO AS r ON
r.idRubro=dc.idRubroFK;

/*crear la vista donde se consulte el id y nombre completo del visitante con el id y nombre completo del residente 
relacionado */
 
 CREATE VIEW Visitante_Residente AS 
 select idVisitante as IDVisitante, nombreVisitante as NombreVisitante, apellidoVisitante as ApellidoVisitante, id as IDResidente, nombres as NombreResidente, apellidos as ApellidosResidente
 from Visitante AS Visitante INNER JOIN Residente AS Residente
 ON Residente.id= Visitante.idResidenteFK;
 
 /*Crear la vista el id, y nombres completos del residente junto con el id, título y cuerpo del anuncio que
 publica*/
 
 CREATE VIEW Residente_Anuncio AS
 
 select id as IDResidente, nombres as NombreResidente, apellidos as ApellidoResidente, idAnuncio as IDAnuncio, tituloAnuncio as TituloAnuncio, cuerpoAnuncio as CuerpoAnuncio
 from Anuncio AS Anuncios INNER JOIN Residente AS Residente
 ON Residente.id = AnuncioS. idResidenteFK;
 
 /*Mostrar la vista de la consulta el nombre completo del administrador, su número de documento, y
 también mostrar al empleado al que registro*/
 
 CREATE VIEW Admin_Empleado AS
 SELECT nombres as Nombre, apellidos as ApellidoAdministración, numDocumento as DocumentoAdministrador, 
 nombresEmpleado as NombreEmpleado, apellidosEmpleado as ApellidosEmpleado, numDocumentoEmpleado as 
 DocumentoEmpleado, cargoEmpleado as CargoEmpleado
 from Empleado AS Empleados INNER JOIN Administrador AS Administrador
 ON Administrador.id = Empleados.idAdministradorFK;
 
 /*Mostrar la vista de la consulta del id y nombre completo del visitante con el id y nombre completo del residente relacionado */
 
 CREATE VIEW VisitanteResidente AS
 
 select idVisitante as IDVisitante, nombreVisitante as NombreVisitante, apellidoVisitante as ApellidoVisitante,
 id as IDResidente, nombres as NombreResidente, apellidos as ApellidosResidente
 from Visitante AS Visitante INNER JOIN Residente AS Residente ON Residente.id= Visitante.idResidenteFK;
 
 /*Realizar una vista donde al total del pago se le saque el 25%*/

CREATE VIEW Descuento_CuentaCobro AS

SELECT idCuenta, fechaExpideCuenta,estadoCuenta,valorPagoCuenta, valorPagoCuenta-(valorPagoCuenta*25/100) AS VALOR_CON_DESCUENTO
FROM CUENTACOBRO WHERE idCuenta=1;

/*--------------------------CONSULTAR LAS VISTAS-----------------------------*/

SELECT * FROM AdminParqueaderosResidente;
SELECT * FROM CuentasCobroResid;
SELECT * FROM Visitante_Residente;
SELECT * FROM Residente_Anuncio;
SELECT * FROM Admin_Empleado;
SELECT * FROM Visitantes_Guardas_Admin;
SELECT * FROM VisitanteResidente;
SELECT * FROM Descuento_CuentaCobro;

CREATE VIEW EDIER AS
SELECT * FROM ADMINISTRADOR;

/*----------------------------------------CREAR PROCEDIMIENTOS DE ALMACENADO--------------------------------------*/

/*--------------------------------------ADMINISTRADOR------------------------------------*/

/*--------------------------------ADMINISTRADOR-----------------------*/

/*PROCEDIMIENTO PARA INSERTAR ADMINISTRADOR*/
DELIMITER $$
CREATE PROCEDURE insertAdmin
(
Pid varchar (15),
Pcorreo varchar (50),
PpasswordU varchar (8),
Pnombres varchar (30),
Papellidos varchar (30),
PtipoDocumento varchar (30),
PnumDocumento varchar (10),
Ptelefono varchar (10),
Pestado varchar (20),
PtipoUsuario int
)
BEGIN
INSERT INTO ADMINISTRADOR (id, correo, passwordU, nombres,
apellidos, tipoDocumento, numDocumento, telefono, estado, tipoUsuario)

VALUES (Pid, Pcorreo, PpasswordU, Pnombres, Papellidos,
PtipoDocumento, PnumDocumento, Ptelefono, Pestado,
PtipoUsuario);
END$$

CALL insertAdmin('', 'edierhernandezmo@gmail.com', 12345, 'Edier Heraldo', 'Hernandez Molano', 
'Tarjeta de Identidad',1055550018, 3134387765, 'Activo', 0);

/*PRCEDIMIENTO PARA CONSULTAR ADMINISTADOR*/
DELIMITER $$
CREATE PROCEDURE selectAdmin
(
PidAdministrador varchar (15),
PcorreoAdministrador varchar (50),
PnombresAdministrador varchar (30),
PapellidosAdministrador varchar (30),
PtipoDocumentoAdministrador varchar (30),
PnumDocumentoAdministrador int,
PtelefonoAdministrador int,
PestadoAdministrador varchar (10)
)
BEGIN
SELECT * FROM ADMINISTRADOR WHERE id=PidAdministrador or correo=PcorreoAdministrador or
nombres=PnombresAdministrador or apellidos=PapellidosAdministrador or
tipoDocumento=PtipoDocumentoAdministrador or numDocumento=PnumDocumentoAdministrador or
telefono=PtelefonoAdministrador or estado=PestadoAdministrador;
END $$

CALL selectAdmin (1, 'edierhernandezmo@gmail.com', 'Edier Heraldo', 'Hernandez Molano', 
'Tarjeta de Identidad',1055550018, 3134387765, 'Activo');

/*PROCEDIMIENTO PARA EDITAR ADMINISTRADOR*/
DELIMITER $$
CREATE PROCEDURE updateAdmin
(
PidAdministrador varchar (15),
PcorreoAdministrador varchar (50),
PpasswordAdministrador varchar (8),
PnombresAdministrador varchar (30),
PapellidosAdministrador varchar (30),
PtipoDocumentoAdministrador varchar (30),
PnumDocumentoAdministrador int,
PtelefonoAdministrador int,
PestadoAdministrador varchar (10)
)
BEGIN
UPDATE ADMINISTRADOR SET correo=PcorreoAdministrador, passwordU=PpasswordAdministrador,
nombres=PnombresAdministrador, apellidos=PapellidosAdministrador, tipoDocumento=PtipoDocumentoAdministrador,
numDocumento=PnumDocumentoAdministrador, telefono=PtelefonoAdministrador,
estado=PestadoAdministrador WHERE id=PidAdministrador;
END $$

CALL updateAdmin (1,'melaniealejandra@gmail.com','MASO34','Malenie Alejandra','Solano Orozco','Cédula de Ciudadania',1362808764,
3147746798, 'Activo');

/*PROCEDIMIENTO PARA ELIMINAR O INHABILITAR ADMINISTRADOR*/
DELIMITER $$
CREATE PROCEDURE deleteAdmin
(
PidAdministrador varchar (15),
PestadoAdministrador varchar (10)
)
BEGIN
UPDATE ADMINISTRADOR SET estado=PestadoAdministrador WHERE id=PidAdministrador;
END $$

CALL deleteAdmin (1, 'Inactivo');

select * from ADMINISTRADOR;

/*---------------------------------RESIDENTE---------------------------*/
/*PROCEDIMIENTO PARA INSERTAR RESIDENTE*/
DELIMITER $$
CREATE PROCEDURE insertResid
(
PidResidente varchar (15),
PcorreoResidente varchar (50),
PpasswordResidente varchar (8),
PnombresResidente varchar (30),
PapellidosResidente varchar (30),
PtipoDocumentoResidente varchar (30),
PnumDocumentoResidente int,
PtelefonoResidente int,
PtelFijoResidente int,
PnumTorreResidente varchar (1),
PnumBloqueResidente varchar (1),
PnumApartamentoResidente varchar (3),
PestadoResidente varchar (10),
PtipoUsuario int
)
BEGIN
INSERT INTO RESIDENTE (id, correo, passwordU, nombres, apellidos,
tipoDocumento, numDocumento, telefono,telFijo, numTorre,numBloque, numApartamento, estado, tipoUsuario)

VALUES (PidResidente, PcorreoResidente, PpasswordResidente, PnombresResidente, PapellidosResidente,
PtipoDocumentoResidente,PnumDocumentoResidente, PtelefonoResidente, PtelFijoResidente,
PnumTorreResidente,PnumBloqueResidente,PnumApartamentoResidente, PestadoResidente, PtipoUsuario);

END$$

CALL insertResid ('', 'javihernandez@gmail.com', 'javi','Javier','Hernandez Arias', 'Cédula de Ciudadania', 
123487432, 3108816708, 1234567, 4,1,502,'Activo',1);

/*procedimiento para consultar residente*/
DELIMITER $$
CREATE PROCEDURE selectResid
(
PidResidente varchar (15),
PcorreoResidente varchar (50),
PnombresResidente varchar (30),
PapellidosResidente varchar (30),
PtipoDocumentoResidente varchar (30),
PnumDocumentoResidente int,
PtelefonoResidente int,
PtelFijoResidente int,
PnumTorreResidente varchar (1),
PnumBloqueResidente varchar (1),
PnumApartamentoResidente varchar (3),
PestadoResidente varchar (10)
)
BEGIN
SELECT * FROM RESIDENTE WHERE id=PidResidente or correo=PcorreoResidente or
nombres=PnombresResidente or apellidos=PapellidosResidente or tipoDocumento=PtipoDocumentoResidente or 
numDocumento=PnumDocumentoResidente or telefono=PtelefonoResidente or telFijo=PtelFijoResidente or 
numTorre=PnumTorreResidente or numBloque=PnumBloqueResidente or 
numApartamento=PnumApartamentoResidente or estado=PestadoResidente;
END $$

CALL selectResid (1, 'javihernandez@gmail.com','Javier','Hernandez Arias', 'Cédula de Ciudadania', 123487432, 3108816708,
1234567, 4,1,502,'Activo');

/*precedimiento para editar residente*/
DELIMITER $$
CREATE PROCEDURE updateResidente
(
PidResidente varchar (15),
PcorreoResidente varchar (50),
PpasswordResidente varchar (8),
PnombresResidente varchar (30),
PapellidosResidente varchar (30),
PtipoDocumentoResidente varchar (30),
PnumDocumentoResidente int,
PtelefonoResidente int,
PtelFijoResidente int,
PnumTorreResidente varchar (1),
PnumBloqueResidente varchar (1),
PnumApartamentoResidente varchar (3),
PestadoResidente varchar (10)
)
BEGIN
UPDATE RESIDENTE set correo=PcorreoResidente, passwordU=PpasswordResidente, nombres=PnombresResidente,
apellidos=PapellidosResidente, tipoDocumento=PtipoDocumentoResidente, numDocumento=PnumDocumentoResidente,
numDocumento=PnumDocumentoResidente,telefono=PtelefonoResidente, telFijo=PtelFijoResidente,
numTorre=PnumTorreResidente,numBloque=PnumBloqueResidente,numApartamento=PnumApartamentoResidente,
estado= PestadoResidente where id=PidResidente;
END$$

CALL updateResidente (1,'santiagomolano@gmail.com','santim','Jaiderson Santigo','Molano Mahecha','Cédula de Ciudadania',1055550020,
3112929619,7542974,5,1,401,'Activo');
select * from residente;

/*PRECEDIMIENTO PARA ELIMINAR O INHABLITAR RESIENTE*/
DELIMITER $$
CREATE PROCEDURE deleteResid
(
PidResidente varchar (15),
PestadoResidente varchar (10)
)
BEGIN
UPDATE RESIDENTE SET estado=PestadoResidente WHERE id=PidResidente;
END $$

CALL deleteResid (1, 'Inactivo');
select * from residente;
/*--------------------------GUARDA SEGURIDAD----------------*/
/*PRECEDIMIENTO PARA INSERTAR GUARDA DE SEGURIDAD*/
DELIMITER $$
CREATE PROCEDURE insertGuarda
(
PidGuarda varchar (15),
PcorreoGuarda varchar (50),
PpasswordGuarda varchar (8),
PnombresGuarda varchar (30),
PapellidosGuarda varchar (30),
PtipoDocumentoGuarda varchar (30),
PnumDocumentoGuarda int,
PtelefonoGuarda int,
PestadoGuarda varchar (10),
PtipoUsuario int,
PidAdministradorFK varchar (15) 
)
BEGIN
INSERT INTO GUARDA_SEGURIDAD (id, correo, passwordU, nombres, apellidos,
 tipoDocumento, numDocumento, telefono, estado, tipoUsuario, idAdministradorFK)

VALUES (PidGuarda, PcorreoGuarda, PpasswordGuarda, PnombresGuarda, PapellidosGuarda, 
PtipoDocumentoGuarda, PnumDocumentoGuarda, PtelefonoGuarda, PestadoGuarda, PtipoUsuario, PidAdministradorFK);
END $$

CALL insertGuarda ('', 'jesondanilo@gmail.com','dani123', 'Jeison Danilo', 'Hernandez Molano', 
'Cédula de Ciudadania', 10555578876, 312345667, 'Activo', 2, 1);

/*CONSULTAR GUARDA DE SEGURIDAD*/
DELIMITER $$
CREATE PROCEDURE selectGuarda
(
PidGuarda varchar (15),
PcorreoGuarda varchar (50),
PnombresGuarda varchar (30),
PapellidosGuarda varchar (30),
PtipoDocumentoGuarda varchar (30),
PnumDocumentoGuarda int,
PtelefonoGuarda int,
PestadoGuarda varchar (10)
)
BEGIN
SELECT * FROM GUARDA_SEGURIDAD WHERE id=PidGuarda or correo= PcorreoGuarda or nombres=PnombresGuarda or
apellidos = PapellidosGuarda or tipoDocumento=PtipoDocumentoGuarda or numDocumento=PnumDocumentoGuarda or
telefono=PtelefonoGuarda or estado=PestadoGuarda;
END$$

CALL selectGuarda (1, 'jesondanilo@gmail.com', 'Jeison Danilo', 'Hernandez Molano', 'Cédula de Ciudadania', 10555578876,
312345667, 'Activo');

/*EDITAR O MODIFICAR GUARDA DE SEGURIDAD*/
DELIMITER $$
CREATE PROCEDURE updateGuarda
(
PidGuarda varchar (15),
PcorreoGuarda varchar (50),
PpasswordGuarda varchar (8),
PnombresGuarda varchar (30),
PapellidosGuarda varchar (30),
PtipoDocumentoGuarda varchar (30),
PnumDocumentoGuarda int,
PtelefonoGuarda int,
PestadoGuarda varchar (10)
)
BEGIN
UPDATE GUARDA_SEGURIDAD set correo=PcorreoGuarda, passwordU=PpasswordGuarda,
nombres=PnombresGuarda, apellidos=PapellidosGuarda, tipoDocumento=PtipoDocumentoGuarda,
numDocumento=PnumDocumentoGuarda, telefono=PtelefonoGuarda, estado=PestadoGuarda where id=PidGuarda;
END$$

CALL updateGuarda (1,'yeimimolano@gamil.com','molano1','Yeimi','Molano Mahecha','Cédula de Ciudadania',
123644332, 3162345556, 'Activo');

select * from guarda_seguridad;

/*INHABILITAR GUARDA DE SEGURIDAD*/
DELIMITER $$
CREATE PROCEDURE deleteGuarda
(
PidGuarda varchar (15),
PestadoGuarda varchar (10)
)
BEGIN
UPDATE GUARDA_SEGURIDAD SET estado=PestadoGuarda WHERE id=PidGuarda;
END $$

CALL deleteGuarda(1, 'Inactivo');
select * from guarda_seguridad;