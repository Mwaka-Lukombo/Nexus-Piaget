<?php


namespace Controllers;
use Views\mainView;



class conexoesExistentesController{




    public function index(){
        mainView::index('conexoes_existentes.php',['controller'=>$this],$header = 'pages/includes/headerForum.php',$footer = "pages/includes/footer.php");
    }

    public function conexoesExistentes(){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.seguidores` WHERE (id_from = ? AND status = 1)");
        $sql->execute(array($_SESSION['id']));
        return $sql->fetchAll();
    }

    public static function imagemConexao($email){
        $sql = \Mysql::conectar()->prepare("SELECT `perfil` FROM `tb_site.funcionarios` WHERE cargo = 2 AND email = ?");
        $sql->execute(array($email));
        return $sql = $sql->fetch()['perfil'];
    }

    
}