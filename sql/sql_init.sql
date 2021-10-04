USE db1;


CREATE TABLE USERS(

    id VARCHAR(20) PRIMARY KEY,
    nombre VARCHAR(40),
    edad int,
    fecha_nac DATE,
    fecha_ins DATE,
    grupos VARCHAR(100),
    carac VARCHAR(100)

);


CREATE TABLE ENCUESTA(

    id VARCHAR(20) PRIMARY KEY,
    nombre VARCHAR(40),
    restricciones VARCHAR(100),
    fecha_inicio DATE,
    fecha_final DATE,
    propietario VARCHAR(20),

    CONSTRAINT enc_users_fk FOREIGN KEY (propietario) REFERENCES USERS(id)

);

CREATE TABLE USERS_ENCUESTA(

    fecha_respuesta DATE,

    user VARCHAR(20) PRIMARY KEY,
    encuesta VARCHAR(20),

    CONSTRAINT ue_users_fk FOREIGN KEY (user) REFERENCES USERS(id),
    CONSTRAINT ue_encuesta_fk FOREIGN KEY (encuesta) REFERENCES ENCUESTA(id)
);

CREATE TABLE PREGUNTAS(

    id VARCHAR(20) PRIMARY KEY,
    pregunta VARCHAR(100),
    encuesta VARCHAR(20),

    CONSTRAINT pre_encuesta_fk FOREIGN KEY (encuesta) REFERENCES ENCUESTA(id)
);

CREATE TABLE RESPUESTAS(

    id VARCHAR(20) PRIMARY KEY,
    respuesta VARCHAR(100),
    pregunta VARCHAR(20),

    CONSTRAINT res_preguntas_fk FOREIGN KEY (pregunta) REFERENCES PREGUNTAS(id)

)
