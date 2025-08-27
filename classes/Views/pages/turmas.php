<?php


  if(!@$_SESSION['login']){
      \Painel::redirectJS(INCLUDE_PATH);
  }

  

?>

<section class="turmas">
 <div class="turma_content"> 
  <h3 class="title" style="color:rgba(167, 171, 176,0.7)">Acesse as turmas e baixe os materias</h3>
  <div class="row-turmas">
  <?php


  foreach($arr['controller']->listarTurmas() as $key => $value){
    $img_docente = \Mysql::conectar()->prepare("SELECT perfil FROM `tb_site.funcionarios` WHERE id = ?");
    $img_docente->execute(array($value['docente_id']));
    $img_docente = $img_docente->fetch()['perfil'];
?>
  <div class="turma-single">
      <div class="top" style="background-image:url('<?php echo INCLUDE_PATH_PAINEL ?>capa_turma/<?php echo $value['capa_turma']; ?>'">
         <div class="overlay_top"></div><!--overlay--> 
      <h2><?php echo $value['curso']; ?></h2>
        <h3><a href="turma/<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></a></h3>
        <p><?php echo $value['nome_docente']; ?></p>

        <div class="perfil-docente">
            <img style="object-fit:cover;background-position:center" src="<?php echo INCLUDE_PATH_PAINEL ?>perfil/<?php echo $img_docente; ?>">
        </div><!--perfil-docente-->
      </div><!--top-->
      <div class="roda-pe-bottom"></div><!--roda-pe-bottom-->
    </div><!--turma-single-->
  <?php } ?>
 </div><!--row-turmas-->
  </div><!--turma_content-->
</section><!--turmas-->