<?php



namespace Controllers;
use \Views\mainView;


class conexoesController{




    public function index(){
       
        mainView::index('conexoes.php',['controller'=>$this],$header = 'pages/includes/headerForum.php',$footer = 'pages/includes/footer.php');
    }

    public function listarConexoes(){

        $query = "";

        if(isset($_POST['pesquisa'])){
            $pesquisa = $_POST['pesquisa'];
            $query = "WHERE nome LIKE '%$pesquisa%' OR empresa_1 LIKE '%$pesquisa%' OR empresa_2 LIKE '%$pesquisa%' OR email LIKE '%$pesquisa%'";
        }
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes_antigos` $query");
        $sql->execute();
        
        return $sql->fetchAll();
    }

    public static function seguidores($id_to){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.seguidores` WHERE (id_to = ? AND status = 1)");
        $sql->execute(array($id_to));
        
        return $sql->fetchAll();
      }

   
}