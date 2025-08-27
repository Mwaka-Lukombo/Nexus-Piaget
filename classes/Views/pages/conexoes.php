<?php

  if(!isset($_SESSION['login'])){
    \Painel::redirectJS(INCLUDE_PATH);
  }


  if(isset($_GET['nSeguir'])){
    $id_usuario = (int)$_GET['nSeguir'];

    $sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site.seguidores` WHERE id_from = ? AND id_to = ? AND status = 1");
    $sql->execute(array($_SESSION['id'],$id_usuario));
    \Painel::redirectJS(INCLUDE_PATH.'alumin/conexoes');
  }


?>
<style>
  
div.botoes-conexoes-account span.btn_seguir{
    padding: 5px 20px;
    border-radius: 20px;
    background: #c9c9c9;
    font-size: 13px;
    font-weight: normal;
    color: var(--hover);
    border: 2px solid var(--secundary-color);
}
</style>
<div class="container" style="position:relative;top:15px">
 <section class = "conexoes">   
  <div class="sideBar-conexao w30">
    <div class="pesquisa-single-conexao">
       <h3 class="title-pesquisa">Gerenciar minha rede <span class="right"><i class="fa-solid fa-angle-down"></i></span></h3>
       <div class="clear"></div><!--clear-->
       <div class="content-pesquisa-conexao">
         <a href="<?php echo INCLUDE_PATH ?>alumin/conexoes_existentes"><i class=""></i><i class="fa fa-users"></i> Conexão</a>
         <a href="<?php echo INCLUDE_PATH ?>alumin/guardados"><i class=""></i><i class="fa fa-bookmark"></i> Itens salvos</a>
      </div><!--content-conexao-pesquisa-->
    </div><!--pesquisa-single-->

    <div class = "conexao-piaget">
      <div class="overlay-conexao-piaget"></div><!--overlay-->
        <div class="swiper">
      
      <div class="swiper-wrapper">
        
        <div class="swiper-slide">
          <img src="<?php echo INCLUDE_PATH ?>img/campus.jpg">
        </div>

        <div class="swiper-slide">
          <img src="<?php echo INCLUDE_PATH ?>img/campus_2.jpg">
        </div>

        <div class="swiper-slide">
          <img src="<?php echo INCLUDE_PATH ?>img/campus_3.jpg">
        </div>

        <div class="swiper-slide">
          <img src="<?php echo INCLUDE_PATH ?>img/campus_4.jpg">
        </div>

        <div class="swiper-slide">
          <img src="<?php echo INCLUDE_PATH ?>img/campus_5.jpg">
        </div>

        <div class="swiper-slide">
          <img src="<?php echo INCLUDE_PATH ?>img/campus_6.jpg">
        </div>

        <div class="swiper-slide">
          <img src="<?php echo INCLUDE_PATH ?>img/campus_7.jpg">
        </div>
       
      
      </div>
      
      <div class="swiper-pagination"></div>   
    </div><!--swiper-->
    </div><!--conexao-piaget-->
    
    <div class="direitos-resevados-pesquisa">
      <p>&copy; Todos direitos servados -
        awTech
      </p>
      <span><img src="<?php echo INCLUDE_PATH ?>img/Logo.webp"></span>
      <p>2024</p>
   </div><!--direitos-reservados-pesquisa-->
  </div><!--sideBarConexao-->

  <div class="conexoes-wraper w69">
    <div class="pesquisa-single-waper-conexao">
        <form method ="post" class="left">
          <input type="text" name="pesquisa" placeholder ="Pesquise pelo nome, empresa ou email">
          <i class="fa fa-search"></i>
        </form>
        <h3 class="right">Gerenciar pesquisas</h3>
      <div class="clear"></div><!--clear-->
   </div><!--pesquisa-single-wraper-conexao-->

   <div class="box-geral-conexoes">
   <?php
       if(isset($_POST['pesquisa'])){
           $total = count($arr['controller']->listarConexoes());
     ?>
      <h3 style="text-align:center;font-size:14px;font-weight:normal;color:#646464">Foram encontrado(s) <b style="color:black;font-weight:bolder"><?php echo $total; ?></b> resultado(s)</h3>
      <?php }else{ ?>
        <h3>Pessoas em alta para seguir:</h3>
      <?php } ?>
    
      <div class ="waper-conexoes">
          <?php
            foreach($arr['controller']->listarConexoes() as $key => $conexao){
              $imagem = \Mysql::conectar()->prepare("SELECT perfil FROM `tb_site.funcionarios` WHERE cargo = 2 AND nome  = ? ");
              $imagem->execute(array($conexao['nome']));
              $imagem = $imagem->fetch()['perfil'];

              $total = count($arr['controller']->listarConexoes());



              $totalSeguidores = \Controllers\perfilSinlgeController::seguidores($conexao['id']);
         ?>
     
     
        <div class="conexao-single w31 left">
          <form method="post">
             <input type="hidden" name="total" value="<?php echo $total; ?>">
            </form>
          <div class="top-conexao" style="background-image:url(<?php echo INCLUDE_PATH_PAINEL ?>banner_perfil/<?php echo $conexao['banner_perfil']; ?>);background-position:center;background-size:cover;background-repeat:no-reapt">
              <div class="perfil-conexao">
                <img src="<?php echo INCLUDE_PATH_PAINEL ?>perfil/<?php echo $imagem; ?>">
              </div><!--perfil-conexao-->
          </div><!--top-conexao-->

          <div class="bottom-conexao">
             <div class="info-single-conexao">
                <a href="<?php echo INCLUDE_PATH ?>alumin/conexoes/<?php echo $conexao['id']; ?>"><?php echo $conexao['nome'] ?></a>
                <p style="height:100px;overflow:hidden"><?php echo $conexao['causas']; ?></p>
                <p><?php echo count($totalSeguidores); ?> seguidores</p>
                <div class="button-seguir">
                  <?php
                     $seguirdor = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.seguidores` WHERE id_from = ? AND id_to = ? AND status = 1");
                     $seguirdor->execute(array($_SESSION['id'],$conexao['id']));
                     if($seguirdor->rowCount() == 0){
                  ?>  
                   <a href="<?php echo INCLUDE_PATH ?>alumin/conexoes/<?php echo $conexao['id']; ?>/?seguir=<?php echo $conexao['id']; ?>">Seguir</a>
                 <?php }else{ ?>
                  <a href="<?php echo INCLUDE_PATH ?>alumin/conexoes/?nSeguir=<?php echo $conexao['id']; ?>" style='border-radius: 20px;background: #c9c9c9;font-size: 13px;font-weight: normal;color: #8A1A20;border:2px solid #721011;' class="btn_seguir"><i class="fa fa-check"></i> A Seguir</a>
                <?php  } ?>
                
                 </div><!--button-seguir-->
             </div><!--info-single-conexao-->
            
          </div><!--bottom-conexao-->
        </div><!--conexao-single-->
        
       <?php } ?>
       <div class="clear"></div><!--clear-->
      

      
        


      </div><!--warper-conexoes-->
  </div><!--box-geral-conexoes-->
 </div><!--conexoes-wraper-->
</section><!--conexoes-->
</div><!--container-->