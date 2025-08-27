<?php


namespace Controllers;
use \Views\mainView;
use \Models\campusModel;




class campusController{



    public  function index(){

        if(isset($_GET['logout'])){
             \Painel::logout();
        }

        if(isset($_POST['atualizar'])){
          $id = $_SESSION['id'];
          $nome = $_POST['nome'];
          $email = $_POST['email'];
          $senha_atual = $_POST['senha_atual'];
          $nova_senha = $_POST['senha'];
          $imagem_atual = $_POST['imagem_atual'];
          $nova_imagem = $_FILES['imagem'];



          if($nome == ""){
            $nome = $_SESSION['nome'];
          }else if($nova_senha == ""){
             $nova_senha = $_SESSION['senha'];
          }else if($email == ""){
            $email = $_SESSION['email'];
          }else if($ano == ""){
             $ano = $_SESSION['ano'];
          }
          
          if(empty($_FILES['imagem']['name'])){
             $nova_imagem = $imagem_atual;
          }else{
            $dir = 'uploads/';
            @unlink($dir.$imagem_atual);
            move_uploaded_file($nova_imagem['tmp_name'],$dir.$nova_imagem['name']);
            campusModel::updateUser($nome,$email,$nova_imagem['name'],$nova_senha,$id);  
            $_SESSION['img'] = campusModel::dadosAtuais($id)['perfil'];
            $_SESSION['nome'] = campusModel::dadosAtuais($id)['nome'];
            $_SESSION['email'] = campusModel::dadosAtuais($id)['email'];
            $_SESSION['senha'] = campusModel::dadosAtuais($id)['senha'];
         }
        }

        mainView::index('campus.php',[],$header = 'pages/includes/headerLogado.php');
    }
}