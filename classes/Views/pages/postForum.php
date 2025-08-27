<?php

$id_curso = explode('/',$_GET['url'])[1];
$idTopico = explode('/',$_GET['url'])[2];
$id_usuario = @$_SESSION['id'];


$nomeTopico = \Mysql::conectar()->prepare("SELECT topico FROM `tb_site_forum` WHERE id = ?");
$nomeTopico->execute(array($idTopico));
$nomeTopico = $nomeTopico->fetch()['topico'];



  if(!@isset($_SESSION['login'])){
    \Painel::redirectJS(INCLUDE_PATH);
  }
?>


<style>
 
  body,html{
    background:rgba(167, 171, 176,0.7);
    min-height:100vh;
  }

  div.deletar_post_forum a{
    font-size:22px;
    color:#8a1a20;
  }

  div.deletar_post_forum a:hover{
    color:#421013;
  }
</style>
<!-- 
<div class="overlay">
  <i class="fa fa-close"></i>
  <div class="box container forum_cadastro">
     <form method="post">
       <textarea placeholder="Faça a sua publicação" name="publicacao"></textarea>
       <input type="submit" name="cadastrar" value="Publicar" class="btn">
     </form>
  </div>
</div> -->




<div class="cadastrar-curso" style="padding-top:150px;margin-bottom:100px"> 
  <h3 style="color:black"><a href="<?php echo INCLUDE_PATH ?>forum"> Fórum</a> </h3> <span style="margin:0 12px;font-size:20px;color:black"> > </span> <a style="color:black" href="<?php echo INCLUDE_PATH ?>forum/<?php echo $id_curso; ?>">Topicos</a> <span style="margin:0 12px;font-size:20px;color:black"> > </span><a style="color:black" href=""><?php echo $nomeTopico; ?></a>
  </div><!--cadastrar-curso-->

<?php
$postagens = \Controllers\forumPostController::ListarForumPost($idTopico);
  foreach($postagens as $key => $value){
?>
<div class="post_forum_single" style="width:95%;margin-bottom:50px">
  <div class="perfil_user">
    <div class="avatar"> 
     <img src="<?php echo INCLUDE_PATH ?>img/user.png">
   </div><!--avatar--> 
  </div><!--perfil-user-->

  <div class="postagem_forum">
    <?php
      if($value['cargo'] == 1){
    ?>
    <h3><?php echo cargos[$value['cargo']] ." ". $value['nome']; ?></h3>
    <?php }else if($value['cargo'] == 3){ ?>
      <h3><?php echo cargos[$value['cargo']] ?></h3>
    <?php }else{ ?>
     <h3><?php echo  $value['nome']; ?></h3>
    <?php } ?>
    <p><?php echo $value['mensagem'] ?></p>
  </div><!--postagem_forum-->
  
  <?php

  $url = explode ('/',$_GET['url'])[1];

    if($value['id_usuario'] == $_SESSION['id']){
  ?>
  <div class="deletar_post_forum">
    <a href="<?php echo INCLUDE_PATH?>forum/<?php echo $url."/".$value['id_topico'] ?>?deletarPost=<?php echo $value['id'] ?>"><i class="fa fa-trash"></i></a>
  </div><!--deletar_post_forum_-->
   <?php } ?>

 
</div><!--post_forum_single-->
<?php   } ?>

<?php
 
?>
<section class="resposta">
   <div class="perfil_resposta"> 
     <img src="<?php echo INCLUDE_PATH ?>img/user.png">
  </div><!--perfil-resposta-->
   <form method="post" style="z-index:11">
     <textarea id='textarea' name="publicacao" placeholder="Responder tópico"></textarea>
     <input type="submit" name="cadastrar_forum" value="Salvar">
  </form>
</section>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

$(document).ready(function(){
    function scrollToBottom() {
        $("html, body").animate({ scrollTop: $(document).height() }, 800);
    }

    
    scrollToBottom();


    $("form").on("submit", function() {
        setTimeout(scrollToBottom, 500);
    });
});

</script>