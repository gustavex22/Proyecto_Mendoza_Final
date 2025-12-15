create database Ingresopg;
use Ingresopg;
CREATE TABLE Estudiante (
    DNI INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(100) not null,
    Apellido_Paterno VARCHAR(150) not null,
    Apellido_Materno VARCHAR(150) not null,
    edad INT not null,
    fecha_nacimiento date not null,
    Correo_Electronico nvarchar(150) not null,
    Celular int(9),
    direccion_de_domicilio varchar(150) not null,
    DNI_Apoderado varchar(150),
    Carrera varchar(100) not null,
    Carrera_segundaria varchar(100),
    Nombre_del_Apoderado varchar(150),
    Apellido_Paterno_del_apoderado varchar(150),
    Apellido_Materno_del_apoderado varchar(150)
);
CREATE TABLE Documentos(
    Acta_de_compromiso LONGBLOB,
    No_devolucion_de_dinero_Menor_de_edad LONGBLOB,
    Declaracion_jurada_de_certificación_Menor_de_edad LONGBLOB,
    Declaracion_jurada_de_Salud_Menor_de__edad LONGBLOB,
    No_devolucion_de_dinero_Mayor_de_edad LONGBLOB,
    Declaracion_Jurada_de_salud_Mayor_de_edad LONGBLOB,
    Certificado_Estudiante LONGBLOB,
    estudiante_DNI INT UNIQUE,
    FOREIGN KEY (estudiante_DNI) REFERENCES Estudiante(DNI)
);