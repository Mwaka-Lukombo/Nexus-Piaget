<div class="box">
  <h3><i class="fa fa-pencil" style="color:#721011"></i> Gerenciar Perfil</h3>
  <div class="line"></div><!--line-->

  <form method="post">
  	<div class="form-group">
  	  <label>Nome:</label>
  	 <input type="text" name="nome" value="<?php echo $_SESSION['nome']; ?>">	
  	</div><!--form-group-->

  	<div class="form-group">
  		<label>Email:</label>
  	 <input type="text" name="email" value="<?php echo $_SESSION['email']; ?>">	
  	</div><!--form-group-->


  	<div class="form-group">
  		<label>Senha:</label>
  	 <input type="text" name="senha" placeholder="Senha . . .">	
  	</div><!--form-group-->

  	<div class="form-group" style="margin-bottom: 10px;border-bottom: 1px solid #ccc;padding-bottom: 10px;">
  		<label>Foto Perfil:</label>
  	    <label style="font-size: 17px;">
  	    	<input type="file" name="foto_perfil" style="display: none;">
  	    	<input type="hidden" name="foto_atual" value="<?php echo $_SESSION['img']; ?>">
  	    	<i class="fa fa-photo" style="color: #9B1315;cursor: pointer;"></i>
  	    </label>
  	</div><!--form-group-->

  	<div class="form-group" style="margin-bottom:20px;border-bottom: 1px solid #ccc;padding-bottom: 10px;">
  		<label>Banner Perfil:</label>
  	    <label style="font-size: 17px;">
  	    	<input type="file" name="banner_perfil" style="display: none;">
  	    	<input type="hidden" name="banner_perfil" value="">
  	    	<i class="fa fa-photo" style="color: #9B1315;cursor: pointer;"></i>
  	    </label>
  	</div><!--form-group-->

  	<div class="form-group">
  	 <input type="submit" name="atualizar" value="Atualizar!">	
  	</div><!--form-group-->
  </form>

</div><!--box-->
<br>
<br>



