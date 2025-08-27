<?php

include ('../config.php');  


$noticia_id = $_POST['noticia_id'];
$id_estudante = $_POST['estudante_id'];


$verifica_like = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias_alumin_like` WHERE (estudante_id = ? AND noticia_id = ? AND status = 1)");
$verifica_like->execute(array($id_estudante,$noticia_id));
if($verifica_like->rowCount() == 0){
  $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.noticias_alumin_like` VALUES (null,?,?,?)");
  $sql->execute(array($id_estudante,$noticia_id,1));
  print "like feito com sucesso!";
}else{
  print "voce ja deu o like!";
}

// $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.noticias_alumin_like` VALUES (null,?,?,?)");
// $sql->execute(array($id_estudante,$noticia_id,1));

// print "like feito com sucesso!";