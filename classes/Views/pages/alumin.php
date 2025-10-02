<?php

  if(!isset($_SESSION['login'])){
    \Painel::redirectJS(INCLUDE_PATH);
  }


  $id_estudante = $_SESSION['id'];
  $estudante = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
  $estudante->execute(array($id_estudante));
  $estudante = $estudante->fetch();
?>

<style>

  div.banner-img{
    height:200px;
  }
  div.banner-img img{
    width: 100%;
    height:100%;
    border-radius:12px 12px 0px 0px; 
    object-fit:cover;
  }
</style>
<div class="button-top">
  <i class="fa fa-arrow-up"></i>
</div><!--button-top-->

<base base="<?php echo INCLUDE_PATH ?>">
<id id="<?php echo $_SESSION['id'] ?>">

<section class="content-alumin container" style="padding-top:50px">
 <div class="perfil-alumin w20">
    <div class="top-perfil-alumin">
      <div class="banner-img">
        <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $estudante['perfil']; ?>">
      </div><!--banner-img-->
     
      <div class="info">
       <h3><?php echo $_SESSION['nome']; ?></h3>
       <p style="font-size:11px;font-wight:normal">Estudante</p>
      </div><!--info-->
    </div><!--top-perfil-alumin-->

    <div class="bottom-perfil">
       <div class="bottom-single">
         <a href="<?php echo INCLUDE_PATH ?>alumin/conexoes">Conexões<br>
            <span>Amplie as suas conexões</span>
         </a>
       </div><!--bottom-single-->

       <div class="bottom-single">
         <a href="<?php echo INCLUDE_PATH ?>alumin/vagas">Vagas<br>
            <span>Procure vagas de estágio</span>
         </a>
       </div><!--bottom-single-->

       

       <div class="bottom-single">
         <a href="<?php echo INCLUDE_PATH ?>alumin/conexoes_existentes">Suas Conexões<br>
            <span>Verifique as conexões</span>
         </a>
       </div><!--bottom-single-->

       <div class="bottom-single">
         <a href="<?php echo INCLUDE_PATH ?>alumin/guardados"><i class="fa fa-bookmark"></i> <span>Intens salvos</span></a>
       </div><!--bottom-single-->
    </div><!--bottom-perfil-->
 </div><!--perfil-alumin-->

 <div class="alumin-content-info w50">
   <div class="content-cadastro">
    <div class="flex">
     <div class="avatar-alumin w10">
       <img src="<?php echo INCLUDE_PATH ?>img/user (1).png">
     </div><!--avatar-->

     <form method="post" class="w85">
        <input type="text" name="publicacao" placeholder="Comece uma publicacao!" disabled>
     </form>
    </div><!--flex-->

     <div class="bottom-alumin">
       <div class="avatar-single-alumin">
         <img src="<?php echo INCLUDE_PATH ?>img/youtube.png">
       </div><!--avatar-single-->

       <div class="avatar-single-alumin">
         <img src="<?php echo INCLUDE_PATH ?>img/photo.png">
       </div><!--avatar-single-->

       <div class="avatar-single-alumin">
         <img src="<?php echo INCLUDE_PATH ?>img/newspaper.png">
       </div><!--avatar-single-->
     </div><!--bottom-alumin-->
   </div><!--content-cadastro-->


   <?php
     foreach($arr['controller']->listarNoticias() as $key => $noticia){
      $dados = $arr['controller']->dados($noticia['estudante_id']);
      $imagem = \Mysql::conectar()->prepare("SELECT `perfil` FROM `tb_site.funcionarios` WHERE cargo = 2 AND email = ?");
      $imagem->execute(array($dados['email']));
      $imagem = $imagem->fetch()['perfil'];
   ?>
   <div class="box-alumin-noticias">
   
     <div class="box-alumin-top">
      <form method="post">
        <input type="hidden" name="id_noticia" value="<?php echo $noticia['id'] ?>">
      </form>
        <div class="botoes right">
          <?php
            $verifica = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.guardados_noticia` WHERE estudante_id = ? AND noticia_id = ? AND status = 1");
            $verifica->execute(array($_SESSION['id'],$noticia['id']));
            if($verifica->rowCount() == 0){
          ?>
           <i class="fa-regular fa-bookmark" style="padding-top:5px"></i>
          <?php }else{ ?>
            <i class="fa-solid fa-bookmark" style="padding-top:5px"></i>
         <?php } ?>
          <div class="clear"></div>
        </div><!--botoes-->
       <div class="clear"></div><!--clear-->
     </div><!--box-alumin-top-->

     <!-- content de noticias -->
     <div class="perfil-noticias-alumin">
        <div class="flex">
            <div class="avatar-perfil-noticias w10">
                <img src="<?php echo INCLUDE_PATH_PAINEL ?>perfil/<?php echo $imagem; ?>">
            </div><!--avatar-perfil-noticias-->
            <div class="info-perfil-noticias-alumin w90">
                <h3><?php echo $dados['nome']; ?></h3>
                <p style="margin-bottom:7px;font-size:12px;font-weight:normal"><span><?php echo $dados['curso'] ?></span> <b>||</b> <span><?php echo $dados['sobre']; ?></span> </p>
            </div><!--info-perfil-noticias-alumin-->
         </div><!--flex-->
         <div class="descricacao-noticia-alumin">
            <p style="text-align:justify;font-weight:normal;color:#646464"><?php echo $noticia['noticia']; ?></p>
         </div><!--descricacao-noticia-alumin-->
     </div><!--perfil-noticias-alumin-->

     <div class="noticia-content-alumin">

     <?php
       if($noticia['video']){ 
     ?>
      <video controls autoplay muted loop>
        <source src="<?php echo INCLUDE_PATH_PAINEL ?>ficheiros_noticias/videos/<?php echo $noticia['video']; ?>" type="video/mp4">
        <source src="movie.ogg" type="video/ogg">
      </video>
      <?php }else if($noticia['imagem']){ ?>
         <img src="<?php echo INCLUDE_PATH_PAINEL ?>ficheiros_noticias/imagens/<?php echo $noticia['imagem'] ?>">
      <?php } ?>

     </div><!--noticia-content-alumin-->
     <?php
      $TotalLike = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias_alumin_like` WHERE noticia_id = ? AND status = 1");
      $TotalLike->execute(array($noticia['id']));
      $TotalLike = $TotalLike->fetchAll();

      $comentario = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.comentario_alumin`WHERE noticia_id = ?");
      $comentario->execute(array($noticia['id']));
      $comentario = count($comentario->fetchAll());
     ?>
     <div class="info-noticia" style="padding:0 12px">
        <p class="total_likes left" style="font-size:13px;font-weight:normal;color:#646464"> <b><?php echo count($TotalLike); ?></b> like(s)</p>
        <p class="comentarios right" style="font-size:13px;font-weight:normal;color:#646464"><b><?php print $comentario; ?></b> comentarios</p>
        <div class="clear"></div><!--clear-->
     </div><!--info-noticia-->
     <div class="noticia-content-bottom-alumin">
      <?php
        
        $like = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias_alumin_like` WHERE estudante_id = ? AND noticia_id = ? AND status = 1");
        $like->execute(array($_SESSION['id'],$noticia['id']));
        if($like->rowCount() == 0){
      ?>
      <div class = "like w50 left" style="border-top:1px solid #ccc"><i class="fa-regular fa-heart"></i> <span style="margin-left:2px;font-size:13px;font-weight:normal">like</span></div><!--like-->
      <?php }else{ ?>
        <div class = "like w50 left" style="border-top:1px solid #ccc"><i class="fa-solid fa-heart" style="color: #db1f1f;"></i> <span style="margin-left:2px;font-size:13px;font-weight:normal">like</span></div><!--like-->
      <?php }?>
      <div class="comentario w50 left" style="border-top:1px solid #ccc;border-radius-right:0;font-size:15px;color:#ccc"><i class="fa fa-comment-o" style="margin-right:5px"></i> Comentario 
      <form method="post">
      <input type="hidden" name="noticia_id" value="<?php echo $noticia['id'] ?>">
      <input type="hidden" name="teste" value="121">
     </form>
    </div><!--comentario-->
      
      <div class="clear"></div><!--clear-->
     </div><!--noticia-content-bottom-alumin-->
   </div><!--box-alumin-noticias-->
  <?php } ?> 
  
  <!-- Modal comentarios de noticias -->
  <div class="modal-comentarios" style="display:none">
    <div class="modal-close">
      <i class="fa fa-close"></i>
    </div><!--modal-close-->
    <?php
       $estudante = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
       $estudante->execute(array((int)$_GET['estudanteid']));
       $estudante = $estudante->fetch();

       $noticia = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias_alumin` WHERE estudante_id = ? AND id = ?");
       $noticia->execute(array((int)$_GET['estudanteid'],(int)$_GET['noticia']));
       $noticia = $noticia->fetch();

     ?>
      <div class="comentario-box">
        <h3>Publicações de <?php echo $estudante['nome']; ?> <span><img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $estudante['perfil']; ?>"></span></h3>
        <div class="descricao-noticia-box">
          <p><?php echo $noticia['noticia']; ?></p>
        </div><!--descricao-noticia-box-->
        <div class="background-box">
          <div class="noticia-single">
          <video muted autoplay controls loop>
            <source src="<?php echo INCLUDE_PATH_PAINEL ?>ficheiros_noticias/videos/<?php echo $noticia['video']; ?>" type="video/mp4">
            <source src="mov_bbb.ogg" type="video/ogg">
         
          </video>
          </div><!--noticia-single-->
          
          <div class="comentarios-single-content">
            <h4>Comentários</h4>
            <div class="box-comentario">
             
                <div class="perfil-single-comentario">
                  <div class="perfil-comentario w20">
                    <img src="<?php echo INCLUDE_PATH ?>uploads/">
                  </div><!--perfil--> 
                  <div class="conteudo-perfil-comentario w80">
                      <h5></h5>
                      <p></p>
                 </div><!--conteudo-perfil-comentario-->
                </div><!--perfil-single-comentario-->
             
            </div><!--box-comentario-->
            
         </div><!--comentarios-single-content-->
       </div><!--background-box-->
      </div><!--comentario-box-->
  </div><!--modal-comentarios-->

   
   

 </div><!--alumin-content-info-->

 <div class="links-alumin w30">
    <div class="sugestoes-links">
      <h3>Assuntos mais recentes!</h3>
      <p class="data-sugestoes">Data: <span><?php echo date('d/M /Y') ?></span></p>
     
      <div class="row-noticias-recentes">      
        <?php
          $recentes = \Mysql::conectar()->prepare("SELECT * FROM `tb_site_noticias.recentes` ORDER BY data desc LIMIT 2");
          $recentes->execute();
          $recente = $recentes->fetchAll();
          foreach($recente as $key => $value){
        ?>
          <div class="post-single-content">
            <div class="left-single">
              <img src="<?php echo INCLUDE_PATH_PAINEL ?>ficheiros_noticias/imagens/<?php echo $value['imagem']; ?>" />
            </div><!--left-single--> 

            <div class="right-single">
              <h3 style="font-size:14px;text-align:center"><?php echo $value['descricao'] ?>
                <span class="data-noticia-single"><?php echo $value['data'] ?></span>
              </h3>
            </div><!--right-single-->
          </div><!--post-single-content-->
          <?php } ?>



      </div><!--row-noticias-rencentes-->

      <div class="row-vagas-recentes">
         <p class="vagas-text">Vagas recentes:</p>

         <?php
         $vagas = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.vagas_recentes` ORDER BY data desc LIMIT 1");
         $vagas->execute();
         $vaga = $vagas->fetchAll();
         foreach($vaga as $key => $value){
?>       <div class="row-vagas-single">
           <div class="vagas-top">
            <img src="<?php echo INCLUDE_PATH_PAINEL ?>ficheiros_noticias/vagas/<?php echo $value['imagem']; ?>" />
           </div><!--vagas-top--> 

           <div class="vagas-description">
            <h3 class="title-vaga"><?php echo $value['titulo']; ?></h3>
             <a href="#"><?php echo $value['descricao']; ?></a>
           </div><!--vagas-description-->
         </div><!--row-vagas-single-->
          <?php } ?>


      </div><!--row-vagas-recentes-->

    </div><!--sugestoes-links-->

    <div class="documentation-box-alumin">
      <div class="documentation-top">
        <div class="overlay-alumin"></div><!--overlay-alumin-->
        <img src="<?php echo INCLUDE_PATH ?>img/campus.jpg">
      </div><!--documentation-top-->
    </div><!--documentation-box-alumin-->

    <div class="button-link">
        <a href=""><span>NOTA:</span> Tenha experiencia com antigos estudantes da <span>Uni</span>Piaget</a>
    </div><!--button-linl-->
 </div><!--links-alumin-->
</section><!--content-alumin-->