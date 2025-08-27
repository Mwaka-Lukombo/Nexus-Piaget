<?php


namespace Controllers;
use \Views\mainView;


class guardadosController{




    public function index(){
        mainView::index('guardados.php',['controller'=>$this],$header="pages/includes/headerForum.php",$footer = "pages/includes/footer.php");
    }

    public function guardados(){
      $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.guardados_noticia` WHERE estudante_id = ?");
      $sql->execute(array($_SESSION['id']));
      return $sql->fetchAll();
    }

    public static function EstudanteAntigo($id){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes_antigos` WHERE id = ?");
        $sql->execute(array($id));
        return $sql = $sql->fetch() ;
    }

    public static function estudante($nome,$email){
        $sql = \Mysql::conectar()->prepare("SELECT `perfil` FROM `tb_site.funcionarios` WHERE cargo = 2 AND nome  = ? AND email = ?");
        $sql->execute(array($nome,$email));
        return $sql = $sql->fetch()['perfil'];
    }

    public static function noticiasDados($id){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias_alumin` WHERE id = ?");
        $sql->execute(array($id));
        return $sql->fetchAll();
    }

    public function comentarios($noticia_id){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.comentario_alumin` WHERE noticia_id = ?  AND status = 1");
        $sql->execute(array($noticia_id));
        return $sql->fetchAll();
    }

    public static function AtualEstudante($id){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
        $sql->execute(array($id));
        return $sql = $sql->fetch();
    }
}