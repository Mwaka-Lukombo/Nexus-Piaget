<?php


namespace Controllers;
use \Views\mainView;



class perfilSinlgeController{


    public function index($arr){
         $id_usuario = $arr[3];
         $verfica = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes_antigos` WHERE id = ?");
         $verfica->execute(array($id_usuario));
         if($verfica->rowCount() == 1){
          mainView::index('perfil-single.php',['controller'=>$this,'id_usuario'=>$id_usuario],$header ="pages/includes/headerForum.php",$footer = "pages/includes/footer.php");
         }else{
            print '<script>alert(":( perfil inexistente")</script>';
            \Painel::redirectJS(INCLUDE_PATH.'alumin/conexoes');
         }
    }


    public static function listarPerfil($id_usuario){
      $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes_antigos` WHERE id = ?");
      $sql->execute(array($id_usuario));
      return $sql->fetch();
    }


    public static function seguidores($id_to){
      $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.seguidores` WHERE (id_to = ? AND status = 1)");
      $sql->execute(array($id_to));
      
      return $sql->fetchAll();
    }
}













