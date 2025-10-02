<?php
  if(!@$_SESSION['login']){
      \Painel::redirectJS(INCLUDE_PATH);
  }
  

  $id_curso = explode('/',$_GET['url'])[1];

  $nome_curso = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.cursos` WHERE id = ?");
  $nome_curso->execute(array($id_curso));
  $nome_curso = $nome_curso->fetch();




?>


<section class="side-forum" style="padding-top:50px">

 <div class="forum-section" style="padding:20px">
    
  <div class="cadastrar-curso"> 
    <h3 style="color:#fff;font-size:20px;font-weight:normal;text-align:center">Curso de : <?php echo $nome_curso['nome'] ?></h3>
  </div><!--cadastrar-curso-->

  <div class="cadastrar-curso"> 
  <h3><a href="<?php echo INCLUDE_PATH ?>forum"> Fórum</a> </h3> <span style="margin:0 12px;font-size:20px;color:white"> > </span> <a href="<?php echo INCLUDE_PATH ?>forum/<?php echo $id_curso; ?>">Topicos</a>
  </div><!--cadastrar-curso-->


  
     

<table>
  <tr>
    <th>Topicos</th>
    <th>Interações</th>
  </tr>
  
<?php

  $topicos = \Controllers\topicosController::listarTopicos($id_curso);

  foreach($topicos as $key => $value){

    $interacao = \Mysql::conectar()->prepare("SELECT * FROM `tb_site_forum.post` WHERE id_topico = $value[id]");
    $interacao->execute();
    $interacao = $interacao->fetchAll();

    $ultimo = \Mysql::conectar()->prepare("SELECT nome FROM `tb_site_forum.post` WHERE id_topico = ? ORDER BY id DESC");
    $ultimo->execute(array($value['id']));
    $ultimo = $ultimo->fetchColumn();
   
?>
  <tr>
    <td style="width:70%"><a href="<?php echo $id_curso ?>/<?php echo $value['id'] ?>"><?php echo $value['topico']; ?></a></td>
    <td><span style="font-size:14px;font-weight:normal"><?php echo $ultimo ?><b style="margin-left:20px;font-size:18px"><i class="fa fa-comments"></i> <span style="font-size:13px"><?php echo count($interacao); ?></span></b></span></td>
  </tr>

<?php } ?>


  


</table>
</div><!--forum-section-->
</section><!--side-forum-->