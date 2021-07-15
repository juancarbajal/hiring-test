<html>
    <head>
        <title>Crear</title>
        <meta charset="UTF-8">
        <style type="text/css">
body{
    margin-left:200px;
    margin-right:200px;
    
    padding:0
}
h1 {
    text-align:center
}
        </style>
    </head>
<body>
<h1>Crear Persona</h1>
<?php 
if (!isset($_REQUEST['email'])){?>
<form action="xyz-create.php" method="POST">
<dl>
    <dt>Nombre:</dt> <dd><input type="text" name="name"/></dd>
    <dt>Email:</dt> <dd><input type="text" name="email"/></dd>
    <dt><input type="submit" value="Crear registro" /></dt> 
</dl>
</form>
<?php } else {
    $db = new SQLite3(__DIR__ . '/data/hiring.sdb');
    $newId = time();
    $sql = sprintf("insert into person(id,name,email) values(%s,'%s','%s')", $newId, $_REQUEST['name'], $_REQUEST['email']);
    $result = $db->exec($sql);
    if ($result) {
        $dateEnd = date('d/m/Y', strtotime('+3 days'));
        $name = explode(' ', $_REQUEST['name']);
        $url = 'http://test-hiring.fitcolatam.com/?t=' . $newId;
    ?>
<pre>
Buenas tardes <?php echo ucwords($name[0])?>,

Un gusto conocerte, hemos revisado tu postulación y queremos que participes del proceso de selección.
El proceso de selección consiste en 3 pasos:
1. Examen técnico, con el examen validamos tus conocimientos de los requisitos técnicos de la postulación.
2. Entrevista personal, en este paso conoceremos mayor detalle de tu experiencia y tus objetivos profesionales.
3. Entrevista con los fundadores, luego de haber pasado satisfactoriamente los pasos anteriores conocerás a nuestros fundadores que quieren conocer más de ti.

Para iniciar te invitamos a tomar el examen técnico en el siguiente enlace:
<?php echo $url?>

Consideraciones:
- El examen se inicia al acceder al enlace.
- El tiempo promedio de solución del examen es de 30 minutos. Intenta completar el examen en ese tiempo.
- Completar el examen hasta <?php echo $dateEnd?> a las 23:59.
- Te informaremos el resultado del examen en la plataforma de postulación.

Mucha suerte.

</pre>        
        <?php
    } else echo "Error al crear registro";
}
    ?>


</body>