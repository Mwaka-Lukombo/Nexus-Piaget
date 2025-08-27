<?php


  

 $funcionario = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.funcionarios` WHERE id = ?");
  $funcionario->execute(array($_SESSION['id']));
  $funcionario = $funcionario->fetchAll();

  foreach ($funcionario as $key => $value) {

    if($value['cargo'] == 2){
      \Painel::redirectJS(INCLUDE_PATH_PAINEL);
    }
  }

?>
<div class="box">
  <h3 class="title"><i class="fa fa-pecinl"></i> Editar Perfil</h3>
   <div class="line"></div><!--line-->
    <form method="post" enctype="multipart/form-data">
    	<div class="form-group">
    		<label>Nome:</label>
    		<input type="text" name="nome" placeholder="Nome completo...." value="<?php echo $value['nome']; ?>">
    	</div><!--form-group-->

    	<div class="form-group">
    		<label>E-mail:</label>
    		<input type="text" name="email" placeholder="Email ...."  value="<?php echo $value['email']; ?>">
    	</div><!--form-group-->

    	<div class="form-group">
    		<label>Perfil:</label>
    		<input type="file" name="imagem">
        <input type="hidden" name="imagem_atual" value="<?php echo $value['perfil']; ?>">
    	</div><!--form-group-->

    	<div class="form-group">
    		<label>Senha:</label>
    		<input type="text" name="senha" value="<?php echo $value['senha']; ?>">
    	</div><!--form-group-->

    	<div class="form-group">
    		<label>Cargo:</label>
    		<select name="cargo" required>
    			<option disabled selected><?php echo cargos[$value['cargo']] ?></option>
    		</select>
    	</div><!--form-group-->

    	<div class="form-group">
    		<input type="submit" name="acao" value="Atualizar">
    	</div><!--form-group-->
    </form>
</div><!--box-->
