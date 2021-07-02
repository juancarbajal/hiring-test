<?php
error_reporting(0); //E_ALL
date_default_timezone_set("UTC");
//session_start();
header("Cache-Control: private, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // A date in the past

$template = __DIR__ . '/template/software-developer.html';

/**
 * Retorna el correo asociado al token
 * return string correo associado al token, null si no hay correo associado
 **/
function validateToken($token){
    $tokens = require('./data/token.php');
    return $tokens[$token];
}

/**
 * Deniega el acceso a la plataforma
 * */
function denied(){
    header('HTTP/1.0 403 Forbidden');
    echo '<h1>403 Acceso Denegado</h1>';
}

/**
 * Muestra un template
 * @param $filename string nombre del archivo  
 * @param $print boolean Imprimir
 * */
function showTemplate($filename, $print = true){
    $html = file_get_contents($filename);
    if ($print) echo $html;
    return $html;
}

/**
 * Clase para gestionar los postulantes y sus respuestas
 * */
class HiringDatabase {
    function __construct(){
        $this->db = new SQLite3(__DIR__ . '/data/hiring.sdb');
    }
    /**
     * Registra parametros de una persona que da el examen
     * return integer -1: Persona no existe   */
    function updatePersona($idPersona, $data){
        $startTime = $data['start_time'];
        $endTime = $data['end_time'];
        $response = base64_encode($data['response']);
        $id = $data['id'];
        $personId = $data['person_id'];
        $result = false;
        if ($personId == '') {
            $result = $this->db->exec("insert into person_response(person_id, start_time, end_time, response) values('$id', '$startTime', '$endTime', '$response')");
        } else {
            $sql = "update person_response set start_time= '$startTime', end_time='$endTime', response = '$response' where person_id = $id ";
            $result = $this->db->exec($sql);
        }
        return $result;
    }
    function getPersona($idPersona){
        $result = $this->db->querySingle('select p.id, p.name, p.email, pr.person_id, pr.start_time, pr.end_time, pr.response from person p left join person_response pr on p.id = pr.person_id where p.id=' . $idPersona, true);
        return $result;
    }
}

$hdb = new HiringDatabase();
if (isset($_GET['t'])) {
    $t = (int) $_REQUEST['t']; //por si acaso nos hacen sqli injection
    $v = $hdb->getPersona($t);
    if (count($v) == 0) denied();
    else {
        if (isset($v['response']) && ($v['response'] != '')){ //ya envío los resultados
            showTemplate(__DIR__ . '/template/repeat.html');
        } else {
            if (!isset($v['start_time'])){
                $startTime=time();
                $v['start_time'] = $startTime;
                $hdb->updatePersona($t, $v);
            } else
                $startTime = $v['start_time'];
            $html = showTemplate($template, false);
            $html = str_replace('{{token}}', $t, $html);
            $html = str_replace('{{name}}', $v['name'], $html);
            $html = str_replace('{{email}}', $v['email'], $html);
            $html = str_replace('{{startTime}}', date('Y-m-d h:i:s', $startTime), $html);
            echo $html;
        }   
    }
} else { //Registramos
    if (isset($_POST['token'])) { // Si se envía el examen
        //registramos en examen en la carpeta de respuestas
        $postData = $_POST;
        $t = (int) $postData['token'];
        $v = $hdb->getPersona($t);
        if (count($v) == 0 ){
            denied();
        } else {
            $v['response'] = json_encode($postData);
            $v['end_time'] = time();
            $hdb->updatePersona($t, $v);
            showTemplate(__DIR__ . '/template/final.html');
        }
    } else 
        denied();
}
