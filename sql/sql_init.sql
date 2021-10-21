USE db1;


CREATE TABLE USERS(

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40),
    edad int,
    fecha_nac DATE,
    fecha_ins DATETIME DEFAULT CURRENT_TIMESTAMP,
    grupos VARCHAR(100),
    carac VARCHAR(100),
    pass VARCHAR(100),
    email VARCHAR(100)

);


CREATE TABLE ENCUESTA(

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40),
    restricciones VARCHAR(100),
    fecha_inicio DATETIME,
    fecha_final DATETIME,
    propietario INT UNSIGNED,

    CONSTRAINT enc_users_fk FOREIGN KEY (propietario) REFERENCES USERS(id)

);

CREATE TABLE USERS_ENCUESTA(

    fecha_respuesta DATE,
    respondida BOOLEAN,

    user INT UNSIGNED PRIMARY KEY,
    encuesta INT UNSIGNED,

    CONSTRAINT ue_users_fk FOREIGN KEY (user) REFERENCES USERS(id),
    CONSTRAINT ue_encuesta_fk FOREIGN KEY (encuesta) REFERENCES ENCUESTA(id)
);

CREATE TABLE PREGUNTAS(

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pregunta VARCHAR(100),
    encuesta INT UNSIGNED,

    CONSTRAINT pre_encuesta_fk FOREIGN KEY (encuesta) REFERENCES ENCUESTA(id)
);

CREATE TABLE RESPUESTAS(

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    respuesta VARCHAR(100),
    pregunta INT UNSIGNED,

    CONSTRAINT res_preguntas_fk FOREIGN KEY (pregunta) REFERENCES PREGUNTAS(id)

)
