<?php


  if(@!$_SESSION['login']){
      \Painel::redirectJS(INCLUDE_PATH);
  }
  

?>

<style>
  h3{
    text-align:center;
    font-size:16px;
    font-weight:normal;
    text-transform:uppercase;
  }
</style>

<div class="container">
  <div class="box" style="overflow:none">
    <h3 class="title">Comunidade, Faça novas amizades</h3>
    <form class="pesquisa" method="post">
    <div class="form-group">
        <input type="search" name="busca"  Placeholder="Pesquise por, nome, email ou curso" style="padding-left:35px;padding-right:10px">
        <i class="fa fa-search"></i>
        <br>
        <input style="width:100px" type="submit" value="Pesquisar" name="pesquisar">
    </div><!--form-group-->
    </form><!--form-pesquisas-->

    <?php
       if(isset($_POST['busca'])){
        $total = count($arr['controller']->listarMembros());
        
    ?>
    <h3>Foram encontrados <b><?php print $total."</b>"; ?> resultado (os)</h3>
    <?php } ?>

    <div class="row-friend">
      <?php

         foreach($arr['controller']->listarMembros() as $key => $value){
            if($_SESSION['id'] == $value['id_estudante'])
               continue;
      ?>
      <div class="friend-single" style="margin-right:12px">
       <div class="top"> 
        <?php
           if($value['perfil'] == ""){
        ?>
         <img src="<?php echo INCLUDE_PATH ?>img/user.png" style="width:50%;position:relative;left:50%;transform:translateX(-50%)">
        <?php }else{ ?>
        <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $value['perfil']; ?>">
        <?php } ?>
       </div><!--top-->

       <div class="perfil-bottom">
          <!-- <a href=""><i class="fa fa-comment"></i> Enviar mensagem</a> -->
           <p style="font-weight:bolder"><i class="fa fa-"></i> <?php echo $value['nome']; ?></p>
           <p style="text-align:center;font-size:13px"><?php echo $value['curso']; ?></p>
           <?php
              if($arr['controller']->isAmigo($value['id_estudante']) == true){
               print '<a href="" style="background:#28a745;cursor:auto"><i class="fa fa-check"></i> Amigo (a)</a>';
               print '<a style="background-color:rgba(167, 171, 176,0.7);border-radius:12px" href="mensagem?usuario='.$value['id_estudante'].'"><i class="fa fa-comment"></i> Mandar mensagem</a>';
              }
              else if($arr['controller']->amigoPedenete($value['id_estudante']) == false){
          ?>
          <a href="comunidade?addFriend=<?php echo $value['id_estudante'] ?>"><i class="fa fa-user"></i> Adicionar amigo</a>        

          <?php }else{ ?>
          <a style="opacity:0.6;background:tomato"><i class="fa fa-envelope"></i> Solicitacao Enviada</a>
          
          <?php } ?>
          
            </div><!--bottom-->
      </div><!--friend-single-->
       <?php } ?>
     
    </div><!--row-friend-->
  </div><!--box-->
</div><!--container-->