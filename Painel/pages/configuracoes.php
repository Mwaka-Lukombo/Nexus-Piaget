<?php

 if(isset($_POST['acao'])){
    $senha = "";
    $verifica_senha = $_POST['verifica_senha'];
    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];

    $ok = true;


    //verifacacao da senha;

    if($verifica_senha !== $senha_atual){
      $ok = false;
      echo '<script>alert("As senhas nao conferem!")</script>';
    }

    if($nova_senha == ""){
       $senha = $senha_atual;
    }else{
      $senha = $nova_senha;
    }

    //update
    if($ok){
    $sql = \Mysql::conectar()->prepare("UPDATE `tb_site.funcionarios` SET senha = ? WHERE email = ?");
    if($sql->execute(array($senha,$_SESSION['email']))){
      \Painel::mensagem("sucesso","Perfil atualizado com sucesso!");
    }
    }
 }


?>

<div class="box-content">
  <div class="wellcome">
    <h3>Configurações</h3>
  </div><!--wellcome-->

   
  <div class="perfil-content-configuracao">
    <div class="avatar-perfil-content">
     <img src="<?php echo INCLUDE_PATH_PAINEL ?>perfil/<?php echo $_SESSION['img']; ?>" />
   </div><!--avatar-perfil-content-->
  </div><!--perfil-content-->

  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="email">E-mail:</label>
      <input type="email" name="email" value="<?php echo $_SESSION['email']; ?>" placeholder="Seu email..." disabled style="cursor:not-allowed;background:#ccc">
    </div><!--form-group-->

    <div class="form-group">
      <label for="email">Senha Antiga:</label>
      <input type="password" name="verifica_senha"  placeholder="******">
      <input type="hidden" name="senha_atual" value="<?php echo $_SESSION['senha']; ?>" />
    </div><!--form-group-->

    <div class="form-group">
      <label for="email">Nova Senha:</label>
      <input type="password" name="nova_senha" placeholder="******">
    </div><!--form-group-->


    <div class="form-group">
      <input type="submit" name="acao">
    </div><!--form-group-->
  </form>

</div><!--box-content--> 