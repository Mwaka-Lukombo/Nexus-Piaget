<?php


namespace Models;


class noticiasModel{



   public static function comentario($id_noticia,$id_usuario,$comentario){
    $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.comentarios_noticias` (id,noticia_id,usuario_id,comentario) VALUES (null,?,?,?)");
    $sql->execute(array($id_noticia,$id_usuario,$comentario));
   }
}