<?php

namespace Controllers;
use \Views\mainView;



class topicosController{



    public function index(){
        mainView::index('topicosForum.php',[],$header='pages/includes/headerForum.php',$footer='pages/includes/footer.php');
    }

    public static function listarTopicos($id_curso){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site_forum` WHERE id_curso = ?");
        $sql->execute(array($id_curso));

        return $sql->fetchAll();
    }
}