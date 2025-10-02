<?php
 $id_to = explode('/',$_GET['url'])[2];
 $id_from = $_SESSION['id'];


 if(isset($_GET['nSeguir'])){
  $id_usuario = (int)$_GET['nSeguir'];

  $sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site.seguidores` WHERE id_from = ? AND id_to = ? AND status = 1");
  $sql->execute(array($_SESSION['id'],$id_usuario));
  \Painel::redirectJS(INCLUDE_PATH.'alumin/conexoes/'.$id_usuario);
}



 $id_usuario = explode('/',$_GET['url'])[2];

 $seguidores = $arr['controller']->seguidores($id_to);


$total_seguidores = count($seguidores);

 $perfil = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes_antigos` WHERE id = ?");
 $perfil->execute(array($id_usuario));
 $perfil = $perfil->fetch();

 $dados = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.funcionarios` WHERE cargo = 2 AND nome = ?");
 $dados->execute(array($perfil['nome']));
 $dados = $dados->fetch();

 if(isset($_GET['seguir'])){
   $id_to = explode('/',$_GET['url'])[2];
   $id_from = $_SESSION['id'];

    $seguidor = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.seguidores` WHERE id_from = ? AND id_to = ? AND status = 1");
    $seguidor->execute(array($id_from,$id_to));
    if($seguidor->rowCount() == 0){
       $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.seguidores` VALUES (null,?,?,?)");
       $sql->execute(array($id_from,$id_to,1));
       \Painel::redirectJS(INCLUDE_PATH.'alumin/conexoes/'.$id_to);
    }else{
      print '<script>alert("Voces segue esse pessoa")</script>';
      \Painel::redirectJS(INCLUDE_PATH.'alumin/conexoes/'.$id_to);
      
    }
  

}


?>


<div class="overlay-geral">
  <i class="fa fa-close close-conexao-contato"></i>
  <div class="informacoes-conexao">
    <div class ="title-conexao">
     <h3> </h3>
    </div><!--title-conexao-->

    <div class="info-informarcao-conexao">
      <h3>Informações de contato</h3>
      <?php
         $facebook = str_replace("https://web.facebook.com/", "",$perfil['facebook']);
         $twitter = str_replace("https://x.com/","",$perfil['twitter']);
         $linkedin = str_replace("https://www.linkedin.com/","",$perfil['linkedin']);
      ?>

      <div class="info-informacao-single">
        <a href="<?php echo $perfil['facebook']; ?>" target="_blank"><i class="fa fa-facebook facebook"></i> <?php echo ucfirst($facebook); ?></a>
        <a href="<?php echo $perfil['twitter']; ?>" target="_blank"><i class="fa fa-twitter twitter"></i> <?php echo $twitter; ?></a>
        <a href="<?php echo $perfil['linkedin']; ?>" target="_blank"><i class="fa fa-linkedin linkedin"></i> <?php echo $linkedin; ?></a>
        <a href=""><i class="fa fa-envelope email"></i> <?php echo $perfil['email']; ?></a>
      </div><!--info-informacao-single-->
   </div><!--info-informarcao-conexao-->
  </div><!--informacoes-conexao-->
</div><!--overlay-geral-->

<div class="overlay-mensagem">
<i class="fa fa-close close-conexao-mensagem"></i>
  <div class="box-mensagem-conexao">
    <div class="mensagem-top">
      <div class="flex" style="display:flex;aling-items:center">
        <div class="perfil-avatar-top-conexao">
         <img src="<?php echo INCLUDE_PATH_PAINEL ?>perfil/<?php echo $dados['perfil']; ?>">
        </div><!--perfil-avatar-top-conexao-->
        <h4><?php echo $perfil["nome"]; ?></h4>
      </div><!--flex-->
    </div><!--mensagem-top-->
    
    <div class="middle-mensagem">
      <?php
       for($i = 0; $i < 24; $i++){
      ?>
      <a href="">Ola tudo bem?</a>
     <?php } ?>
   </div><!--middle-mensagem-->
   <div class="mensagem-bottom">
     <form method="post">
       <input type="text" name="" placeholder="Mensagem">
       <label>
         <button><i class="fa fa-send"></i></button>
       </label>
     </form>
   </div><!--mensagem-bottom-->   
  </div><!--box-mensagem-conexao-->

</div><!--overlay-mensagem-->
<div class="container" style="margin-top:50px">
  <section class="perfil-single-content">
   <div class="row-content-perfil-single w100"> 
    <div class="perfil-content">
      <div class="banner-perfil-single-conexao" style="background-image:url(<?php echo INCLUDE_PATH_PAINEL ?>banner_perfil/<?php echo $perfil['banner_perfil']; ?>);background-size:cover;background-position:center;background-repeat:no-repeat">
        <div class="avatar-perfil-conexao">
         <img src="<?php echo INCLUDE_PATH_PAINEL ?>perfil/<?php echo $dados['perfil']; ?>">
        </div><!--avatar-perfil-conexao-->
      </div><!--banner-perfil-single-conexao-->
    
     <div class="space-perfil"> 
        <div class="perfil-content-info w75">
            <h3><?php echo $perfil['nome']; ?></h3>
            <p style="font-size:13px;text-align:justify"><?php echo $perfil['Experiencia']; ?></p>
            <span class="curso"><?php echo $perfil['curso']; ?> - <span class="open-geral">Informações de contato</span></span>
            <div class="count-conexaoes">
              <span><?php print count($seguidores); ?> seguidores + de 500 conexões</span>
            </div><!--count-conexoes-->
            <div class="botoes-conexoes-account">
              <?php
                $seguidor = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.seguidores` WHERE (id_from = ? AND id_to = ? AND status = 1)");
                $seguidor->execute(array($id_from,$id_to));
                if($seguidor->rowCount() == 0){
              ?>
                <a href ="<?php echo INCLUDE_PATH ?>alumin/conexoes/<?php echo $perfil['id']; ?>/?seguir=<?php echo $_SESSION['id']; ?>"><i class="fa fa-plus"></i> Seguir</a>
              <?php }else{ ?>
                <a href="<?php echo INCLUDE_PATH ?>alumin/conexoes/<?php echo $perfil['id']; ?>?nSeguir=<?php echo $perfil['id']; ?>" style='border-radius: 20px;background: #c9c9c9;font-size: 13px;font-weight: normal;color: #8A1A20;border:2px solid #721011;' class="btn_seguir"><i class="fa fa-check"></i> A Seguir</a>
               <?php } ?>
                <a href="<?php echo INCLUDE_PATH ?>mensagem_alumin/<?php echo $perfil['id'] ?>" class="enviar-mensagem">Enviar mensagem</a>
                <a href="<?php echo INCLUDE_PATH ?>alumin/conexoes/<?php echo $perfil['id']; ?>/GerarPDF"><i class="fa fa-file-word"></i> PDF</a>
            </div><!--botoes-conexoes-account-->
        </div><!--perfil-content-info-->

        <div class="info-empresas w22">
          <h4 style="color:#646464"><i class="fa fa-rocket" style="color:#8a1a20"></i> Empresas</h4>
          <div class="empresa-single">
             <div class="img-empresa"><img src="<?php echo INCLUDE_PATH_PAINEL ?>banner_perfil/<?php echo $perfil['img_empresa_1'] ?>"></div><!--img-empresa-->
             <div class="info-empresa">
             <p><?php echo $perfil['empresa_1']; ?></p>
            </div><!--info-empresa-->
          </div><!--empresa-single-->

          <div class="empresa-single">
             <div class="img-empresa"><img src="<?php echo INCLUDE_PATH_PAINEL ?>banner_perfil/<?php echo $perfil['img_empresa_2'];?>"></div><!--img-empresa-->
             <div class="info-empresa">
             <p><?php echo $perfil['empresa_2']; ?></p>
            </div><!--info-empresa-->
          </div><!--empresa-single-->
        </div><!--info-empresa-->
     </div><!--space-perfil-->
     </div><!--perfil-content-->

    <div class="sobre-content">
        <h3>Sobre</h3>
        <p><?php echo $perfil['sobre']; ?></p>
        <span class="right">ver mais!</span>
        <div class="clear"></div><!--clear-->
    </div><!--sobre-content-->

    <div class="formacao-content">
      <h3>Formação acadêmica</h3>
      <?php
        $formacao = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudante_antigo_formacao` WHERE estudante_id = ?");
        $formacao->execute(array($perfil['id']));
        $formacao = $formacao->fetch();
       
      ?>
      <div class="formacao-single">
        <div class="icon-geral w10">
         <img src="<?php echo INCLUDE_PATH ?>img/graduation-hat.png">
       </div><!--icon-geral-->

       <div class="info-cademica">
          <h3><?php echo $formacao['ensino_primario']; ?></h3>
          <p><?php echo $formacao['descricao_primario']; ?></p>
       </div><!--info-cademica-->
      </div><!--formacao-single-->

      <div class="formacao-single">
        <div class="icon-geral w10">
         <img src="<?php echo INCLUDE_PATH ?>img/graduation-hat.png">
       </div><!--icon-geral-->

       <div class="info-cademica">
          <h3><?php echo $formacao['ensino_secundario']; ?></h3>
          <p><?php echo $formacao['descricao_secundario']; ?></p>
       </div><!--info-cademica-->
      </div><!--formacao-single-->


      <div class="formacao-single">
        <div class="icon-geral w10">
         <img src="<?php echo INCLUDE_PATH ?>img/graduation-hat.png">
       </div><!--icon-geral-->

       <div class="info-cademica">
          <h3><?php echo $formacao['ensino_superior']; ?></h3>
          <p><?php echo $formacao['descricao_superior']; ?></p>
       </div><!--info-cademica-->
      </div><!--formacao-single-->

    </div><!--atividade-contet-->

    <div class="causas-content">
       <h3 style="margin-bottom:10px;border-bottom:1px solid #ccc;padding-bottom:10px"><i class="fa fa-rocket"></i> Causas</h3>
       <p style="padding:3px;line-height:20px"><?php echo $perfil['causas']; ?></p>
    </div><!--causas-content-->
 </div><!--row-content-perfil-single--> 

     
  </section><!--section-total-->
</div><!--container-->    






















