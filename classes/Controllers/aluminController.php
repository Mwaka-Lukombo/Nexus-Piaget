<?php


namespace Controllers;
use \Views\mainView;





class aluminController{



    public function index(){
        mainView::index('alumin.php',['controller'=>$this],$header = 'pages/includes/headerForum.php',$footer = 'pages/includes/footer.php');
    }


    public static function listarNoticias(){
       
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias_alumin` ORDER BY data desc  ");
        $sql->execute();
        return $sql->fetchAll();
    }

    public static function dados($id){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes_antigos` WHERE id = ?");
        $sql->execute(array($id));
        return $sql = $sql->fetch();
    }

    

}
