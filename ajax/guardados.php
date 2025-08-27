<?php

include ('../config.php');

$estudante_id = $_POST['estudante_id'];
$noticia_id = $_POST['noticia_id'];


$verifica = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.guardados_noticia` WHERE estudante_id = ? AND noticia_id = ? AND status = 1");
$verifica->execute(array($estudante_id,$noticia_id));
if($verifica->rowCount() == 0){
$sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.guardados_noticia` VALUES (null,?,?,?)");
$sql->execute(array($estudante_id,$noticia_id,1));   


}
