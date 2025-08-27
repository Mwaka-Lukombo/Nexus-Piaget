<?php


namespace Controllers;
use \Views\mainView;



class turmaController{



    public function index(){
        mainView::index('turmas.php',['controller'=>$this],$header = 'pages/includes/headerForum.php');
    }



    public static function listarTurmas(){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma` WHERE curso = ? AND ano = ?");
        $sql->execute(array($_SESSION['curso'],$_SESSION['ano']));
        
        return $sql->fetchAll();
    }
}