/*data de prueba*/
insert into person(id,name,email) values(123456789,'Prueba','prueba');
insert into person(id,name,email) values(635405621834,'Jorge Quintero','jorgequintt@gmail.com');
insert into person(id,name,email) values(33114046862,'Jorge Castillo Moreno','jc@jorgecastillo.pro');
insert into person(id,name,email) values(909961534169,'Isaac Suaste','hola@isaacsuaste.com');
insert into person(id,name,email) values(456230717351,'Roger Manzo','rogermanzo04@gmail.com');
insert into person(id,name,email) values(627776115275,'Alex Manuel Coillo Chambilla','acoilloch@gmail.com');
insert into person(id,name,email) values(555576749537,'Francisco Quezada Geldres','fquezadageldres@gmail.com');
insert into person(id,name,email) values(341339481110,'Ronald Chavez','ronaldjosechavezcordonez@gmail.com');
insert into person(id,name,email) values(598884463846,'Jack Anthony Sánchez Rivera','janasarii@gmail.com');
insert into person(id,name,email) values(291018347935,'Enmanuel Alfonzo','14-05775@usb.ve');
insert into person(id,name,email) values(734916588187,'Gerardo Mijares','a00818999@itesm.mx');
insert into person(id,name,email) values(944081168711,'Luismay Garcia','luismaygc@gmail.com');
insert into person(id,name,email) values(597593580554,'Víctor Gabriel Moreno Pinto','victorgmp@gmail.com');
insert into person(id,name,email) values(84283870363,'Eber Reta','eber.retabaeza@gmail.com');
insert into person(id,name,email) values(705269870215,'Rodrigo Guerrero','guerrero.rodrigo14@gmail.com');
insert into person(id,name,email) values(707674287108,'Víctor Gabriel Moreno Pinto','victorgmp@gmail.com');
insert into person(id,name,email) values(921633787782,'Ronald Chavez','ronaldjosechavezcordonez@gmail.com');
insert into person(id,name,email) values(487372858180,'CHRISTIAN ESPINOZA','espinoza.c@pucp.edu.pe');
insert into person(id,name,email) values(90486905519,'Axel Tsamaren Campos Salaza','theprox.1590@gmail.com');


insert into exam(id, name, content, solution) 
values (1, 'Software Developer', '', '{"p1":"d", "p2":"c", "p3": "d", "p4":"b", "p5":"a", "p6":"c", "p7":"b", "p8":"b", "p9":"c", "p10":"d", "p11":"b", "p12":"a", "p13":"b","p14":"a","p15":"c"}');

/*backup*/
 sqlite3 hiring.sdb .dump > hiring.backup.sdb

 /*restore*/
 sqlite3 hiring.sdb < hiring.backup.sdb
 