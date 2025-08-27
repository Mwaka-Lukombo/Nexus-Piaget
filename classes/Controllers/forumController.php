<?php


namespace Controllers;
use \Views\mainView;



class forumController{


    public function index(){

        if(isset($_POST['cadastrar_curso'])){
            $curso = $_POST['curso'];

            $verifica_curso = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.cursos` WHERE nome = ?");
            $verifica_curso->execute(array($curso));
            if($verifica_curso->rowCount() == 1){
                print "<script>alert('O curso Ja existe!')</script>"; 
            }else{
                $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.cursos` VALUES (null,?)");
                $sql->execute(array($curso));
                print "<script>alert('Curso cadastrrado com sucesso!')</script>"; 
                
            }

         
        }
         mainView::index('forum.php',['controller'=>$this],$header = 'pages/includes/headerForum.php',$footer='pages/includes/footer.php');
    }

    public function listarCursos(){
        $sql = \Mysql::conectar()->prepare(" SELECT DISTINCT c.id, c.nome, tp.id_curso 
        FROM `tb_site.cursos` as c
        INNER JOIN `tb_site_forum` as tp 
        WHERE tp.id_curso = c.id ORDER BY c.nome ASC");
        $sql->execute();
        
        return $sql->fetchAll();
    }




}