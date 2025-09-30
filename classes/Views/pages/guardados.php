<style>
  .middle {
    scroll-behavior: smooth;
    overflow-y:scroll;
  }
</style>
<section class="guardados">
 <div class="container">
    <h4> Todas as publicações</h4>
    <div class="row-guardados">
     

      <?php
        foreach($arr['controller']->guardados() as $key => $guardados){
         foreach($arr['controller']::noticiasDados($guardados['noticia_id']) as $noticia){
            $estudante = $arr['controller']::EstudanteAntigo($noticia['estudante_id']);
            $imagem = $arr['controller']::estudante($estudante['nome'],$estudante['email']);

      ?>
      <div class="guardado-single">
        <div class="guardado-left w50">
          <?php 
        if($noticia['video']){
    ?>
    <video controls autoplay muted loop>
            <source src="<?php echo INCLUDE_PATH_PAINEL ?>ficheiros_noticias/videos/<?php echo $noticia['video']; ?>" type="video/mp4">
            <source src="movie.ogg" type="video/ogg">
    
            </video>
        <?php }else{ ?>
           <img src="<?php echo INCLUDE_PATH_PAINEL ?>ficheiros_noticias/imagens/<?php echo $noticia['imagem']; ?>" />
        <?php } ?>
        </div><!--guardado-left--> 
        <div class="guardado-right w50">
         <div class="line-top">
            <div class="perfil left">
             <div class="img">   
              <img src="<?php echo INCLUDE_PATH_PAINEL ?>perfil/<?php echo $imagem; ?>">
              </div><!--img-->
              <div class="info-perfil">
                 <p class="nome"><?php echo $estudante['nome']; ?></p>
               </div><!--info-perfil-->
              </div><!--perfil-->
              <i class="fa-solid fa-bookmark right remover_guardado"></i>
             <div class="clear"></div><!--clear-->
              <form method="post">
                <input type="hidden" name="id_noticia" value = "<?php echo $guardados['noticia_id']; ?>">
               </form>
          </div><!--line-top-->

           <div class="middle">
            <?php
            foreach($arr['controller']->comentarios($noticia['id']) as $key => $comentario){
              $estudante = $arr['controller']::AtualEstudante($comentario['estudante_id']);
            ?>
            <div class="comment-single">
              <div class="perfil-comment-single">
                <div class="avatar-comment w10">
                  <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $estudante['perfil']; ?>">
                </div><!--avatar-comment-->

                <div class="info-comment w90">
                 <h3><?php echo $estudante['nome']; ?></h3>
                 <p><?php echo $comentario['comentario']; ?> <span><?php echo date('M, H:i',strtotime($comentario['data'])); ?></span></p>
             
                </div><!--info-comment-->
                
                <?php
                  if($_SESSION['id'] == $comentario['estudante_id']){
                ?>
                <div class="delete">
                  <a href="" style="color:tomato"><i class="fa fa-trash"></i></a>
                  <form method="post">
                    <input type="hidden" name="comentario" value="<?php echo $comentario['comentario']; ?>">
                    <input type="hidden" name ="noticia_id" value="<?php echo $comentario['noticia_id']; ?>">
                    <input type="hidden" name="estudante_id" value="<?php echo $comentario['estudante_id'] ?>">
                  </form>
                </div><!--delete-->
              <?php } ?>
              </div><!--perfil-comment-single-->
            </div><!--comment-single-->
           <?php } ?>
                 
           </div><!--middle-->

           <div class="bottom">
             <form method="post">
              <i class="fa-regular fa-face-smile"></i>
                <input type="text" name="comentario" placeholder="Comentario">
                <input type="hidden" name="noticia_id" value="<?php echo $noticia['id']; ?>">
                <input type="hidden" name="estudante_id" value="<?php echo $_SESSION['id']; ?>">
                <label>
                    
                  <input type="submit" name="comentar" style="display:none">
                  <a>Publicar</a>
                </label>
             </form>
           </div><!--bottom-->
        </div><!--guardado-right-->
      </div><!--guardado-single-->
    <?php } ?>
  <?php } ?>
    </div><!--row-guardados-->
 </div><!--container-->
</section><!--guardados-->