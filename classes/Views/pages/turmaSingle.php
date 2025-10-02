<?php

$id_turma = explode('/',$_GET['url'])[1];
  if(!@$_SESSION['login']){
      \Painel::redirectJS(INCLUDE_PATH);
  }

  if(!isset($id_turma)){
    \Painel::redirectJS(INCLUDE_PATH);
  }

  $verica_turma = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma`");
  $verica_turma->execute();
  if($verica_turma->rowCount() == 0){
     print "<script>alert('A turma nao existe')</script>";
    \Painel::redirectJS(INCLUDE_PATH.'turma');
  }

 //Verifica se o estudante pertence a turma e ao ano
  $valida_curso = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma` WHERE id = ?");
  $valida_curso->execute(array($id_turma));
  $valida_curso = $valida_curso->fetchAll();
  foreach($valida_curso as $curso_valido){
    if($curso_valido['curso'] != $_SESSION['curso'] && $curso_valido['ano'] != $_SESSION['ano']){
      \Painel::redirectJS(INCLUDE_PATH.'turma');
    }
  }

 

  $nome_turma = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma` WHERE id = ?");
  $nome_turma->execute(array(($id_turma)));
  $nome_turma = $nome_turma->fetchAll();


  $capa_turma = \Mysql::conectar()->prepare("SELECT capa_turma FROM `tb_site.turma` WHERE id = ?");
  $capa_turma->execute(array($id_turma));
  $capa_turma = $capa_turma->fetch()['capa_turma'];

  foreach($nome_turma as $value)
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

<section class="sala-content">
    <div class="banner-turma" style="background-size:100% 100%;background-position:center;background-image:url('<?php echo INCLUDE_PATH_PAINEL ?>capa_turma/<?php echo $capa_turma; ?>');">
     <div class="overlay_top" style="border-radius:12px"></div>
    <h4><?php echo $value['ano']."º Ano"; ?></h4>  
    <div class="content-banner">
        <h2><?php echo $value['curso']; ?></h2>
        <h3><?php echo $value['nome']; ?></h3>
        <p><b>Docente:</b> <?php echo $value['nome_docente']; ?></p>
    </div><!--content-banner-->
</div><!--banner-turma-->


<section class="coment-single-turma">
  <div class="row">
    <div class="perfil-docente-turma">
      <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $_SESSION['img']; ?>">
    </div><!--perfil-docente-->
    <a href="" class="post-turma">Escreva um aviso para a sua turma</a>
  </div><!--row-->
</section><!--coment-single-turma-->

<div class="overlay" style="display:none">
  <div class="close">
   <span>X</span>
  </div><!--close-->

 <div class="section-post-materia"> 
 <h3 class="title">Universidade <b>Jean Paiget</b> de Moçambique <span><img src="<?php echo INCLUDE_PATH ?>img/Logo_white_on_darkred.png"></span></h3>




  <form method="post" enctype="multipart/form-data">
  <div class="editor-container">
    <textarea style="postition:relative;z-index:999" class="editor-textarea" name="mensagem" placeholder="Escreva um aviso para sua turma"></textarea>
</div>
    
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
</div>
<div class="post-buttons">
    <button onclick="cancelPost()">Cancelar</button>
    <button onclick="submitPost()" name="cadastrar_info">Postar</button>
</div>

  </form><!--form-->
</div><!--post-materia--> 
</div><!--overlay-->

<?php
  foreach($arr['controller']->listarPosts($id_turma) as $key => $value){
    $estudante = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
    $estudante->execute(array($value['estudante_id']));
    $estudante = $estudante->fetchAll();

  
    foreach($estudante as $key => $dados){}
?>
<section class="post-turma">
  <div class="top-post">
    <div class="perfil-docente-turma left">
      <?php
          if($dados['perfil'] == ''){
      ?>
      <i class="fa fa-user"></i>
    <?php }else{ ?>
      <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $dados['perfil']; ?>">
    <?php } ?>
   </div><!--perfil-docente-turma-->

   <div class="info-perfil left">
     <h3><?php echo $dados['nome']; ?></h3>
     <p><?php echo date('d, M Y H:i',strtotime($value['data'])); ?></p>
   </div><!--info-perfil-->

   <div class="dots right">
     <i class="fa-solid fa-ellipsis-vertical"></i>

     <div class="Menu-dots" style="display:none">
    <!-- Servira para apagar as publicacoes -->
     <a href="?publicacao=<?php echo $value['id']; ?>"><i class="fa fa-trash"></i> Apagar Publicação</a>
     <a href="<?php echo INCLUDE_PATH ?>turma/<?php echo $id_turma  ?>/<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar Publicação</a>
   </div><!--Menu-dots-->
   </div><!--dots-->
 
   <div class="clear"></div><!--clear-->
</div><!--top-post-->

<div class="post-bottom">
 <p><?php echo $value['mensagem']; ?></p>
 <div class="row-file">


 
 <?php
  foreach($arr['controller']->listarVideos($value['id']) as $key => $videos){
 ?>
  <div class="file-single left">
   <video controls>
      <source src="<?php echo INCLUDE_PATH ?>ficheiros/videos/<?php echo $videos['nome_documento']; ?>" type="video/mp4">
      <source src="movie.ogg" type="video/ogg">
   </video>
   <div class="info-file right">
      <p><?php echo $videos['nome_documento'];  ?></p>
   </div><!--info-file-->

   <div class="clear"></div>
  </div><!--file-single-->
<?php } ?>



<?php
  foreach($arr['controller']->listarDocumentos($value['id']) as $key => $documento){
 ?>
  <div class="file-single left">
    <div class="place-holder-pdf left">
      <p>PDF</p>
     </div><!--place-holder-->
   <div class="info-file">
      <a href="<?php echo INCLUDE_PATH ?>ficheiros/documentos/<?php echo $documento['nome_documento']; ?>" target="_blank"><?php echo $documento['nome_documento'];  ?></a>
      <a href="<?php echo INCLUDE_PATH ?>ficheiros/documentos/<?php echo $documento['nome_documento']; ?>" download> Baixar</a>
   </div><!--info-file-->
   <div class="clear"></div><!--clear-->
  </div><!--file-single-->
<?php } ?>

<?php
  foreach($arr['controller']->listarAudios($value['id']) as $key => $audio){
 ?>
  <div class="file-single left">
   <audio controls>
      <source src="<?php echo INCLUDE_PATH ?>ficheiros/audios/<?php echo $audio['nome_documento']; ?>" type="audio/mp3">
      <source src="movie.ogg" type="audio/ogg">
  </audio>
   <div class="info-file">
      <p><?php echo $audio['nome_documento'];  ?></p>
   </div><!--info-file-->
  </div><!--file-single-->
<?php } ?>

  <div class="clear"></div><!--clear-->
</div><!--row-file-->

</div><!--post-bottom-->
<?php
  
?>
<div class="comentario-post">

  <?php
    foreach($arr['controller']->listarComentario($value['id']) as $key => $comentario){
      $estudante = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
      $estudante->execute(array($comentario['estudante_id']));
      $estudante = $estudante->fetch();

  ?>
  <?php
    $total = count($arr['controller']->listarComentario($value['id']));

  ?>
<div class="comentario-single" <?php if($total == 0) echo 'style="display:none"' ?>> 
    <div class="perfil">
       <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $estudante['perfil'];?>">
     </div><!--perfil-->
     <div class="comentario-info">
        <h4><?php echo $estudante['nome']; ?></h4>
        <p><?php echo $comentario['comentario']; ?> <span><?php echo date('d , M . Y H:i',strtotime($comentario['data'])); ?></span></p>
     </div><!--comentario-info-->
     <?php
       if($comentario['estudante_id'] == $_SESSION['id']){
      ?>
     <div class="deletar_comentario">
      <a href="<?php echo INCLUDE_PATH ?>turma/<?php echo $id_turma; ?>/?deletarComentario=<?php echo $comentario['id'] ?>"><i class="fa fa-trash"></i></a>
    </div><!--deletar_comentario-->
      <?php } ?>
  </div><!--comentario-single-->
 <?php } ?>

 
<?php
   $total = count($arr['controller']->listarComentario($value['id']));
   if($total >= 1){
?>
 <h3 id="visualizar_comentario"><i class="fa fa-users"></i> <b><?php echo $total; ?></b> <span id="conteudo_comentario">Mais Comentários</span></h3>
 <?php } ?>
 

<div class="clear"></div><!--clear-->
</div><!--comentario-post-->

<div class="form-comentario">
  <form method="post">
    <span><img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $_SESSION['img']; ?>"></span>
    <input type="text" name="comentario" placeholder="Seu comentario***">
    <input type="hidden" name="turma_id" value="<?php echo $value['id']; ?>">
    <button type="submit" name="comentar"><i class="fa fa-send"></i></button>
  </form><!--post-->
</section><!--post-turma-->

<?php } ?>








</section><!--sala-content-->

<script src="<?php echo INCLUDE_PATH ?>js/jquery-3.7.1.js"></script>
<script src="<?php echo INCLUDE_PATH ?>tinymce/tinymce.min.js"></script>
<script>
$(function(){
//   tinymce.init({
//   selector: 'textarea'
// });

tinymce.init({
            selector: 'textarea',
            toolbar: 'bold italic underline | bullist numlist | link emoticons',
            plugins: 'link emoticons',
            height:300,
            content_css: 'path/para/editor-style.css',
        });
})


var bottom = document.querySelector("div.comentario-post");
var comentario = document.querySelector("#conteudo_comentario");
var visualizar = document.querySelectorAll('#visualizar_comentario');

  

  
document.getElementById('visualizar_comentario').addEventListener("click",function(e){
  e.preventDefault();

  

     bottom.style.overflow = "auto";
     bottom.style.transition = "6s ease";
     bottom.style.height = "auto";
     comentario.innerText = "Menos Comentários";
})

document.getElementById('visualizar_comentario').addEventListener("dblclick",function(e){
  e.preventDefault();

     bottom.style.transition = "6s ease";
     bottom.style.overflow = "hidden";
     bottom.style.height = "100px";
     comentario.innerText = "Mais Comentários"
})

</script>