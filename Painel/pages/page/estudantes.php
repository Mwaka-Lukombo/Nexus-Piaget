<?php


?>
<div class="box">
  <h3>Estudantes</h3>
  <div class="line"></div><!--line-->
  
<table style="overflow-x:auto">
  <tr>
    <th>Nome</th>
    <th>Email</th>
    <th>Curso</th>
    <th>Editar</th>
    <th>Excluir</th>
  </tr>
  <?php
    $estudantes = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes`");
    $estudantes->execute();
    $estudantes = $estudantes->fetchAll();
     foreach($estudantes as $key => $value){
  ?>
  <tr>
    <td><?php echo $value['nome']; ?></td>
    <td><?php echo $value['email']; ?></td>
    <td><?php echo $value['curso']; ?></td>
    <td><a href="editar-estudante?editar=<?php echo $value['id_estudante']; ?>" class="editar"><i class="fa fa-pencil"></i> Editar</a></td>
    <td><a href="estudantes?excluir=<?php echo $value['id_estudante']; ?>" class="delete"><i class="fa fa-trash"></i> Apagar</a></td>
  </tr>
  <?php } ?>

</table>
</div><!--box -->

