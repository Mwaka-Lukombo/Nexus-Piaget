<?php



namespace Models;




class campusModel{

    public static function updateUser($nome,$email,$perfil,$senha,$id){
        $sql = \Mysql::conectar()->prepare("UPDATE `tb_site.estudantes` SET nome = ?,email = ?, perfil = ? , senha = ? WHERE id_estudante = ?");
        $sql->execute(array($nome,$email,$perfil,$senha,$id));
        print "<script>alert('Perfil atualizado com sucesso!')</script>";
    }

    public static function dadosAtuais($id){
        $perfil_dados = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
        $perfil_dados->execute(array($id));
        return $perfil_dados->fetch();
    }

    public static function listarAmizades($id){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.solicitacoes` WHERE (status = 1 AND id_from = ?) OR
        (status = 1 AND id_to = ?)");
        $sql->execute(array($id,$id));
      
        return $sql->fetchAll(); 

    }

 



        
 
}