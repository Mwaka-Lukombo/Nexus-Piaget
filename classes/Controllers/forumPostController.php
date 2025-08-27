<?php

namespace Controllers;
use \Views\mainView;
use \Models\forumModel;

 class forumPostController{

  

    public function index(){

      if(isset($_GET['deletarPost'])){
         $id = (int)$_GET['deletarPost'];
         $curso = explode ('/',$_GET['url'])[1];
         $topico = explode ('/',$_GET['url'])[2];

         $sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site_forum.post` WHERE id = ?");
         if($sql->execute(array($id))){
            print '<script>alert("Postagem deletada com sucesso!")</script>';
            header ('Location:'.INCLUDE_PATH.'forum/'.$curso."/".$topico);
         }
      }


     if(isset($_POST['cadastrar_forum'])){
        $id_Topico = explode('/',$_GET['url'])[2];
        $id_usario = $_SESSION['id'];
        $nome = $_SESSION['nome'];
        $mensagem = $_POST['publicacao'];
        if(forumModel::cadastrarPost($id_Topico,$id_usario,$nome,$mensagem));
     }
        mainView::index('postForum.php',['controller'=>$this],$header='pages/includes/headerForum.php',$footer='pages/includes/footer.php');
    }

    public static function ListarForumPost($id_Topico){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site_forum.post` WHERE id_topico = ?");
        $sql->execute(array($id_Topico));
        return $sql->fetchAll();
    }




    

 }