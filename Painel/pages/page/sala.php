<?php

$verifica = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.funcionarios`");
  $verifica->execute();
  $verifica = $verifica->fetchAll();

  
if(!@isset($_SESSION['login'])){
     \Painel::redirectJS(INCLUDE_PATH);
}

$id_turma = (int)$_GET['id'];

   $nome_turma = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma` WHERE id = ?");
   $nome_turma->execute(array($id_turma));
   $nome_turma = $nome_turma->fetchAll();



   foreach($nome_turma as $value)
?>

<section class="banner-turma" style="background-image:url('capa_turma/<?php echo $value['capa_turma']; ?>');background-size:cover;background-position: center;">
 <h4><?php echo $value['ano']." Ano"; ?></h4>  
<div class="content-banner">
     <h2><?php echo $value['curso']; ?></h2>
     <h3><?php echo $value['nome']; ?></h3>
  </div><!--content-banner-->
</section><!--banner-turma-->


<section class="coment-single-turma">
  <div class="row">
    <div class="perfil-docente-turma">
      <img style="width:100%;height:100%;border-radius: 50%;" src="<?php echo INCLUDE_PATH_PAINEL ?>perfil/<?php echo $_SESSION['img']; ?>">
    </div><!--perfil-docente-->
    <a href="" class="post-turma">Escreva um aviso para a sua turma</a>
  </div><!--row-->
</section><!--coment-single-turma-->


<div class="overlay" style="display:none;">
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

    $materia = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma_materia` WHERE turma_id = ?");
    $materia->execute(array($id_turma));
    $materia = $materia->fetchAll();
   foreach($materia as $key => $value){
    $estudante = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
    $estudante->execute(array($value['estudante_id']));
    $estudante = $estudante->fetch();
?>

<section class="post-turma" style="padding: 15px;">
    <div class="perfil-turma-top">
        <div class="imagem-top">
            <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $estudante['perfil']; ?>">
        </div><!--imagem-top-->
        <p><?php echo $estudante['nome']; ?> <span><?php echo date( 'd , M , Y',strtotime($value['data'])); ?></span></p>
    </div><!--perfil-post-->

    <div class="middle">
        <p><?php echo $value['mensagem']; ?></p>
    </div><!--middle-->

    <div class="row-materia">
        <?php
            $videos = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.materia_videos` WHERE materia_id = ?");
            $videos->execute(array($value['id']));
            $videos = $videos->fetchAll();
            foreach($videos as $key => $video){
        ?>
        <div class="materia-single">
            <div class="capa-materia">
                <video controls>
                  <source src="<?php echo INCLUDE_PATH_PAINEL ?>ficheiros/videos/<?php echo $video['nome_documento']; ?>" type="video/mp4">
                  <source src="<?php echo INCLUDE_PATH ?>ficheiros/videos/<?php echo $video['nome_documento']; ?>" type="video/ogg">
                </video>
            </div><!--capa-materia-->
            <div class="info-materia">
                <p><?php echo $video['nome_documento']; ?></p>
            </div><!--info-mateira-->
        </div><!--materia-single-->
        <?php } ?>

        <div class="clear"></div><!--clear-->
    </div><!--row-materia-->


    <div class="comentario">

        <h3><i class="fa fa-comments-o"></i> <b>0</b> Comentarios na turma</h3>
    <div class="comentarios-single">
        <?php
           $comentarios = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma_comentario` WHERE turma_id = ?");
           $comentarios->execute(array($value['id']));
           $comentarios = $comentarios->fetchAll();
           foreach($comentarios as $key => $comentario){
            $estudante = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
            $estudante->execute(array($comentario['estudante_id']));
            $estudante = $estudante->fetch();



        ?>
        <div class="row" style="margin-bottom: 20px;">
            <div class="perfil-comentario">
                <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $estudante['perfil']; ?>">
            </div><!--perfil-docente-turma-->
            <div class="info-comentario">
                <p><b><?php echo $estudante['nome']; ?></b></p>
                <p><?php echo $comentario['comentario']; ?></p>
                 <p style="font-size: 12px;font-weight: lighter;"><span><?php echo date('d M , Y H:i',strtotime($comentario['data'])); ?></span></p>
            </div><!--infocomentario-->
        </div><!--row-->
    <?php } ?>

    
    </div><!--comentario-single-->

        <div class="perfil-turma-top">
        <div class="imagem-top">
            <img src="<?php echo INCLUDE_PATH_PAINEL ?>perfil/<?php echo $_SESSION['img'] ?>">
        </div><!--imagem-top-->
        <form method="post">
            <input type="text" name="comentario" placeholder="Seu comentario">
            <button><i class="fa fa-send"></i></button>
        </form>
    </div><!--perfil-post-->
    </div><!--comentario-->
    
</section><!--section-post-turma-->
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

</script>