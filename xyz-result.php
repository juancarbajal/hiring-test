<?php
/*Cambiar nombre a este archivo */
 $db = new SQLite3(__DIR__ . '/data/hiring.sdb');
 $rows = $db->query('select p.id, p.name, p.email, pr.person_id, pr.start_time, pr.end_time, pr.response from person p left join person_response pr on p.id = pr.person_id');

 //$exam = $db->queryOne('select * from exam where id =1 limit 1');
?>
<style type="text/css">
    table, th, td {
  border: 1px solid black;
}
</style>
     <table>
         <tr>
         <td>id</td>
         <td>name</td>
         <td>email</td>
         <td>startTime</td>
         <td>endTime</td>
         <td>response</td>
         </tr>
<?php
while ($row = $rows->fetchArray()) {?>
         <tr>
         <td><?=$row['id']?></td>
         <td><?=$row['name']?></td>
         <td><?=$row['email']?></td>
         <td><?=date('Y-m-d H:i:s',$row['start_time'])?></td>
         <td><?=date('Y-m-d H:i:s',$row['end_time'])?></td>
         <td><pre><?php print_r(json_decode(base64_decode($row['response'])))?> </pre></td>
         </tr>
<?php }
?>
    </table>
