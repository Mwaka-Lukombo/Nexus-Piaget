<?php

namespace Controllers;
use \Views\mainView;
use \Models\homeModel;



class homeController{


  public function index(){

    if(isset($_SESSION['email'])){
      \Painel::redirectJS(INCLUDE_PATH.'campus');
    }


    if(isset($_POST['acao'])){
       $user = $_POST['user'];
       $senha = $_POST['senha'];
       $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE email = ? AND senha = ?");
       $sql->execute(array($user,$senha));
       if($sql->rowCount() == 1){
           $info = $sql->fetch();
           $_SESSION['login'] = true;
           $_SESSION['id'] = $info['id_estudante'];
           $_SESSION['nome'] = $info['nome'];
           $_SESSION['email'] = $info['email'];
           $_SESSION['sexo'] = $info['sexo'];
           $_SESSION['curso'] = $info['curso'];
           $_SESSION['ano'] = $info['ano'];
           $_SESSION['img'] = $info['perfil'];
           $_SESSION['senha'] = $info['senha'];


           if(isset($_POST['lembrar'])){

            
              setcookie("user",$_SESSION['email'],time() + ((60*60 * 24) * 7), '/');
              setcookie("senha",$_SESSION['senha'], time() + ((60*60 * 24) * 7), '/');

             
           }

           print "<script>alert('Login efetuado com sucesso!')</script>";
          \Painel::redirectJS(INCLUDE_PATH."campus");
       }else{
        print "<script>alert('Login ou senha incorretos!')</script>";
       }
      
    }

    //cadastro
    if(isset($_POST['cadastro'])){
         $nome = $_POST['nome'];
         $email = $_POST['email'];
         $sexo = $_POST['sexo'];
         $curso = $_POST['curso'];
         $ano = $_POST['ano'];
         $perfil = $_FILES['imagem'];
         $senha = $_POST['senha'];
         $verifica = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE email = ?");
         $verifica->execute(array($email));
         if($verifica->rowCount() == 1){
           print "<script>alert('O Usuario já existe!, use o seu email alternativo')</script>";
         }else{
            homeModel::cadastrarUsuarios($nome,$email,$sexo,$perfil,$senha,$curso,$ano);
        }
    }

    //atualizar conta

    mainView::index('home.php',['controller'=>$this]);
  }


  
    
}