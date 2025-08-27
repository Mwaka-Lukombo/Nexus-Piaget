<style>
      body{
            background:rgb(248, 247, 250);
      }

     .overlay .form-group input:not([type=submit]),
     select,{
      padding-left:10px;
      border:1px solid #ccc;
     }
</style>


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

    <div class="clear"></div><!--clear-->
  

  <form method="post">
      <div class="form-group">
        <label for="user">User name:</label>
        <input type="text" name="user" placeholder="User name...">
        <i class="fa fa-user"></i>
      </div><!--form-group-->
      
      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" placeholder="Sua senha...">
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
        <a href="" id="criar_conta">Criar Conta</a>
      </div>
    </form>
  </div><!--login-->

  <div class="clear"></div>
</section>


<section class="overlay">
<div class="close">    
<i class="fa fa-times close"></i>
</div><!--close-->
  <div class="form-content">
    <div class="top_logo">
      <img src="<?php echo INCLUDE_PATH ?>img/logo-1.png">
    </div>

<form method="post" enctype="multipart/form-data">
  <div class="form-group">
  <label for="curso">Nome Completo:</label>
        <input type="text" name="nome" placeholder="* Seu nome">
  </div><!--form-group-->

  <div class="form-group">
  <label for="curso">Email:</label>
        <input type="email" name="email" placeholder="* Seu email">
  </div><!--form-group-->


  <div class="form-group">
  <label for="sexo">Sexo:</label>
    <select name="sexo">
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
        <option value="Outros">Outros</option>
    </select>
  </div><!--form-group-->

  
  <div class="form-group">
      <label for="curso">Curso:</label>
        <select name="curso">

        <?php
              $cursos = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.cursos`");
              $cursos->execute();
              $curso = $cursos->fetchAll();
              foreach($curso as $value){
          ?>
              <option value="<?php echo $value['nome']; ?>"><?php echo $value['nome']; ?></option>
              <?php   } ?>

        </select>
  </div><!--form-group-->

  
  <div class="form-group">
      <label for="curso">Ano:</label>
        <select name="ano">
              <?php
                for($i = 1; $i <= 4; $i++){
              ?>
              <option value="<?php echo $i; ?>"><?php echo $i.'° Ano'; ?></option>
          <?php } ?>
        </select>
  </div><!--form-group-->


  
  <div class="form-group">
  <label for="perfil">Perfil:</label>
        <input type="file" name="imagem">
  </div><!--form-group-->


  <div class="form-group">
  <label for="curso">Senha:</label>
        <input type="password" name="senha" placeholder="* Password">
  </div><!--form-group-->

  


  <div class="form-group">
        <input type="submit" name="cadastro" value="Cadastrar" class="btn">
  </div><!--form-group-->
  </form>


  </div><!--form-content-->
</section><!--cadastro-->