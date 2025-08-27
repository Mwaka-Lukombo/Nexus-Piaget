

<head>
  <!-- link do css -->
  <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL ?>css/login_2.css">

</head>


<style>
      body{
            background:rgb(248, 247, 250);
      }

     
</style>

<div class="rolling-box">
  <div class="rolling"></div>
</div><!--rolling-box-->

<?php


 if(isset($_POST['acao'])){
          $user = $_POST['user'];
          @$password = $_POST['password'];
          
          $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.funcionarios` WHERE email = ? AND senha = ?");
          $sql->execute(array($user,$password));
          if($sql->rowCount() == 1){
            $info = $sql->fetch();
            $_SESSION['login'] = true;
            $_SESSION['id'] = $info['id'];
            $_SESSION['nome'] = $info['nome'];
            $_SESSION['cargo'] = $info['cargo'];
            $_SESSION['img'] = $info['perfil'];
            $_SESSION['email'] = $info['email'];
            $_SESSION['senha'] = $info['senha'];
            print "<script>alert('Login efetuado com sucesso!')</script>";
            \Painel::redirectJS(INCLUDE_PATH_PAINEL);
          }else{
            print "<script>alert('User ou senha incorretos!')</script>";
          }
         }


?>

<section class="box-login-container">
    <div class="left-content left">  
      <div class="icon-faculdade">
            <img src="<?php echo INCLUDE_PATH ?>img/Logo.png">
      </div>
    </div><!--left-content--> 

  <div class="box-login right">
   <div class="logo-login">
      <img src="<?php echo INCLUDE_PATH ?>img/logo-1.png">
    </div><!--logo-login-->
  

  <form method="post">
      <div class="form-group">
        <label for="user">User name:</label>
        <input type="text" name="user" placeholder="User name...">
        <i class="fa fa-user"></i>
      </div><!--form-group-->
      
      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" name="password" placeholder="Sua senha...">
        <i class="fa fa-lock"></i>
      </div><!--form-group-->

      <div class="form-group">
        <input type="submit" name="acao" value="Entar">
      </div><!--form-group-->

      <div class="form-group" style="display:flex;align-items:center;justify-content:space-between">
        <label>
            <input type="checkbox" name="lembrar">
            <span>Lembrar</span>
        </label>
        <a href="">Criar Conta</a>
      </div>
    </form>
  </div><!--login-->

  <div class="clear"></div>
</section>

