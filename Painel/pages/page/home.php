<?php
 $totalEstudante = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes`");
 $totalEstudante->execute();
 $totalEstudante = count($totalEstudante->fetchAll());
 $totalFuncionarios = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes`");
 $totalFuncionarios->execute();
 $totalFuncionarios = count($totalFuncionarios->fetchAll());


 $noticias = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias_alumin`");
 $noticias->execute();
 $noticias = $noticias->fetchAll(PDO::FETCH_ASSOC);

 $noticiaTotal = count($noticias);



?>
<div class="box">
    <h3>Informações gerais</h3>
    <div class="line"></div><!--line-->

   <div class="row-box"> 
    <div class="box_single left">
      <h3>Usuários online</h3>
      <p>3</p>
    </div><!--box-single-->

    <div class="box_single left">
      <h3>Notícias</h3>
      <p><b><?php echo $noticiaTotal; ?></b></p>
    </div><!--box-single-->

    <div class="box_single left">
      <h3>Total de usuários</h3>
      <p><b><?php echo ($totalEstudante + $totalFuncionarios); ?></b></p>
    </div><!--box-single-->

    

    <div class="clear"></div><!--clear-->
  </div><!--row-box-->

  
  </div><!--box-->