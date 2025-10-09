<?php


  if($_SESSION['cargo'] == 3){

    

?>
<!-- <section class="base">
  <p><i class="fa fa-check"></i> Usuario cadastrado com sucesso! </p>
</section> -->

<?php

 if(isset($_POST['acao'])){
     $nome = $_POST['nome'];
     $email = $_POST['email'];
     $perfil = @$_FILES['perfil'];
     $senha = rand(100,100000000);
     $cargo = $_POST['cargo'];

     $dir = 'perfil/';
     $ok = true;

  
     if($ok){
     	move_uploaded_file($perfil['tmp_name'],$dir.$perfil['name']);
     	$sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.funcionarios` VALUES (null,?,?,?,?,?)");
     	$sql->execute(array($nome,$email,$senha,$perfil['name'],$cargo));
     	print "<script>alert('Usuario Cadastrado com sucesso!')</script>";
     }

    }
?>

<?php

 if(isset($_GET['apagar'])){
   $idFuncionario = (int)$_GET['apagar'];

   $sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site.funcionarios` WHERE id = ?");
   if($sql->execute(array($idFuncionario))){
     \Painel::mensagem("sucesso","Usuario excluido com sucesso!");
     \Painel::redirectJS(INCLUDE_PATH_PAINEL.'funcionarios');
   }
 }

?>


<div class="box-content">
  <?php
    if(!isset($_GET['editar'])){
  ?>
  <div class="wellcome">
    <h3>Funcionários</h3>
  </div><!--wellcome-->

  
  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nome">Nome completo:</label>
      <input type="text" name="nome" placeholder="Nome completo">
    </div><!--form-group-->

    <div class="form-group">
        <label for="nome">E-mail:</label>
      <input type="email" name="email" placeholder="Seu e-mail">
    </div><!--form-group-->

    <div class="form-group">
        <label for="nome">Perfil:</label>
      <input type="file" name="perfil">
    </div><!--form-group-->

    <div class="form-group">
      <label for="cargo">Cargo:</label>
      <select name="cargo">
         <?php
           foreach(cargos as $id => $value){   
            if($id < 3){
         ?>
         <option value="<?php echo $id ?>"><?php echo $value; ?></option>
        <?php }?>
       <?php } ?>
       </select>
    </div><!--form-group-->

    <div class="form-group">
      <input type="submit" name="acao">
    </div><!--form-group-->
  </form>
  <?php }else{ ?>

     <?php
    if(isset($_POST['atualizar_edit'])){
       $id = (int)$_GET['editar'];
       $nome = $_POST['nome_edit'];
       $email = $_POST['email_edit'];
       $newPassword = "";
       $currentPassword = $_POST['current_password'];
       $password = $_POST['password_edit'];

       if($password == ""){
         $newPassword = $currentPassword;
       }else{
         $newPassword = $password;
       }
      
       //update no banco
       $sql = \Mysql::conectar()->prepare(" UPDATE `tb_site.funcionarios` SET nome = ?, email = ?, senha = ? WHERE id = ?");
       if($sql->execute(array($nome,$email,$newPassword,$id))){
        \Painel::mensagem("sucesso","Usuario editado com sucesso!");
       }else{
         echo '<script>alert("Falhao ao editar funcionario!")</script>';
       }

    }
  ?>
  <br />
    <div class="wellcome">
    <h3><i class="fa fa-pencil"></i> Editar Funcionario</h3>
  </div><!--wellcome-->

 

  <?php 
    $id = (int)$_GET['editar'];
    $funcionario = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.funcionarios` WHERE id = ?");
    $funcionario->execute(array($id));
    $value = $funcionario->fetch();
  ?>

     <form method="post">
      <div class="form-group">
        <label for="Nome">Nome Completo:</label>
        <input type="text" name="nome_edit" value="<?php echo $value['nome']; ?>" />
      </div><!--form-group-->

      <div class="form-group">
        <label for="Email">Email:</label>
        <input type="text" name="email_edit" value="<?php echo $value['email']; ?>" />
      </div><!--form-group-->

      <div class="form-group">
        <label for="cargo">Cargo:</label>
        <select name="cargo">
         <option value="<?php echo $value['id']; ?>" disabled selected><?php echo cargos[$value['cargo']]; ?></option>
       </select>
      </div><!--form-group-->

      <div class="form-group">
        <label>Password:</label>
        <input type="password" name="password_edit" />
        <input type="hidden" name="current_password" value="<?php echo $value['senha'] ?>" />
      </div><!--form-group-->

      <div class="form-group">
        <input type="submit" name="atualizar_edit" value="Atualizar"  />
      </div><!--form-group-->
    </form>
   <?php } ?>

</div><!--box-content-->

<div class="box-content" style="margin-top:20px;background:transparent">
 <div class="flex">
  <?php 
    $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.funcionarios` WHERE cargo != 3");
    $sql->execute();
    $sql = $sql->fetchAll();
    foreach($sql as $id => $value){
  ?>
   <div class="funcionario-single">
      <div class="top">
          <div class="avatar">
           <?php
            if($value['perfil'] == ''){
           ?>
              <i class="bx bx-user"></i>
         <?php  }else{ ?>
            <img src="<?php echo INCLUDE_PATH_PAINEL ?>perfil/<?php echo $value['perfil'] ?>">
          <?php } ?>
          </div>
      </div><!--top-->

      <div class="bottom">
          <h4>Nome: <?php echo $value['nome']; ?></h4>
          <h5>Email: <?php echo $value['email']; ?></h5>
          <p>Senha:<b><?php echo $value['senha']; ?></b></p>
          <p>Cargo: <?php echo cargos[$value['cargo']]; ?></p>

          <div class="button-content">
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>funcionarios/?editar=<?php echo $value['id'] ?>" style="background:orange"><i class="fa fa-pencil"></i> Editar</a>
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>funcionarios/?apagar=<?php echo $value['id'] ?>" style="background:tomato"><i class="fa fa-trash"></i> Deletar</a>
          </div><!--button-content-->
      </div>

   </div><!--funcionario-single-->
  <?php } ?>

  <div class="paginator">
      <a href="" class="paginator-selected">1</a>
      <a href="">2</a>
  </div><!--paginator-->
</div>
</div><!--box-content-->

<?php }else{ ?>
     <?php 
       include('pages/erro_404.php');
     ?>
<?php   } ?>