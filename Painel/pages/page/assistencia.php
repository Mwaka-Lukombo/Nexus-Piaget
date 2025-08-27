<div class="box">
  <h3><i class="fa fa-gear"></i> Assistencia </h3>
   <div class="line"></div><!--line-->

    <?php
    	$sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.assistencia`");
    	$sql->execute();
    	$sql = $sql->fetchAll();
    	foreach($sql as $key => $value){
    		
    ?>

    <div class="box-assitencia" style="border-bottom: 2px solid #ccc;padding-bottom: 20px;">
    	<form>
    		<div class="form-group">
    		   <label>Nome Estudante: </label>
    		   <input type="text" name="nome" value="<?php echo $value['email_estudante']; ?>" disabled>		
    		</div><!--form-group-->

    		<div class="form-group">
    			<label>Assunto: </label>
    			<textarea disabled><?php echo $value['assunto']; ?></textarea>
    	     </div><!--form-group-->

    	     <div class="form-group">
    	       <a href="<?php echo INCLUDE_PATH_PAINEL ?>reponder?email=<?php echo $value['email_estudante'] ?>"><i class="fa fa-comment-o"></i> Responder</a>		
    	     </div><!--form-group-->
    	</form>
     </div><!--box-assistencia-->
     <?php } ?>

</div><!--box-->





