
<style>
	
	.info-noticia{
		padding: 5px;
		margin-bottom: 5px;
	}

	.info-noticia p{
		font-size: 14px;
		font-weight: normal;
		color: #646464;
	}

</style>
<div class="row-noticias-painel">
	<?php

	  $id_estudante = \Mysql::conectar()->prepare("SELECT `id` FROM `tb_site.estudantes_antigos` WHERE nome = ? AND email = ?");
	  $id_estudante->execute(array($_SESSION['nome'],$_SESSION['email']));
	  $id_estudante = $id_estudante->fetch()['id'];



	      $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias_alumin`");
	      $sql->execute();
	      $sql = $sql->fetchAll();
		 foreach($sql as $key => $value){
		 	$dados = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes_antigos` WHERE id = ?");
		 	$dados->execute(array($value['estudante_id']));
		 	$dados = $dados->fetch();

		 	$imagem = \Mysql::conectar()->prepare("SELECT `perfil` FROM `tb_site.funcionarios` WHERE cargo = 2  AND email = ?");
		 	$imagem->execute(array($dados['email']));
		 	$imagem = $imagem->fetch()['perfil'];


	?>
  <div class="content-noticia-painel">
  	<div class="top-painel-noticia">
  	  <div class="avatar-painel-top h10">
  	  	<img src="<?php echo INCLUDE_PATH_PAINEL ?>perfil/<?php echo $imagem; ?>">
  	  </div><!--avatar-painel--top-->
  	  <div class="info-painel-top w90">
  	  	<h3><?php echo $dados['nome']; ?></h3>
  	  	<p><?php echo $dados['curso']; ?> || <?php echo $dados['sobre']; ?></p>
  	  </div><!--info-painel-top-->
  	</div><!--top-painel-noticia-->
  	<div class="info-noticia">
  	   <p><?php echo $value['noticia']; ?></p>
  	</div>

  	<div class="body-noticia-painel h80">
  		<video autoplay muted loop controls>
		  <source src="<?php echo INCLUDE_PATH_PAINEL ?>ficheiros_noticias/videos/<?php echo $value['video']; ?>">
		  <source src="movie.ogg" type="video/ogg">
		</video>
  	</div><!--body-noticia-painel-->

  	<div class="botom-noticia">
  	 <div class="like w50"><i class="fa fa-heart"></i> <span>like</span> </div>
  	 <div class="comment w50"><i class="fa fa-comment-o"></i> <span>coment</span> </div>
  	</div><!--bottom-noticias-->

  </div><!--noticia-painel-->
  <?php  } ?>

</div><!--row-noticias-painel-->