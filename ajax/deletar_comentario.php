<?php

include ('../config.php');

$comentario = $_POST['comentario'];
$estudante_id = $_POST['estudante_id'];
$noticia_id = $_POST['noticia_id'];

$sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site.comentario_alumin` WHERE estudante_id = ? AND noticia_id = ? AND comentario = ?");
$sql->execute(array($estudante_id,$noticia_id,$comentario));

print "comentario excluido com sucesso!";
