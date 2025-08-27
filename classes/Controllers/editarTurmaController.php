<?php

namespace Controllers;
use \Views\mainView;



class editarTurmaController{


      public function index($par){
        mainView::setParam($par);
        mainView::index('editarTurma.php',['controller'=>$this],$header = 'pages/includes/headerForum.php',$footer = 'pages/includes/footer.php');
      }

      public static function listarTurma($id){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma` WHERE id = ?");
        $sql->execute(array($id));
        return $sql->fetchAll();
      }

      public static function listarMateria($id){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma_materia` WHERE id = ?");
        $sql->execute(array($id));
        return $sql->fetchAll();
      }

      public static function listarVideos($id){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.materia_videos` WHERE materia_id = ? LIMIT 3");
        $sql->execute(array($id));
        return $sql->fetchAll();
      }
}