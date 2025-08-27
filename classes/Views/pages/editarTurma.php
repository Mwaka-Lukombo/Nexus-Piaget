<?php
 $id_post =  \Views\mainView::$par[3];
 $id_turma = \Views\mainView::$par[2];

 //Verifica se a turma existe 1.0!
 $verica_turma = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma`");
 $verica_turma->execute();
 if($verica_turma->rowCount() <= 0){
   \Painel::redirectJS(INCLUDE_PATH.'turma');
 }
 //Verifica se a postagem existe 1.1!
 $verifica_post = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma_materia` WHERE turma_id = ?");
 $verifica_post->execute(array($id_turma));
 if($verifica_post->rowCount() <= 0){
  \Painel::redirectJS(INCLUDE_PATH.'turma');
 }

 //Verifica se o estudante pertence a turma e ao ano 1.2
 $valida_curso = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma` WHERE id = ?");
 $valida_curso->execute(array($id_turma));
 $valida_curso = $valida_curso->fetchAll();
 foreach($valida_curso as $curso_valido){
   if($curso_valido['curso'] != $_SESSION['curso'] && $curso_valido['ano'] != $_SESSION['ano']){
     \Painel::redirectJS(INCLUDE_PATH.'turma');
   }
 }




?>


<div class="side-turma">
  <div class="items-turma">
    <h2 class="colegas"><i class="fa fa-graduation-cap"></i> Colegas</h2>
    <div class="content-colegas" style="display:none">
    <?php
      $colegas = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE curso = ? AND ano = ?");
      $colegas->execute(array($_SESSION['curso'],$_SESSION['ano']));
      $colegas = $colegas->fetchAll();
      foreach($colegas as $key => $colega){
        if($colega['id_estudante'] == $_SESSION['id'])
               continue;
    ?>
      <div class="row-colegas">
         <div class="perfil-colega">
          <?php
           if($colega['perfil'] == ""){
          ?>
            <i class="fa fa-user"></i>
           <?php }else{ ?>
             <img style="width:100%;height:100%;border-radius:50%;object-fit:cover;background-position:center" src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $colega['perfil']; ?>">
           <?php } ?>
         </div><!--perfil-colega-->
           <div class="nome-colega">
             <p><?php echo $colega['nome']; ?></p>
            </div><!--nome-colega-->
      </div><!--row-colegas-->
      <?php } ?>
    </div><!--content-colegas-->
  </div><!--items-turma-->


  <div class="items-turma">
    <h2><i class="fa-solid fa-chalkboard-user"></i> Turmas</h2>
    <div class="content-colegas">
    <?php
    $turmas = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma` WHERE curso = ? AND ano = ?");
    $turmas->execute(array($_SESSION['curso'],$_SESSION['ano']));
    $turmas = $turmas->fetchAll();
      foreach($turmas as $key => $turma){ 
    ?>
      <div class="row-colegas <?php echo \Painel::verifica_turma($turma['id']); ?>">
           <div class="nome-colega">
             <a style="color:gray" href="<?php echo INCLUDE_PATH ?>turma/<?php echo $turma['id']; ?>" style="color:black"><p><?php echo $turma['nome']; ?></p></a>
            </div><!--nome-colega-->
      </div><!--row-colegas-->
      <?php } ?>
    </div><!--content-colegas-->
  </div><!--items-turma-->
  </div><!--side-->


<?php
   
     foreach($arr['controller']->listarTurma($id_turma) as $key => $turma)
     $docente = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.funcionarios` WHERE id = ?");
     $docente->execute(array($turma['docente_id']));
     $docente = $docente->fetch();
?>
  <section class="sala-content">
    <div class="banner-turma" style="background-size:100% 100%;background-position:center;background-image:url('<?php echo INCLUDE_PATH_PAINEL ?>capa_turma/<?php echo $turma['capa_turma'] ?>');">
    <h4><?php echo "4º Ano"; ?></h4>  
    <div class="content-banner">
        <h2><?php echo $turma['curso']; ?></h2>
        <h3><?php echo $turma['nome']; ?></h3>
        <p><b>Docente:</b> <?php echo $docente['nome']; ?></p>
    </div><!--content-banner-->
</div><!--banner-turma-->

<?php
  foreach($arr['controller']->listarMateria($id_post) as $key => $materia){}
  $estudante = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
  $estudante->execute(array($materia['estudante_id']));
  $estudante = $estudante->fetch();
?>
<section class="post-turma">
  <div class="top-post">
    <div class="perfil-docente-turma left">
      <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $estudante['perfil']; ?>">

   </div><!--perfil-docente-turma-->

   <div class="info-perfil left">
     <h3><?php echo $estudante['nome']; ?></h3>
     <p><?php echo date('d, M Y H:i',strtotime($materia['data'])); ?></p>
   </div><!--info-perfil-->
   <div class="clear"></div><!--clear-->
</div><!--top-post-->

<div class="editar-materia">
<form method="post">
 <div class="input">
    <label><i class="fa fa-comments"></i> Comentario:</label>
  <input type="text" name="comentario" placeholder="Editar comentario" value="<?php echo strip_tags($materia['mensagem']); ?>">
 </div><!--input-->

 <div class="row-editar">
    <?php
     foreach($arr['controller']->listarVideos($id_post) as $key => $videos){
    ?>
  <div class="editar-document">
    <div class="r1">
        <video controls>
         <source src="<?php echo INCLUDE_PATH ?>ficheiros/videos/<?php echo $videos['nome_documento'] ?>" type="video/mp4"></source>
         <source src="movie.ogg" type="video/ogg">
       </video>
    </div><!--r1-->
    <div class="r2">
        <p><?php echo $videos['nome_documento']; ?></p>
    </div><!--r2-->
  </div><!--editar-document-->
<?php } ?>

  <div class="clear"></div><!--clear-->
 </div><!--row-editar-->

 <div class="upload-btn-container">
    <label class="upload-btn">
        <input type="file" name="document[]" multiple class="file-input" accept=".pdf,.doc,.docx,.txt" onchange="uploadFile(this)">
        📄 <!-- Ícone de Documento -->
    </label>
    <label class="upload-btn">
        <input type="file" name="video[]" multiple class="file-input" accept="video/*" onchange="uploadFile(this)">
        📹 <!-- Ícone de Vídeo -->
    </label>
    <label class="upload-btn">
        <input type="file" name="audio[]" multiple accept="audio/*" class="file-input" onchange="addLink(this)">
        🔗 <!-- Ícone de Link -->
    </label>
</div><!--btn-upload-->

 <div class="input">
   <input type="submit" name="atualizar_materia" value="Atualizar!">     
  </div><!--input-->
</form><!--form-edit-->

</div><!--editar-materia-->
</section><!--post-turma-->





  