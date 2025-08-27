<div class="box">
 <h3><i class="fa fa-comments-o"></i> Mensagens</h3>
   <div class="line"></div><!--line-->
    <div class="row-flex-estudantes">

      <?php

         for($i = 0; $i <= 4 ; $i++){
      ?>

     <div class="estudante-single w32">
     	<div class="top-perfil-estudante" style="background: url(<?php echo INCLUDE_PATH ?>img/banner-perfil.jpeg);background-position: center;background-size: cover;background-repeat: no-repeat;">
        <div class="close"><i class="fa fa-close"></i></div>
        <div class="avatar-perfil-estudante">
          <img src="<?php echo INCLUDE_PATH ?>uploads/Imagem WhatsApp 2024-07-10 às 13.29.32_1163b7e6.jpg">
        </div><!--avatar-perfil-estudante-->
      </div><!--top-perfil-estudante-->

     <div style="padding:10px"> 
      <div class="info-estudante">
        <h3>Alphonse Mwaka Lukombo</h3>
        <p>4º ano<p>
        <p>Engenharia Informatica e de Computadores</p>
        <a href="">Visualizar mensagem</a>
      </div><!--info-estudante-->
    </div><!--info-padding-->
     </div><!--estudante-single-->
    <?php } ?>



   </div><!--row-flex-estudantes-->

</div><!--box-->








