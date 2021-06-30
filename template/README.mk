# Templates 
En esta sección se localizan los archivos de examen en formato HTML.

Los archivos deben tener formularios de envio con action="index.php"

Los archivos deben tener dentro del formulario de envio un hidden con el siguiente contenido:
 <input type="hidden" name="token" value="{{token}}"/>

Se pueden usar las siguientes variables entre doble llave {{VARIABLE}}:
- name : Nombre del candidato
- email : Email del candidato 
- startTime : Fecha y hora de inicio en zona UTC 