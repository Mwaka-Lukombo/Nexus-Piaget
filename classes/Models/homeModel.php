<?php


namespace Models;


class homeModel{
    

public static function listarCursos(){
    $cursos = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.cursos`");
    $cursos->execute();
    $curso = $cursos->fetchAll();
  }

  
 public static function cadastrarUsuarios($nome,$email,$sexo,$perfil,$senha,$curso,$ano){
   $dir = 'uploads/';
  if(move_uploaded_file($perfil['tmp_name'],$dir.$perfil['name'])){
    $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.estudantes`  VALUES (null,?,?,?,?,?,?,?)");
    $sql->execute(array($nome,$email,$sexo,$perfil['name'],$senha,$curso,$ano));
    print "<script>alert('Usuario Cadastrado com Sucesso!')</script>";
  }
 }     

}