<?php
$estudante_id = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes_antigos` WHERE email = ?");
$estudante_id->execute(array($_SESSION['email']));
$estudante_id = $estudante_id->fetch();

if(isset($_GET['deletar'])){
  $noticia_id = (int)$_GET['deletar'];

  $sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site.noticias_alumin` WHERE id = ?");
  $sql->execute(array($noticia_id));
  $sql_1 = \Mysql::conectar()->prepare("DELETE FROM `tb_site.noticias_alumin_like` WHERE noticia_id = ?");
  $sql_1->execute(array($noticia_id));
  $sql_2 = \Mysql::conectar()->prepare("DELETE FROM `tb_site.guardados_noticia` WHERE noticia_id =  ?");
  $sql_2->execute(array($noticia_id));
  \Painel::mensagem('sucesso','Noticia Excluida com sucesso!');
  \Painel::redirectJS(INCLUDE_PATH_PAINEL.'gerenciar_postagens');
}



 if(isset($_POST['acao'])){
  $noticia =  $_POST['noticia'];
  $video = @$_FILES['video'];

  $dir = 'ficheiros_noticias/videos/';


  
  move_uploaded_file($video['tmp_name'],$dir.$video['name']);
  $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.noticias_alumin` VALUES (null,?,?,?)");
  if($sql->execute(array($estudante_id['id'],$video['name'],$noticia))){
     \Painel::mensagem('sucesso','Noticia cadastrada com sucesso!');
  }else{
    \Painel::mensagem('erro','Falha ao cadastrar a noticia!');
  }
  
 }

?>


<div class="box-content">
  <div class="wellcome">
     <h3>Gerenciar Postagens</h3>
     </div><!--wellcome-->
     <div class="flex">
<div class="flex"> 
     <form method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="nome">Nome Completo:</label>
          <input type="text" name="nome" placeholder="Seu nome....">
        </div><!--form-group-->

        <div class="form-group">
          <label for="video">Video:</label>
          <input type="file" name="video" accept="video/*">
        </div><!--form-group-->

        <div class="form-group">
          <label for="nome">Descricao:</label>
          <textarea name="noticia" placeholder="Mensagem"></textarea>
        </div><!--form-group-->

        <div class="form-group">
          <input type="submit" name="acao">
        </div><!--form-group-->
     </form>
  

</div><!--flex--> 

     </div><!--flex-->
</div><!--box-content-->


<div class="box-content" style="margin-top:20px">
<div class="wellcome">
     <h3>Gerenciar Postagens</h3>
     </div><!--wellcome-->
<div class="gerenciar-row" style="margin:30px 0">
    <?php

      

      $noticias = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias_alumin` WHERE estudante_id = ?");
      $noticias->execute(array($estudante_id['id']));
      $noticias = $noticias->fetchAll();
      foreach($noticias as $value){
    ?>
     <div class="gerenciar-single">
       <div class="top">
       <video controls muted autoplay>
        <source src="<?php echo INCLUDE_PATH_PAINEL ?>ficheiros_noticias/videos/<?php echo $value['video']; ?>" type="video/mp4">
        <source src="movie.ogg" type="video/ogg">
       </div><!--top-->
       <div class="bottom">
         <p><?php echo $value['noticia'] ?></p>
          <div class="button">
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar_postagens?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</i>
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar_postagens?deletar=<?php echo $value['id']; ?>"><i class="fa fa-trash"></i> Apagar</a>
           </div><!--button-->
        </div><!--bottom-->
     </div><!--gerenciar-single-->
    <?php } ?>
  </div><!--gerenciar-row-->

      </div><!--content-->