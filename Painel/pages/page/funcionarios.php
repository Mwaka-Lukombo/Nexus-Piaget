<?php


  

  if(isset($_POST['acao'])){
     $nome = $_POST['nome'];
     $email = $_POST['email'];
     $perfil = @$_FILES['imagem'];
     $senha = rand(100,100000000);
     $cargo = $_POST['cargo'];

     $dir = 'perfil/';
     $ok = true;

      if($cargo == 2){
      $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.estudantes_antigos` VALUES (null,?,?,?)");
      $sql->execute(array($nome,$email,$perfil['name']));
     }


     if($ok){
     	move_uploaded_file($perfil['tmp_name'],$dir.$perfil['name']);
     	$sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.funcionarios` VALUES (null,?,?,?,?,?)");
     	$sql->execute(array($nome,$email,$senha,$perfil['name'],$cargo));
     	print "<script>alert('Usuario Cadastrado com sucesso!')</script>";
     }








  }

?>
<div class="box">
  <h3 class="title"><i class="fa fa-pecinl"></i> Casdastrar Funcionários</h3>
   <div class="line"></div><!--line-->
    <form method="post" enctype="multipart/form-data">
    	<div class="form-group">
    		<label>Nome:</label>
    		<input type="text" name="nome" placeholder="Nome completo...." required>
    	</div><!--form-group-->

    	<div class="form-group">
    		<label>E-mail:</label>
    		<input type="text" name="email" placeholder="Email ...." required>
    	</div><!--form-group-->

    	<div class="form-group">
    		<label>Perfil:</label>
    		<input type="file" name="imagem" required>
    	</div><!--form-group-->

    	<div class="form-group">
    		<label>Senha:</label>
    		<input type="text" name="senha" disabled placeholder="Este campo é definido automaticamente">
    	</div><!--form-group-->

    	<div class="form-group">
    		<label>Cargo:</label>
    		<select name="cargo" required>
    			<?php
    			   foreach(cargos as $key => $value){
    			   	 if($key < 3){
	    		 ?>
    			<option value="<?php echo $key ?>"><?php echo $value ?></option>
    			    <?php }} ?>
    			
    		</select>
    	</div><!--form-group-->

    	<div class="form-group">
    		<input type="submit" name="acao" value="Casdastrar">
    	</div><!--form-group-->
    </form>
</div><!--box-->
<br>
<div class="box">
    <h3 class="title">Listar Funcionarios</h3>
      <div class="line"></div>

<table style="overflow-x:auto">
  <tr>
    <th>Nome</th>
    <th>Email</th>
    <th>Senha</th>
    <th>Cargo</th>
    <th>Editar</th>
    <th>Excluir</th>
  </tr>
  <?php
    $estudantes = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.funcionarios` WHERE cargo = 0 OR cargo = 1");
    $estudantes->execute();
    $estudantes = $estudantes->fetchAll();
     foreach($estudantes as $key => $value){
     	if($value['cargo'] < 2){
  ?>
  <tr>
    <td><?php echo $value['nome']; ?></td>
    <td><?php echo $value['email']; ?></td>
    <td><?php echo $value['senha']; ?></td>
    <td><?php echo cargos[$value['cargo']]; ?></td>
    <td><a href="editar-funcionario?editar=<?php echo $value['id']; ?>" class="editar"><i class="fa fa-pencil"></i> Editar</a></td>
    <td><a href="funcionarios?excluir=<?php echo $value['id']; ?>" class="delete"><i class="fa fa-trash"></i> Apagar</a></td>
  </tr>
  <?php }} ?>

</table>
</div><!--box-->

<div class="box" style="margin-top: 20px;margin-bottom: 100px;">
  <h3>Antigos estudantes</h3>
   <div class="line"></div>

   <table style="overflow-x:auto">
  <tr>
    <th>Nome</th>
    <th>Email</th>
    <th>Senha</th>
    <th>Status</th>
    <th>Editar</th>
    <th>Excluir</th>
  </tr>
  <?php
    $estudantes = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.funcionarios` WHERE cargo = 2");
    $estudantes->execute();
    $estudantes = $estudantes->fetchAll();
     foreach($estudantes as $key => $value){
      
  ?>
  <tr>
    <td><?php echo $value['nome']; ?></td>
    <td><?php echo $value['email']; ?></td>
    <td><?php echo $value['senha']; ?></td>
    <td><?php echo cargos[$value['cargo']]; ?></td>
    <td><a href="editar-funcionario?editar=<?php echo $value['id']; ?>" class="editar"><i class="fa fa-pencil"></i> Editar</a></td>
    <td><a href="funcionarios?excluir=<?php echo $value['id']; ?>" class="delete"><i class="fa fa-trash"></i> Apagar</a></td>
  </tr>
  <?php } ?>

</table>

</div><!--box-->