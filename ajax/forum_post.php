<?php
include ('../config.php');

$topico = $_POST['topico'];

$post = \Mysql::conectar()->prepare("SELECT * FROM `tb_site_forum.post` WHERE id_topico = ?");
$post->execute(array($topico));
$post = $post->fetchAll();

foreach($post as $key => $value){

print '
<div class="row-post-forum">
<div class="post_forum_single" style="width:95%;margin-bottom:50px">
  <div class="perfil_user">
    <div class="avatar"> 
     <img src="'.INCLUDE_PATH.'img/user.png">
   </div><!--avatar--> 
  </div><!--perfil-user-->

  <div class="postagem_forum">
    <h3>'.$value['nome'].'</h3>
    <p>'.$value['mensagem'].'</p>
  </div><!--postagem_forum-->
</div><!--post_forum_single-->
</div><!--row-->


';
   
}

?>
<?php

if(isset($_POST['acao'])){


  print "noticia cadastrada com sucesso!";
}


?>


