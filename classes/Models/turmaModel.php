<?php

namespace Models;



class turmaModel{





    public static function cadastrarPost($id,$estudante_id,$mensagem){
        $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.turma_materia` (id,turma_id,estudante_id,mensagem) VALUES (null,?,?,?)");
        $sql->execute(array($id,$estudante_id,$mensagem));
        print "<script>alert('Comentario feito com sucesso!')</script>";
    }

    public static function comentario($turma_id,$estudante_id,$comentario){
        $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.turma_comentario` (id,turma_id,estudante_id,comentario) VALUES (null,?,?,?)");
        $sql->execute(array($turma_id,$estudante_id,$comentario));
        print "<script>alert('Comentario feito com sucesso!')</script>";
    }

    public static function existTurma($id){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma` WHERE id = ?");
        $sql->execute(array($id));
        if($sql->rowCount() == 1){
            return true;
        }else{
            return false;
        }
    }
}