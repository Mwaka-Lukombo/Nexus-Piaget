<?php

$verifica = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.funcionarios`");
  $verifica->execute();
  $verifica = $verifica->fetchAll();
  foreach($verifica as $invalido){
    if($invalido['cargo'] == 2){
      \Painel::redirectJS(INCLUDE_PATH_PAINEL);
    }
  }
  


  $funcionario = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.funcionarios`");
  $funcionario->execute();
  $funcionario = $funcionario->fetchAll();

  foreach ($funcionario as $key => $value) {
    // code...
  }

?>
<div class="box">
  <h3 class="title"><i class="fa fa-pecinl"></i> Casdastrar Funcionários</h3>
   <div class="line"></div><!--line-->
    <form method="post" enctype="multipart/form-data">
    	<div class="form-group">
    		<label>Nome:</label>
    		<input type="text" name="nome" placeholder="Nome completo...." <?php echo $value['nome']; ?>>
    	</div><!--form-group-->

    	<div class="form-group">
    		<label>E-mail:</label>
    		<input type="text" name="email" placeholder="Email ...."  value="<?php echo $value['emial']; ?>">
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
    			<?php
    			   foreach(cargos as $key => $value){
    			   	 if($key < 2){
	    		 ?>
    			<option value="<?php echo $key ?>"><?php echo $value ?></option>
    			    <?php }} ?>
    			
    		</select>
    	</div><!--form-group-->

    	<div class="form-group">
    		<input type="submit" name="acao" value="Atualizar">
    	</div><!--form-group-->
    </form>
</div><!--box-->
