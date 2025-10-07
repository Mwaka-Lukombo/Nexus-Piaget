<?php


if($_SESSION['cargo'] == 3){
?>

<div class="box-content">
  <div class="wellcome">
    <h3>Suporte</h3>
  </div><!--wellcome-->

<?php
    if(!isset($_GET['tipo'])){
?>
  <!-- suporte types -->
  <div class="row-elements">
    <?php
        $tipo_erro = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.tipo_assitencia`");
        $tipo_erro->execute();
        $tipo_erro = $tipo_erro->fetchAll();
        foreach($tipo_erro as $key => $value){
    ?>
    <div class="single-element" key="<?php echo $key; ?>">
      <a href="<?php echo INCLUDE_PATH_PAINEL ?>suporte?tipo=<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></a>
    </div><!--single-element-->
   <?php } ?>

  </div><!--row-elements-->
  <?php }else{ ?>
      <h2>Dados buscados</h2>
   <?php } ?>
  
</div><!--box-content-->



<?php }else{ ?>
 <?php
  include ('pages/erro_404.php');
 ?>
<?php } ?>