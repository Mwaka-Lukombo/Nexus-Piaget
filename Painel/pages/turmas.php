<?php 

  if($_SESSION['cargo'] == 1){
?>

<?php

$turmaID = (int)@$_GET['Turma'];

if($_SESSION['cargo'] == 2){
  \Painel::redirectJS(INCLUDE_PATH_PAINEL);
}


if(isset($_POST['criar_turma'])){
  $docente_id = $_SESSION['id'];
  $nome_docente = $_SESSION['nome'];
  $nome = $_POST['nome'];
  $ano = $_POST['ano'];
  $curso = $_POST['curso'];
  $capa = $_FILES['capa_turma'];

  $dir = 'capa_turma/';



  $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.turma` VALUES (null,?,?,?,?,?,?)");
   move_uploaded_file($capa['tmp_name'],$dir.$capa['name']);
  if($sql->execute(array($docente_id,$nome_docente,$nome,$ano,$curso,$capa['name']))){
     \Painel::mensagem("sucesso","Turma criada com sucesso!");
  }
}



if(isset($_GET['apagar'])){
  $idDeletar = (int)$_GET['apagar'];

  $sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site.turma` WHERE id = ?");
  if($sql->execute(array($idDeletar))){
    \Painel::mensagem("sucesso","Turma excluida com sucesso!");
  }
  //materia
  \Mysql::conectar()->exec("DELETE FROM `tb_site.turma_materia` WHERE turma_id = $idDeletar");

  //Comentario
  \Mysql::conectar()->exec("DELETE FROM `tb_site.turma_comentario` WHERE turma_id = $idDeletar");
  \Painel::redirectJS(INCLUDE_PATH_PAINEL.'turmas');
}

?>

<!--verificacao da turma-->
<?php

  if(!isset($_GET['Turma'])){
?>
<div class="box-content">
  <div class="wellcome">
    <h3>Turmas</h3>
  </div><!--wellcome-->


  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="Nome">Nome da Turma:</label>
      <input type="text" name="nome" placeholder="Nome da turma">
    </div><!--form-group-->

    <div class="form-group">
      <label for="Nome">Ano</label>
      <select name="ano">
         <?php 
          for($i = 1; $i < 5;$i++){
         ?>
       <option value="<?php echo $i; ?>"><?php echo $i.' º ' ?></option>
       <?php } ?>
      </select>
    </div><!--form-group-->

    <div class="form-group">
        <label for="Nome">Curso:</label>
        <select name="curso">
         <?php 
          $cursos = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.cursos`");
          $cursos->execute();
          $cursos = $cursos->fetchAll();
          foreach($cursos as $value){
         ?>
       <option value="<?php echo $value['nome']; ?>"><?php echo $value['nome']; ?></option>
       <?php } ?>
      </select>
    </div><!--form-group-->

    <div class="form-group">
        <label for="Nome">Capa:</label>
      <input type="file" name="capa_turma">
    </div><!--form-group-->

    <div class="form-group">
      <input type="submit" name="criar_turma">
    </div><!--form-group-->
  </form>
</div><!--box-content-->


<div class="content-turmas-painel">
<?php


  $turmas = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma` WHERE docente_id = ?");
  $turmas->execute(array($_SESSION['id']));
  $turmas = $turmas->fetchAll(PDO::FETCH_ASSOC);

  foreach($turmas as $value){
?>

<div class="funcionario-single">
      <div class="top">
          <div class="avatar">
            <img src="<?php echo INCLUDE_PATH_PAINEL ?>capa_turma/<?php echo $value['capa_turma'] ?>">
          </div>
      </div><!--top-->

      <div class="bottom">
          <h4>Nome: <?php echo $value['nome']; ?></h4>
          <p>Curso: <?php echo $value['curso']; ?></p>
          <p>Ano: <?php echo $value['ano'].'º'; ?></p>
          <div class="button-content">
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>turmas/?Turma=<?php echo $value['id'] ?>" style="background:lightblue"><i class="fa fa-eye"></i> Acessar </a>
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>turmas/?apagar=<?php echo $value['id'] ?>" style="background:tomato"><i class="fa fa-trash"></i> Deletar</a>
          </div><!--button-content-->
      </div>
   </div><!--funcionario-single-->

  <?php } ?>

</div><!--single-turma-->
</div><!--content-turmas-painel-->
<?php }else{ ?>
<?php

$turma = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma` WHERE id = ?");
$turma->execute(array($turmaID));
$turma = $turma->fetch();

?>

<div class="content-turma-painel">
  <div class="banner-turma-painel">
    <img src="<?php echo INCLUDE_PATH_PAINEL ?>capa_turma/<?php echo $turma['capa_turma'] ?>">
    <div class="overlay-banner-painel">
       <h4><?php echo $turma['ano'] ?>º Ano</h4>

       <div class="info-turma-painel">
         <h2><?php echo $turma['curso'] ?></h2>
         <h3><?php echo $turma['nome'] ?></h3>
         <p><b>Docente:</b> <?php echo $turma['nome_docente'] ?></p>
       </div><!--info-turma-painel-->
    </div>
  </div><!--banner-turma-painel-->

  <?php 

  if(isset($_POST['acao'])){
    $Docente_id = $_SESSION['id']; // docente_id
    $turmaIdCriar = (int)$_GET['Turma'];
    $descricao = $_POST['descricao'];
    $videos = $_FILES['videos']['name'];
    $ficheiros = $_FILES['documentos']['name'];
    $data = date("Y-m-d H:i:s");



    // Diretórios
    
    $dir_documentos = INCLUDE_PATH.'ficheiros/documentos/';

    $ok = true;

    if($descricao == ""){
      $ok = false;
      echo '<script>alert("Nao sao permitidos campos vazios!")</script>';
    }

    $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.turma_materia` (id,turma_id,docente_id,mensagem,data) VALUES (null,?,?,?,?)");
    $sql->execute(array($turmaIdCriar,$Docente_id,$descricao,$data));
    $lastId = \Mysql::conectar()->lastInsertID();

    if(isset($_FILES['documentos'])){
      $total = count($videos);
      $dir_video = '../ficheiros/documentos/';

      for($i = 0; $i < $total; $i++){
       $Atual = [
          'tmp_name'=>@$_FILES['documentos']['tmp_name'][$i],
          'name'=>@$_FILES['documentos']['name'][$i]
        ];

        if(move_uploaded_file($Atual['tmp_name'],$dir_video.$Atual['name'])){
          $ok = true;
          $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.materia_documentos` (id,materia_id,nome_documento,funcionario_id) VALUES (null,?,?,?)");
          $sql->execute(array($lastId,$Atual['name'],$Docente_id));
        }else{
          $ok = false;
        }
 
      }
    }
    

    if(isset($_FILES['videos'])){
      $total = count($videos);
      $dir_video = '../ficheiros/videos/';

      for($i = 0; $i < $total; $i++){
       $Atual = [
          'tmp_name'=>$_FILES['videos']['tmp_name'][$i],
          'name'=>$_FILES['videos']['name'][$i]
        ];

        if(move_uploaded_file($Atual['tmp_name'],$dir_video.$Atual['name'])){
          $ok = true;
          $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.materia_videos` (id,materia_id,nome_documento,funcionario_id) VALUES (null,?,?,?)");
          $sql->execute(array($lastId,$Atual['name'],$Docente_id));
        }else{
          $ok = false;
        }
 
      }
      \Painel::mensagem("sucesso","Material enviado com sucesso!");
    }
    


    
}
?>
  

  <!-- Content-postagem -->
    <div class="content-postagem">
      <form method="post" enctype="multipart/form-data">
       <div class="form-group">
        <label>Vídeo:</label>
        <input type="file" name="videos[]" multiple accept="video/mp4" />
      </div><!--form-group-->
        <div class="form-group">
          <label>Ficheiro:</label>
          <input type="file" name="documentos[]" multiple accept=".pdf,.doc,.docx" />
        </div><!--form-group-->

        <div class="form-group">
          <label>Descricao:</label>
          <textarea name="descricao"></textarea>
        </div><!--form-group-->

        <div class="form-group">
          <input type="submit" name="acao" />
        </div><!--form-group-->
      </form>
   </div><!--content-postagem-->


  <?php
  $materia = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma_materia` WHERE turma_id = ? ORDER BY data desc ");
  $materia->execute(array($turmaID));
  $materia = $materia->fetchAll();
   foreach($materia as $key => $materia){
    $videos = \Mysql::conectar()->prepare("SELECT * from `tb_site.materia_videos` WHERE materia_id = ? AND funcionario_id = ?");
    $videos->execute(array($materia['id'],$materia['docente_id']));
    $videos = $videos->fetchAll();
    foreach($videos as $key => $video){
    $docente = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.funcionarios` WHERE id = ?");
    $docente->execute(array($materia['docente_id']));
    $docente = $docente->fetch();

    $estudante = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
    $estudante->execute(array($materia['estudante_id']));
    $estudante = $estudante->fetch();

    if($materia['docente_id'] == 0){
  ?>
  <div class="postagem-painel">
    <div class="left-postagem">
       <div class="video-player">
         <video>
           <source src="<?php echo INCLUDE_PATH ?>ficheiros/videos/<?php echo $video['nome_documento']; ?>"></source>
         </video>

         <div class="menu-player">
          <div class="flex-menu">
           <div class="play">
            <i class="fa fa-play"></i>
           </div><!--play--> 
           <div class="tools">

             <div class="tumb">
               <input type="range" class="barraProgresso" min="1" value="0" step="0.01" />
                <span class="initFinal">0:09/4:00</span>
              </div><!--tumb-->
              
              <div class="configure-player">
                <div class="volume-content">
                  <input type="range" name="volume" min="1" value="1">
                </div>
               <span class="volume"><i class="fa-solid fa-volume-high"></i></span>
               <span class="screen"><i class="fa-solid fa-maximize"></i><span>
            </div><!--configure-player-->

              
           </div><!--tools-->
          </div><!--flex-menu-->
          </div><!--menu-player-->
       </div><!--video-player-->
    </div><!--left-postagem---> 
    <div class="right-postagem">
      <div class="perfil-estudante">
        <div class="perfil-border">
          <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $estudante['perfil']; ?>">
        </div><!--perfil-border-->
        <div class="info-perfil-postagem">
          <h3><?php echo $estudante['nome']; ?></h3>
        </div><!--info-perfil-postagem-->
      </div><!--perfil-estudante-->

      <div class="descricao-postagem">
        <p><?php echo $materia['mensagem']; ?></p>

        <?php 
         $documentos = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.materia_documentos` WHERE materia_id = ? ");
         $documentos->execute(array($materia['id']));
         $documentos = $documentos->fetchAll();
         foreach($documentos as $key => $doc){
        ?>

        <div class="items-postagem">
          <a href="<?php echo INCLUDE_PATH ?>ficheiros/documentos/<?php echo $doc['nome_documento']; ?>" target="_blank"><i class="fa fa-file-pdf"></i> <?php echo $doc['nome_documento']; ?> </a>
         </div>
         <?php } ?>
         
      </div><!--descricao-postagem-->

      <div class="button">
       <a href="<?php echo INCLUDE_PATH ?>ficheiros/videos/<?php echo $video['nome_documento']; ?>" download><i class="fa fa-download" ></i> Download</a>
      </div><!--button-->
    </div><!--right-postagem-->
   </div><!--postagem-painel-->

   <?php }else{ ?>
      <div class="postagem-painel">
    <div class="left-postagem">
       <div class="video-player">
         <video>
           <source src="<?php echo INCLUDE_PATH ?>ficheiros/videos/<?php echo $video['nome_documento']; ?>"></source>
         </video>

         <div class="menu-player">
          <div class="flex-menu">
           <div class="play">
            <i class="fa fa-play"></i>
           </div><!--play--> 
           <div class="tools">

             <div class="tumb">
               <input type="range" class="barraProgresso" min="1" value="0" step="0.01" />
                <span class="initFinal">0:09/4:00</span>
              </div><!--tumb-->
              
              <div class="configure-player">
                <div class="volume-content">
                  <input type="range" name="volume" min="1" value="1">
                </div>
               <span class="volume"><i class="fa-solid fa-volume-high"></i></span>
               <span class="screen"><i class="fa-solid fa-maximize"></i><span>
            </div><!--configure-player-->

              
           </div><!--tools-->
          </div><!--flex-menu-->
          </div><!--menu-player-->
       </div><!--video-player-->
    </div><!--left-postagem---> 
    <div class="right-postagem">
      <div class="perfil-estudante">
        <div class="perfil-border">
          <img src="<?php echo INCLUDE_PATH_PAINEL ?>perfil/<?php echo $docente['perfil']; ?>">
        </div><!--perfil-border-->
        <div class="info-perfil-postagem">
          <h3><?php echo $docente['nome']; ?></h3>
        </div><!--info-perfil-postagem-->
      </div><!--perfil-estudante-->

      <div class="descricao-postagem">
        <p><?php echo $materia['mensagem']; ?></p>

        <?php 
         $documentos = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.materia_documentos` WHERE materia_id = ? ");
         $documentos->execute(array($materia['id']));
         $documentos = $documentos->fetchAll();
         foreach($documentos as $key => $doc){
        ?>

        <div class="items-postagem">
          <a href="<?php echo INCLUDE_PATH ?>ficheiros/documentos/<?php echo $doc['nome_documento']; ?>" target="_blank"><i class="fa fa-file-pdf"></i> <?php echo $doc['nome_documento']; ?> </a>
         </div>
         <?php } ?>
         
      </div><!--descricao-postagem-->

      <div class="button">
       <a href="<?php echo INCLUDE_PATH ?>ficheiros/videos/<?php echo $video['nome_documento']; ?>" download><i class="fa fa-download" ></i> Download</a>
      </div><!--button-->
    </div><!--right-postagem-->
   </div><!--postagem-painel-->
   <?php } ?> 
   <?php }} ?>
</div><!--content-turma-painel--->

<?php } ?>

<?php }else{ ?>
    <?php 
     include ('pages/erro_404.php');
    ?>
 <?php } ?>