CREATE TABLE person(
id integer primary key,
name char(128),
email char(128)
);
CREATE TABLE person_response(person_id integer primary key, start_time integer, end_time integer, response text );

#Test data
insert into person(id, name, email) values (123456789, 'Usuario de prueba', 'test@yopmail.com');
