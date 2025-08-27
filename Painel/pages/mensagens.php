<?php


  if(!isset($_GET['MSingle'])){
?>

<div class="box-content">
 <div class="wellcome">
  <h3>Mensagens</h3>
 </div><!--wellcome-->
 <?php 
    $chat = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.alumin_chat`
    GROUP BY estudante_id");
    $chat->execute();
    $chat = $chat->fetchAll(PDO::FETCH_ASSOC);
     foreach($chat as $value){
      $estudante = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
      $estudante->execute(array($value['estudante_id']));
      $estudante = $estudante->fetch();
    ?>
 <div class="row-mensagens">
   
   <div class="mensagem-content-menu">
      <div class="avatar" style="width:60px;height:60px">
        <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $estudante['perfil']; ?>">
      </div><!--avatar-->

      <div class="bottom">
         <h5 style="text-transform:Captalize"><?php echo $estudante['nome']; ?></h5>
         <a href="<?php echo INCLUDE_PATH_PAINEL ?>mensagens?MSingle=<?php echo $estudante['id_estudante']; ?>"><?php echo $value['mensagem']; ?></a>
      </div>
      
      <div class="notification right">
        <i class="fa fa-trash"></i>
      </div><!--notification-->
      <div class="clear"></div>
    </div><!--mensagem-content-menu-->
 </div><!--row-mensagens-->
<?php } ?>
</div><!--box-content-->
<?php }else{ ?>

  <?php
    $estudante_id = (int)$_GET['MSingle'];

    $estudante = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
    $estudante->execute(array($estudante_id));
    $estudante = $estudante->fetch();
  ?>
 <div class="chat-single-box">
  <div class="chat-top">
    <div class="flex" style="align-items:center">
      <div class="avatar" style="width:50px;height:50px">
       <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $estudante['perfil']; ?>">
       </div><!--avatar-->
       <div class="info">
         <h5><?php echo $estudante['nome']; ?></h5>
       </div><!--info-->
    </div><!--flex-->
  </div><!--chat-top-->

  <div class="bottom-chat-single">
    <?php

    $chat = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.alumin_chat` WHERE estudante_id = ? AND aluno_id = ?");
    $chat->execute(array($estudante_id,$_SESSION['id']));
    $chat = $chat->fetchAll();
    foreach($chat as $value){
?>
     <div class="chat-single">
       <a href=""><?php echo $value['mensagem']; ?></a>
     </div><!--chat-single-->
    <?php } ?>
  </div><!--bottom-chat-single-->
  <form method="post">
    <input type="text" name="chat" placeholder="Digite a mensagem">
    <input type="submit" name="acao" value="Chat">
  </form>
 </div><!--chat-single--box-->
<?php } ?>