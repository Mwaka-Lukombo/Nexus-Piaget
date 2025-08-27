<?php

include ('../config.php');  


$noticia_id = $_POST['noticia_id'];
$id_estudante = $_POST['estudante_id'];


$sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site.noticias_alumin_like` WHERE estudante_id = ? AND noticia_id = ? AND status = 1");
$sql->execute(array($id_estudante,$noticia_id));


print "deslike feito com sucesso!";

