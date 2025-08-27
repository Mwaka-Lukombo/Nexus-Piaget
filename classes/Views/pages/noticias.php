<?php


  if(!@$_SESSION['login']){
      \Painel::redirectJS(INCLUDE_PATH);
  }
  

?>


 <div class="overlay">
   <i class="fa fa-times close"></i>
   <div class="box-comentario"></div><!--box-comentario-->
   
 </div><!--overlay-->

 

<div class="box-noticias container">
 <div class="wellcome">
    <h3 class="title">Acompanhe as noticias da universidade</h3>
 </div><!--wellcome-->

 <div class="personal-box">
  <div class="box cadastrar-noticias">
    <form method="post">
    <h3 class="title">Poste suas noticias</h3>
     <div class="flex"> 
        <div class="avatar">
          <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $_SESSION['img']; ?>">
        </div><!--avatar-->
        <input disabled type="text" name="pensar" placeholder="<?php echo $_SESSION['nome']; ?>, o que voce esta pensando hoje?">
    </div><!--flex-->
    </form> 
      <div class="btn-cadastro">
         <span style="color:white;font-size:14px;font-weight:normal;letter-spacing:0.4px;cursor:pointer">Cadastrar noticia</span>
      </div><!--btn-cadastro-->
  </div><!--box-->

  <div class="form-cadastro">
  <form method="post" enctype="multipart/form-data">
   
    
    <div class="group">
      <label>Imagens</label>
      <input type="file" name="imagens[]" multiple style="margin-top:4px">
   </div><!--form-group-->

   <div class="form-group">
      <label>Noticia:</label>
      <textarea name="noticia" placeholder="Noticia"></textarea>
    </div><!--form-group-->

    <div class="form-group">
      <input type="submit" name="cadastra_noticia" style="width:100px;margin:12px 0">
    </div><!--form-group-->
  <!-- </form> --> 

 </div><!--form-cadastro-->


 
  
  
 <?php




   
   foreach($arr['controller']->listarNoticias() as $key => $value){
    $estudante = $arr['controller']->listarDadosUsuario($value['estudante_id']);
    $imagens = \Galeria::imagens($value['id']);


?>

   <div class="box-noticia-single">
   <div class="top">
         <div class="perfil">
          <div class="flex">  
           <div class="avatar">
             <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $estudante['perfil'] ?>">
           </div><!--avatar-->
            <p><?php echo $estudante['nome']; ?></p>
            <p><?php echo date('M, d, Y, H:i',strtotime($value['data'])); ?> <i style="color:#2b75ed" class="fa fa-globe"></i></p>
           </div><!--flex-->
           <div class="legenda">
             <p><?php echo $value['noticia']; ?></p>
           </div><!--legenda-->      
         </div><!--perfil-->
     </div><!--top-->

     <?php
      
       $imagemAtual = \Galeria::imagemAtual($value['id']);
       $imagemAnterior = \Galeria::imagemAnterior($value['id']);
       $proximaImagem = \Galeria::proximaImagem($value['id']);
       foreach($imagemAtual as $imagem)
     ?>
    
     <div class="middle">
       <img src="<?php echo INCLUDE_PATH ?>uploads_noticias/<?php echo $imagem; ?>">
      
       <a href="<?php echo $imagemAnterior; ?>"><i class="fa fa-arrow-left"></i></a>
        <a href="<?php echo $proximaImagem; ?>"><i class="fa fa-arrow-right"></i></a>
     
       
     </div><!--middle-->

     <div class="bottom">
      <div class="flex" style="justify-content:space-between">
      <p><i class="fa-regular fa-thumbs-up"></i> Alphonse Mwaka Lukombo e 12 pessoas</p>
      <p><i class="fa fa-comment"></i> 6 comentarios</p>
      </div>
      <a href="" class="like"><i class="fa-regular fa-thumbs-up"></i> Like</a>
      <a href="" class="comentario"><i class="fa fa-comment"></i> Comentar</a>

      <div class="comentario-content">
     
      <?php
        foreach($arr['controller']->listarComentario($value['id']) as $key => $value){
          $dados = $arr['controller']->dadosComentario($value['usuario_id']);

      ?>
        <div class="perfil-comentario flex">
           <div class="avatar">
              <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $dados['perfil']; ?>">
            </div><!--avatar-->
            <div class="comentario">
              <h4><b><?php echo $dados['nome']; ?></b></h4>
              <p><?php echo $value['comentario']; ?></p>
            </div><!--comentario-->
        </div><!--perfil-comentario-->
        <?php  } ?>
  

        <form method="post">
         <div class="flex"> 
          <div class="avatar">
            <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $_SESSION['img']; ?>">
          </div>
          <input type="hidden" name="noticia_id" value="<?php echo $value['id'] ?>">
              <input type="text" name="comentario" placeholder="Faça o seu comentário" style="width:80%">
              <button name="comentar" style="width:40px;height:40px;cursor:pointer;border:1px solid #ccc;border-radius:50%"><i class="fa fa-send"></i></button>
          </div><!--avatar-->
        </form>
      </div><!--comentario-content-->
    </div><!--bottom-->
   </div><!--box-noticia-single-->
    <?php } ?>
   



</div><!--personal-box-->
</div><!--box-noticias-container-->

