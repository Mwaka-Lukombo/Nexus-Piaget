<?php

include ('../config.php');


$estudante_id = $_POST['estudante_id'];
$noticia_id = $_POST['noticia_id'];


$sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site.guardados_noticia` WHERE estudante_id = ? AND noticia_id = ? AND status = 1");
$sql->execute(array($estudante_id,$noticia_id));

print "removido dos guardados!";
