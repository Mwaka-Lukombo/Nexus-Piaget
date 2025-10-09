<?php

$id = explode('/',$_GET['url'])[1];




$problema = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.assistencia` WHERE id = ?");
$problema->execute(array($id));
$problema = $problema->fetch();

$tipo = \Mysql::conectar()->prepare("SELECT nome FROM `tb_site.tipo_assitencia` WHERE id = ?");
$tipo->execute(array($id));
$tipo = @$tipo->fetch()['nome'];

//delete resposta
if(isset($_GET['delete'])){
  $delete_id = (int)$_GET['delete'];
  
  $sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site.assistencia` WHERE id = ?");
  if($sql->execute(array($delete_id))){
    \Painel::mensagem("sucesso","Item deletado com sucesso!");
    \Painel::redirectJS(INCLUDE_PATH.'assistencia');
  }
}

?>

<div class="box-content-respostas">
 <div class="btn-delete-resposta">
   <a href="<?php echo INCLUDE_PATH ?>assistencia/<?php echo $id ?>/?delete=<?php echo $id; ?>"><i class="fa fa-trash"></i></a> 
 </div><!--btn-delete-resposta-->

 <div class="clear"></div>

  <h3>Problema: <span style="text-decoration:underline"><?php echo $tipo; ?></span></h3>
  <div class="row-pergunta">
    <p><?php echo $problema['problema']; ?></p>
  </div><!--row-pergunta-->

    <h3>Resposta:</h3>
  <div class="row-pergunta">
    <?php
      $resposta = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.assistencia.resposta` WHERE assistencia_id = ?");
      $resposta->execute(array($id));
      $resposta = $resposta->fetch();
    ?>
    <p><?php echo $resposta['resposta']; ?></p>
  </div><!--row-pergunta-->
</div><!--box-content-respostas-->