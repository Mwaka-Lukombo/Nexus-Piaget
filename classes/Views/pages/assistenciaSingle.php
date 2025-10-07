<?php

$id = explode('/',$_GET['url'])[1];




$problema = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.assistencia` WHERE id = ?");
$problema->execute(array($id));
$problema = $problema->fetch();

$tipo = \Mysql::conectar()->prepare("SELECT nome FROM `tb_site.tipo_assitencia` WHERE id = ?");
$tipo->execute(array($id));
$tipo = $tipo->fetch()['nome'];

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
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit facere quaerat inventore eos, obcaecati possimus illo unde nisi sapiente ab beatae id ipsam in sit nostrum quisquam repellendus, velit assumenda?
    Sed itaque temporibus autem blanditiis veniam, libero, quos eius voluptas minima tenetur cumque distinctio harum eum ipsa minus dolor ex sapiente dolorum deserunt totam laborum non corporis hic? Exercitationem, ab.
    Natus, officiis totam aspernatur temporibus dolorum voluptatem nostrum voluptas in ab voluptatibus omnis quam amet modi voluptates neque ut est explicabo, rerum nam velit odit, fugit nulla? Fugiat, ex quae!Fugiat, ex quae!
Fugiat, ex quae!
Fugiat, ex quae!
</p>
  </div><!--row-pergunta-->
</div><!--box-content-respostas-->