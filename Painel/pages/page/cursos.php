<?php


function verifica($curso){
  $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.cursos` WHERE nome = ?");
  $sql->execute(array($curso));
  if($sql->rowCount() == 1){
    return true;
  }else{
    return false;
  }
}


if(isset($_POST['cadastrar_curso'])){
   $curso = $_POST['curso'];

   if($curso == ""){
      print "<script>alert('Não são permitidos campos vazíos')</script>";
   }else{
     if(verifica($curso) == false){
       $cursos = \Mysql::conectar()->prepare("INSERT INTO `tb_site.cursos` VALUES (null,?)");
      $cursos->execute(array($curso));
      print "<script>alert('Curso Cadastro com sucesso!')</script>";
     }else{
      print "<script>alert('O curso ja existe!')</script>";
     }
  }
}


  

?>


<style>
  .sucesso{
    width: 100%;
    height:50px;
    background:green;
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
  }
</style>

<div class="box">
  <h3>Cursos</h3>
  <div class="line"></div><!--line-->

  <form method="post">
    <label>Cadastrar Curso:</label>
    <div class="form-group">
        <input type="text" name="curso" placeholder="Nome do curso">
    </div><!--form-group-->

    <div class="form-group">
      <input type="submit" name="cadastrar_curso" value="Enviar Curso">
    </div><!--form-group-->
    <br><br>

    <div class="form-group">
        <label>Cursos Existentes:</label>    
        <br><br>
<table style="overflow-x:auto">
  <tr>
    <th>Id</th>
    <th>Nome do Curso</th>
    <th>Editar</th>
    <th>Excluir</th>  
  </tr>
  <?php

// for($i = 1 ; $i <= 4; $i++){
//   $curso = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.cursos`");
//   $curso->execute();
//   $curso = $curso->fetchAll();
//   foreach($curso as $key => $value){
//   $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.ano` VALUES (null,?,?)");
//   $sql->execute(array($i.'º',$value['nome']));
//  }
// }

    $todos_cursos = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.cursos`");
    $todos_cursos->execute();
    $todos_cursos = $todos_cursos->fetchAll();
     foreach($todos_cursos as $key => $value){
  ?>
  <tr>
    <td><?php echo $value['id']; ?></td>
    <td><?php echo $value['nome']; ?></td>
    <td><a href="editar-curso?editar_curso=<?php echo $value['id']; ?>" class="editar"><i class="fa fa-pencil"></i> Editar</a></td>
    <td><a href="cursos?excluir_curso=<?php echo $value['id']; ?>" class="delete"><i class="fa fa-trash"></i> Apagar</a></td>
  </tr>
  <?php } ?>

</table>
    </div><!--form-group-->

   
  </form>
</div><!--box-->