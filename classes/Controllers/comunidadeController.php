<?php


namespace Controllers;
use \Views\mainView;



class comunidadeController{

    public function index(){

      if(isset($_GET['addFriend'])){
         $idAmigo = (int)$_GET['addFriend'];
         if(($this->amigoPedenete($idAmigo)) == false){ 
           $this->solicitacaoAmigo($idAmigo);  
           print '<script>alert("Solicitacao envidada com sucesso!")</script>';
           \Painel::redirectJS('comunidade');
          
         }else{
            print "<script>alert('Aguarde A solicitacao foi enviada!')</script>";
         }

        //  $this->solicitacaoAmigo($idAmigo);
         
       
      }
        

        mainView::index('comunidade.php',['controller'=>$this],$header = 'pages/includes/headerLogado.php');
    }

    public static function listarMembros(){
      $query = "";
      if(isset($_POST['pesquisar'])){
            $busca = $_POST['busca'];
            $query = "WHERE nome LIKE '%$busca%' OR email LIKE '%$busca%' OR curso LIKE '%$busca%' ";
        }
      $query = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` $query");
      $query->execute();
      return $query->fetchAll();
    }

    public function solicitacaoAmigo($idAmigo){
        $sql = \Mysql::conectar()->prepare(" INSERT INTO `tb_site.solicitacoes` VALUES (null,?,?,?)");
        $sql->execute(array($_SESSION['id'],$idAmigo,0));
    }

    public function amigoPedenete($idAmigo){
       $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.solicitacoes` WHERE (id_from = ? AND id_to = ? AND status = 0) OR
       (id_from = ? AND id_to = ? AND status = 0)");
       $sql->execute(array(@$_SESSION['id'],$idAmigo,$idAmigo,@$_SESSION['id']));
       if($sql->rowCount() == 1){
          return true;
       }else{
         return false;
       }
       
    }

    public function isAmigo($idAmigo){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.solicitacoes` WHERE (id_from = ? AND id_to = ? AND status = 1)
        OR (id_from = ? AND id_to = ? AND status = 1)");
        $sql->execute(array($_SESSION['id'],$idAmigo,$idAmigo,$_SESSION['id']));
        if($sql->rowCount() == 1){
            return true;
        }else{
            return false;
        }
    }

  


  }
    
 