<?php

include ('../config.php');


$data = date('Y/m/d H:i');
$noticia_id = $_POST['noticia_id'];
$estudante_id = $_POST['estudante_id'];
$comentario = $_POST['comentario'];


$sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.comentario_alumin` WHERE estudante_id = ? AND noticia_id = ? AND status = 1 AND comentario = ?");
$sql->execute(array($estudante_id,$noticia_id,$comentario));
if($sql->rowCount() == 0){
   $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.comentario_alumin` VALUES (null,?,?,?,?,?)");
   $sql->execute(array($noticia_id,$estudante_id,$comentario,1,$data));
   print "Comentario feito com sucesso!";
}else{
    print "Voce ja fez o comentario!";
}

