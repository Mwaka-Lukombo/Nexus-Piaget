<?php



namespace Controllers;
use \Views\mainView;



class turmaSingleController{



  public function index($par){

    $url = explode ('/',$_GET['url'])[1];

    if(isset($_GET['publicacao'])){
      $id = (int)$_GET['publicacao'];
      $sql = \Mysql::conectar()->exec("DELETE FROM `tb_site.turma_materia` WHERE id = $id");
      \Painel::redirectJS(INCLUDE_PATH.'turma/'.$url);
    }

    if(isset($_GET['deletarComentario'])){
      
       $id = (int)$_GET['deletarComentario'];
       $sql = \Mysql::conectar()->exec("DELETE FROM `tb_site.turma_comentario` WHERE id = $id");
       \Painel::redirectJS(INCLUDE_PATH.'turma/'.$url);

    }
    $idTurmaSingle = $par[2];
    if(isset($_POST['cadastrar_info'])){
          $id = $par[2];
          $estudante_id = $_SESSION['id'];
          $mensagem = $_POST['mensagem'];
          $ok = false;

          \Models\turmaModel::cadastrarPost($id,$estudante_id,$mensagem);
          $materia_id = \Mysql::conectar()->lastInsertID();

          if(isset($_FILES['audio']) != ""){
            $total = count($_FILES['audio']['name']);
            $documentos = [];
            $dir = 'ficheiros/audios/';
            for($i = 0; $i < $total; $i++){
               $Atual = [
                 'tmp_name'=>$_FILES['audio']['tmp_name'][$i],
                 'name'=>$_FILES['audio']['name'][$i]
               ];
               if(move_uploaded_file($Atual['tmp_name'],$dir.$Atual['name'])){
                 $ok = true;
                 $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.materia_audios` (id,materia_id,nome_documento) VALUES (null,?,?)");
                 $sql->execute(array($materia_id,$Atual['name']));
                 print "<script>Ficheiros carregados com sucesso!</script>";
               }else{
                  $ok = false;
               }
            }

            
          }

          if(isset($_FILES['document']) != ""){
               $total = count($_FILES['document']['name']);
               $documentos = [];
               $dir = 'ficheiros/documentos/';
               for($i = 0; $i < $total; $i++){
                  $Atual = [
                    'tmp_name'=>$_FILES['document']['tmp_name'][$i],
                    'name'=>$_FILES['document']['name'][$i]
                  ];
                  if(move_uploaded_file($Atual['tmp_name'],$dir.$Atual['name'])){
                    $ok = true;
                    $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.materia_documentos` (id,materia_id,estudante_id,nome_documento) VALUES (null,?,?,?)");
                    $sql->execute(array($materia_id,$_SESSION['id'],$Atual['name']));
                    print "<script>Ficheiros carregados com sucesso!</script>";
                  }else{
                     $ok = false;
                  }
               }
          }
          
          if(isset($_FILES['video']) != ""){
            $total = count($_FILES['video']['name']);
            $documentos = [];
            $dir = 'ficheiros/videos/';
            for($i = 0; $i < $total; $i++){
               $Atual = [
                 'tmp_name'=>$_FILES['video']['tmp_name'][$i],
                 'name'=>$_FILES['video']['name'][$i]
               ];
               if(move_uploaded_file($Atual['tmp_name'],$dir.$Atual['name'])){
                 $ok = true;
                 $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.materia_videos` (id,materia_id,estudante_id,nome_documento) VALUES (null,?,?,?)");
                 $sql->execute(array($materia_id,$_SESSION['id'],$Atual['name']));
                 print "<script>Ficheiros carregados com sucesso!</script>";
               }else{
                  $ok = false;
               }

            }
          }
    }

    if(isset($_POST['comentar'])){
      $estudante_id = $_SESSION['id'];
      $turma_id = $_POST['turma_id'];
      $comentario = $_POST['comentario'];
      \Models\turmaModel::comentario($turma_id,$estudante_id,$comentario);
    }
    
     if(\Models\turmaModel::existTurma($idTurmaSingle)){
      mainView::index('turmaSingle.php',['controller'=>$this],$header = 'pages/includes/headerForum.php');
    }else{
       print "<script>alert(':( A turma não existe ')</script>";
       \Painel::redirectJS(INCLUDE_PATH.'turma');
    }
    
  }    


  public static function listarPosts($id){
    $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma_materia` WHERE turma_id = ? ORDER BY data DESC");
    $sql->execute(array($id));
    
    return $sql->fetchAll();
  }


  public static function listarVideos($id){
    $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.materia_videos` WHERE materia_id = ?");
    $sql->execute(array($id));
    return $sql->fetchAll();
  }

  public static function listarDocumentos($id){
    $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.materia_documentos` WHERE materia_id = ?");
    $sql->execute(array($id));
    return $sql->fetchAll();
  }

  public static function listarAudios($id){
    $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.materia_audios` WHERE materia_id = ?");
    $sql->execute(array($id));
    return $sql->fetchAll();
  }

  

  public static function listarComentario($id){
    $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma_comentario` WHERE turma_id = ? ORDER BY data ASC");
    $sql->execute(array($id));
    return $sql->fetchAll();
  }


}