<?php
namespace Models;



class forumModel{



    public static function cadastrarPost($idTopico,$id_usuario,$nome,$mensagem){
        $sql = \Mysql::conectar()->prepare(" INSERT INTO `tb_site_forum.post` (id,id_topico,id_usuario,nome,mensagem) VALUES (null,?,?,?,?)");
        $sql->execute(array($idTopico,$id_usuario,$nome,$mensagem));
        
        header('forum/'.$idTopico.$_SERVER['PHP_SELF']);
      
    }

    public static function respostaForum($idTopico,$id_usuario,$nome,$resposta){
        $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site_forum.respostas` VALUES (null,?,?,?,?)");
        $sql->execute(array($idTopico,$id_usuario,$nome,$resposta));
        header('forum/'.$idTopico);
    }
}