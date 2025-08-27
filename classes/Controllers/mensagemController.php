<?php


namespace Controllers;
use \Views\mainView;


class mensagemController{



    public function index(){


         mainView::index('mensagem.php',['controller'=>$this],$header = 'pages/includes/headerLogado.php',$footer = 'pages/includes/footer.php');
    }


    // public static function listarMensagem($id_from,$id_to){
    //     $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.chat` WHERE id_from = ? AND id_to = ? ORDER BY data_envio ASC");
    //     $sql->execute(array($id_from,$id_to));
    // }
}