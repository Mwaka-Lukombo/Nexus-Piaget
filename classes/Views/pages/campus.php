<?php

  if(!isset($_SESSION['login'])){
    \Painel::redirectJS(INCLUDE_PATH);
  }

  $id_user = $_SESSION['id'];
  

?>

 <section class="alerta" style="display:none">
        <p><i class="fa fa-check"></i> Usuario cadastrado com sucesso!</p>
</section>


<div class="container">
  <div class="flex">
     <div class="box box-perfil">
        <h3 class="title">seja bem vindo (a) - <?php echo $_SESSION['nome']; ?></h3>
        <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $_SESSION['img'] ?>">
        <?php
             $amizades = \Models\campusModel::listarAmizades($_SESSION['id']);

        
            

          ?>

        <div class="feed-amizades">
        

          
          <h4><i class="fa fa-users"></i> Minhas Amizades (<?php print count($amizades); ?>)</h4>
      
            

           
        </div><!--feed-amizades-->
     </div><!--box-perfil-->

  
     
     <div class="editar-perfil">
        <h3 class="title">Seu Perfil Atual</h3>
        <div class="perfil-atual">
           <p><i class="fa fa-exclamation-circle"></i> <b>Nome:</b> <?php echo $_SESSION['nome']; ?></p>
           <p><i class="fa fa-exclamation-circle"></i> <b>Email:</b> <?php echo $_SESSION['email']; ?></p> 
           <p><i class="fa fa-exclamation-circle"></i> <b>Curso:</b> <?php echo $_SESSION['curso'];  ?></p>
           <p><i class="fa fa-exclamation-circle"></i> <b>Ano:</b> <?php echo $_SESSION['ano'];  ?></p>
           <p><i class="fa fa-exclamation-circle"></i> <b>Sexo:</b> <?php echo $_SESSION['sexo']; ?></p>
        </div>
       
  <form class="form" method="post" enctype="multipart/form-data">
    <h3 class="title">Configure o seu perfil</h3>

     <div class="form-group">
     <label>Nome:</label>
       <input type="text" name="nome" placeholder="* Seu nome" value="<?php echo $_SESSION['nome']; ?>">
     </div><!--form-group-->

     <div class="form-group">
     <label>Email:</label>
       <input type="text" name="email" placeholder="* Sua email" value = "<?php echo $_SESSION['email']; ?>">
     </div><!--form-group-->

     <!-- <div class="form-group">
     <label>Ano:</label>
       <select name="ano">
      
        </select>
     </div>form-group -->

     <div class="form-group">
     <label>Senha Atual:</label>
       <input type="password" name="senha_atual" placeholder="* Senha Atual" value="<?php echo $_SESSION['senha']; ?>">
     </div><!--form-group-->

     

     <div class="form-group">
     <label>Nova Senha:</label>
       <input type="password" name="senha" placeholder="* Sua senha">
     </div><!--form-group-->

     <div class="form-group">
     <label>Perfil:</label>
       <input style="padding:3px" type="file" name="imagem">
     </div><!--form-group-->


     <div class="form-group">
       <input type="hidden" name="imagem_atual"  value="<?php echo $_SESSION['img']; ?>">
     </div><!--form-group-->

     <div class="form-group">
        <label>Curso:</label>
       <select>
         <option selected disabled><?php echo $_SESSION['curso']; ?></option>
      </selecct>
     </div><!--form-group-->



   

     <div class="form-group">
       <input style="width:100px" type="submit" name="atualizar" placeholder="* Sua senha" value="Atualizar">
     </div><!--form-group-->
     
     

    </form>
    </div><!--editar-perfil-->
  </div><!--flex-->
</div><!--container-->