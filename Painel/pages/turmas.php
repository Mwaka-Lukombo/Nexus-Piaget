
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
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>turmas/?editar=<?php echo $value['id'] ?>" style="background:orange"><i class="fa fa-pencil"></i> Editar</a>
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
  $materia = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma_materia` WHERE turma_id = ? ");
  $materia->execute(array($turmaID));
  $materia = $materia->fetchAll();
   foreach($materia as $key => $materia){
    $videos = \Mysql::conectar()->prepare("SELECT * from `tb_site.materia_videos` WHERE materia_id = ? AND estudante_id = ?");
    $videos->execute(array($materia['id'],$materia['estudante_id']));
    $videos = $videos->fetchAll();
    foreach($videos as $key => $video){
    $estudante = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
    $estudante->execute(array($materia['estudante_id']));
    $estudante = $estudante->fetch();
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
   <?php }} ?>
</div><!--content-turma-painel--->

<?php } ?>