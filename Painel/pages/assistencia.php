<?php





if($_SESSION['cargo'] == 3){

?>

<div class="box-content">
  <div class="wellcome">
    <h3>Assistência</h3>
  </div><!--wellcome-->

  <div class="assistence-row">


  </div><!--assistence-row-->
 
</div><!--box-content-->



<?php }else{ ?>
 <?php 
   include('pages/erro_404.php');
 ?>
<?php } ?>











