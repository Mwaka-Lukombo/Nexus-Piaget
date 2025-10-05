<style>
  .deletar_admin{
    display:inline-block;
    text-align:center;
    line-height:30px;
    color:white;
    font-size:1.2em;
    width: 50px;
    height:30px;
    background:#9b1315;
    transition:all 0.3s ease;
  }

  .deletar_admin:hover{
    background:#751314;
  }
</style>

<?php
 if(isset($_GET['noticia'])){
   $idDelete = (int)$_GET['noticia'];

   $sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site.noticias_alumin` WHERE id = ?");
   if($sql->execute(array($idDelete))){
     \Painel::mensagem("sucesso","Noticia excluida com sucesso!");
     \Painel::redirectJS(INCLUDE_PATH_PAINEL.'postagens');
   }
 }
?>

<section class="noticias">
   
  <?php  

  $noticias = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias_alumin`");
  $noticias->execute();
  $noticias = $noticias->fetchAll();
  
  foreach($noticias as $key => $value){?> 
   <?php
     $estudante = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes_antigos` WHERE id = ?");
     $estudante->execute(array($value['estudante_id']));
     $estudante = $estudante->fetch();
   ?>
   <div class="noticia-sigle">
    
    <?php 
    if($_SESSION['cargo'] == 3){
   ?>
    <a href="<?php echo INCLUDE_PATH_PAINEL ?>postagens/?noticia=<?php echo $value['id']; ?>" class="deletar_admin"><i class="fa fa-trash"></i></a>
   <?php } ?>
  <div class="flex">
    <div class="noticia-left">  
      <div class="perfil">
        
    <?php 
      if($estudante['perfil'] == ''){
      ?>
       <div class="avatar" style="display:flex;justify-content:center;align-items:center">
        <i class="fa fa-user"></i>
      </div><!--avatar-->
        <?php }else{ ?>
        <div class="avatar">
            <img src="<?php echo INCLUDE_PATH_PAINEL ?>perfil/<?php echo $estudante['perfil']; ?>">
        </div><!--avatar-->
      <?php } ?>
        <h3><?php echo $estudante['nome']; ?></h3>
        <p class="descricao_perfil"><?php echo $estudante['sobre'] ?></p>
      </div><!--perfil-->
    </div><!--noticia-left-->
    <div class="right-noticia">
    <div class="descricao_noticia">
    <p><?php echo $value['noticia']; ?></p>
    </div>

    <div class="middle">
        <video controls muted autoplay>
        <source src="<?php echo INCLUDE_PATH_PAINEL ?>ficheiros_noticias/videos/<?php echo $value['video']; ?>" type="video/mp4">
        <source src="movie.ogg" type="video/ogg">
    </video>
    </div><!--middle-->

    <div class="bottom">    
      <div class="flex" style="align-items:center">
        <div class="likes">
         <i class="bx bx-heart"></i>
        </div><!--likes-->

        <div class="comentarios">
         <i class="bx bx-chat"></i>
        </div><!--comments-->

      </div><!--flex-->
    </div><!--bottom-->
   </div><!--right-noticia-->
 </div><!--flex-single-noticia-->
  </div><!--noticia-single-->
<?php } ?>

<div class="pagination">
 <a href="">1</a>
</div><!--pagination-->
</section><!--noticias-->