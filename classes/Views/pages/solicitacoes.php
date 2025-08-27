<?php


  if(!@$_SESSION['login']){
      \Painel::redirectJS(INCLUDE_PATH);
  }
  

?>

<div class="box container">
    <h3 class="title">Solicitações de amizade</h3>

    
    <div class="row-friend">
    <?php

        foreach($arr['controller']->listarPedidos() as $key => $value){
         $usuario = $arr['controller']->pegarUsuario($value['id_from']);
    ?>
      <div class="friend-single" style="margin-right:12px">
       <div class="top"> 
        <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $usuario['perfil']; ?>">
       </div><!--top-->

       <div class="perfil-bottom">
          <!-- <a href=""><i class="fa fa-comment"></i> Enviar mensagem</a> -->
           <p style="font-weight:bolder"><i class="fa fa-"></i> <?php echo @$usuario['nome'] ?></p>
           <p style="text-align:center;font-size:13px"><?php echo @$usuario['curso']; ?></p>
           <div class="flex">
             <a href="solicitacoes?Aceitar=<?php echo $usuario['id_estudante']; ?>">Aceitar</a>
             <a href="solicitacoes?Rejeitar=<?php echo $usuario['id_estudante']; ?>">Rejeitar</a>
          </div><!--flex-->
       </div><!--bottom-->
      </div><!--friend-single-->
    <?php } ?>
    
     
    </div><!--row-friend-->
  </div><!--box-->
</div><!--box-->