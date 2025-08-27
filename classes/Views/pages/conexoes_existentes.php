<?php

  if(!isset($_SESSION['login'])){
    \Painel::redirectJS(INCLUDE_PATH);
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
<div class="container" style="position:relative;top:50px">
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
   

   <div class="box-geral-conexoes">
      <h3>Minhas Conexões:</h3>
      <div class ="waper-conexoes" style="display:flex">
          <?php
            
            foreach($arr['controller']->conexoesExistentes() as $key => $value){
                $dados = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes_antigos` WHERE id = ?");
                $dados->execute(array($value['id_to']));
                $dados = $dados->fetch();
                $imagem = $arr['controller']->imagemConexao($dados['email']);
         ?>
        <div class="conexao-single w50">
          <div class="top-conexao" style="background-image:url(<?php echo INCLUDE_PATH_PAINEL ?>banner_perfil/<?php echo $dados['banner_perfil']; ?>);background-position:center;background-size:cover;background-repeat:no-reapt">
              <div class="perfil-conexao">
                <img src="<?php echo INCLUDE_PATH_PAINEL ?>perfil/<?php echo $imagem; ?>">
              </div><!--perfil-conexao-->
          </div><!--top-conexao-->

          <div class="bottom-conexao">
             <div class="info-single-conexao">
                <a href="<?php echo INCLUDE_PATH ?>alumin/conexoes/<?php echo $dados['id']; ?>"><?php echo $dados['nome']; ?></a>
                <p style="width:100%;overflow:hidden;"><?php echo $dados['causas']; ?></p>
                <p><?php echo count(\Controllers\perfilSinlgeController::seguidores($value['id_to'])); ?> seguidores</p>
                <div class="button-seguir">
                  
                   <a href="<?php echo INCLUDE_PATH ?>mensagem_alumin/<?php echo $dados['id']; ?>"><i class="fa fa-comment-o"></i> Mandar mensagem</a>
                
                 </div><!--button-seguir-->
             </div><!--info-single-conexao-->
          </div><!--bottom-conexao-->
          
        </div><!--conexao-single-->
        
    <?php } ?>
      

      

      
        


      </div><!--warper-conexoes-->
  </div><!--box-geral-conexoes-->
 </div><!--conexoes-wraper-->
</section><!--conexoes-->
</div><!--container-->