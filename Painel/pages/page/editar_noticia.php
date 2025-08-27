
<?php

   

    $id_noticia = (int)$_GET['id_noticia'];


 
    if(isset($_POST['atualizar'])){

    	$video_atual = $_POST['video_atual'];
    	$video = @$_FILES['video'];
    	$noticia = $_POST['noticia'];

    	
    	$dir = 'ficheiros_noticias/videos/';
    	move_uploaded_file($video['tmp_name'],$dir.$video['name']);

    	$sql = \Mysql::conectar()->prepare("UPDATE `tb_site.noticias_alumin` SET noticia = ?, video = ? WHERE id = ?");
    	$sql->execute(array($noticia,$video['name'],$id_noticia));

    	print '<script>alert("Noticia atualizada com sucesso!")</script>';
    }


	 $noticias = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias_alumin` WHERE id = ?");
	 $noticias->execute(array($id_noticia));
	 $noticias = $noticias->fetchAll();
    foreach($noticias as $key => $value){


    
?>

<div class="box">
  <h3>Editar Noticia : <?php echo $id_noticia; ?></h3>
  <div class="line"></div>
   <div class="box-top-noticia-content" style="width: 70%;height: 350px;background: red;margin: 0 auto;position: relative;border-radius: 12px;margin-bottom: 20px;">
	   	<video autoplay muted loop controls style="width: 100%;height:100%;position: absolute;top: 0;;left: 0;object-fit: cover;border-radius: 12px;">
		  <source src="<?php echo INCLUDE_PATH_PAINEL?>ficheiros_noticias/videos/<?php echo $value['video']; ?>" type="video/mp4">
		  <source src="movie.ogg" type="video/ogg">
	</video>
   </div><!--box-top-noticia-content-->

   <form method="post" enctype="multipart/form-data">

   	<div class="form-group">
   	  <label>Video</label>
   	  <input type="file" name="video" accept="video/*">
   	  <input type="hidden" name="video_atual" value="<?php echo $value['video']; ?>">
   	</div><!--form-group-->

	 <div class="form-group">
	 	<label>Noticia:</label>
	 	<textarea name="noticia"><?php echo $value['noticia']; ?></textarea>
	 </div><!--form-group-->

	 <div class="form-group">
	 	<input type="submit" name="atualizar" value="Atualizar!">
	 </div><!--form-group-->	

   </form>

</div><!--box-->
  <br>
  <br>
<?php } ?>
