<?php
include ('../config.php');



$id_curso = $_POST['curso'];


$topico = \Mysql::conectar()->prepare("SELECT * FROM `tb_site_forum` WHERE id_curso = ? ORDER BY id ASC");
$topico->execute(array($id_curso));
$topico = $topico->fetchAll();


foreach($topico as $key => $value){print '<option selected value = '.$value['id'].'>'. $value['topico'].'</option>';}
?>

