/*Crear la base de datos en Sqlite 3
nombre de la base de datos hiring.sdb */

/* Tabla de personas a evaluar*/
CREATE TABLE person(
id integer primary key,
name char(128),
email char(128)
);

/* Tabla de respuestas de la persona*/
CREATE TABLE person_response(person_id integer primary key, start_time integer, end_time integer, response text );

/* Tabla de examenes*/
CREATE TABLE exam( id int primary key, name char(255) not null, content text, solution text);