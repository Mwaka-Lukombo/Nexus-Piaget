<?php


namespace Controllers;
use \Views\mainView;
use \Models\noticiasModel;
use \Models\Galeria;



class noticiasController{

public function index(){
    if(isset($_POST['cadastra_noticia'])){
    $estudante_id = $_SESSION['id'];
    $noticia = $_POST['noticia'];
    $data = date('Y/m/d H:i:s');
    $imagem = array();
    $amountFiles = count($_FILES['imagens']['name']);
    $sucesso = true;

    for($i = 0; $i < $amountFiles; $i++){
    $imagemAtual = [
        'size'=>$_FILES['imagens']['size'][$i],
        'tmp_name'=>$_FILES['imagens']['tmp_name'][$i],
        'type'=>$_FILES['imagens']['type'][$i]
    ];
        if(\Painel::imagemValida($imagemAtual) == false){
        $sucesso = false;
        print "<script>alert('O formato da imagem e invalido!')</script>";
        break;
        }                
    }

if($sucesso){
    $dir = 'uploads_noticias/';
    for($i = 0; $i < $amountFiles; $i++){
        $imagemAtual = [
        'name'=>$_FILES['imagens']['name'][$i],
        'tmp_name'=>$_FILES['imagens']['tmp_name'][$i]
        ];
        $imagens[] = \Painel::uploadFile($imagemAtual,$dir);
    }   
        $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.noticias` (id,estudante_id,noticia,data) VALUES (null,?,?,?)");
        $sql->execute(array($estudante_id,$noticia,$data));
        $lastID = \Mysql::conectar()->lastInsertId();
        foreach($imagens as $key => $value){
            \Mysql::conectar()->exec("INSERT INTO `tb_site.noticias_imagens` VALUES (null,$lastID,'$value')");
        }
        print "<script>alert('Noticia cadastrada com sucesso!')</script>";
}
}

if(isset($_POST['comentar'])){
    $usuario_id = $_SESSION['id'];
    $noticia_id = $_POST['noticia_id'];
    $comentario = $_POST['comentario'];
    if(noticiasModel::comentario($noticia_id,$usuario_id,$comentario) == true){
       print "<script>alert('Comentario feito com sucesso')</script>";
    }
 
}

        mainView::index('noticias.php',['controller'=>$this,'title'=>'Noticias'],$header ='pages/includes/headerLogado.php');
    }


    public static function listarNoticias(){
      $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias`");
      $sql->execute();  
      
      return $sql->fetchAll();
    }

    public static function listarDadosUsuario($id){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
        $sql->execute(array($id));

        return $sql->fetch();
    }


    public static function listarImagens(){
        $imagens = new Galeria($pdo = \Mysql::conectar());
    }

    public static function listarComentario($id){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.comentarios_noticias` WHERE noticia_id = ?");
        $sql->execute(array($id));
        return $sql->fetchAll();
    }

    public static function dadosComentario($id){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }
 
}
