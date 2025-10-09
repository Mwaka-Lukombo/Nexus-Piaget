<?php

  if($_SESSION['cargo'] == 2){
?>

<?php

//pegar o estudante existente

  if(isset($_POST['acao'])){
    $nome = $_SESSION['nome'];
    $email = $_SESSION['email'];
    $perfil = $_SESSION['img'];
    $banner_perfil = @$_FILES['banner_perfil'];
    $curso = $_POST['curso'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $linkedin = $_POST['linkedin'];
    $empresa_1 = $_POST['empresa_1'];
    $empresa_2 = $_POST['empresa_2'];

    //to do
    $img_empresa_1 = $_FILES['img_empresa_1'];
    $img_empresa_2 = $_FILES['img_empresa_2'];
    $experiencia = $_POST['experiencia'];
    $sobre = $_POST['sobre'];
    $causas = $_POST['causas'];

    $ok = true;

    if($banner_perfil == "" || $facebook == "" || $twitter == "" || $linkedin == ""
     || $empresa_1 == "" || $empresa_2 == "" || $img_empresa_1 == "" || $experiencia == " "||
     $causas == "" 
    ){
      $ok = false;
      echo '<script>alert("Não podem conter campos vazíos")</script>';
    }

    //Se okay
    if($ok){
      //upload de imagens
      $dir_Banner = 'banner_perfil/';
      move_uploaded_file($banner_perfil['tmp_name'],$dir_Banner.$banner_perfil['name']);
      move_uploaded_file($img_empresa_1['tmp_name'],$dir_Banner.$img_empresa_1['name']);
      move_uploaded_file($img_empresa_2['tmp_name'],$dir_Banner.$img_empresa_2['name']);
      $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.estudantes_antigos` VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      if($sql->execute(array($nome,$email,$perfil,$banner_perfil['name'],$empresa_1,$empresa_2,$img_empresa_1['name'],$img_empresa_2['name'],$experiencia,$causas,$sobre,$curso,$facebook,$twitter,$linkedin))){
        \Painel::mensagem("sucesso","Perfil criado com sucesso!");
      }

    }

  }
?>

<div class="box-content" style="padding-bottom:20px">
 <div class="wellcome">
  <h3>Perfil Alumin</h3>
 </div><!--wellcome-->

 <?php
  
  $verifica = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes_antigos` WHERE email = ?");
  $verifica->execute(array($_SESSION['email']));
  if($verifica->rowCount() == 0){
?>

 <form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="nome">Nome Completo:</label>
    <input type="text" name="nome" value="<?php echo @$_SESSION['nome']; ?>" placeholder="Nome Completo" disabled style="background:#ccc;cursor:not-allowed;font-weight:bold">
  </div><!--form-group-->

  <div class="form-group">
    <label for="nome">E-mail:</label>
    <input type="email" name="email" value="<?php echo @$_SESSION['email']; ?>" placeholder="Seu email" disabled style="background:#ccc;cursor:not-allowed;font-weight:bold">
  </div><!--form-group-->

  <div class="form-group">
    <label for="nome">Banner Perfil:</label>
    <input type="file" name="banner_perfil" placeholder="Nome Completo">
  </div><!--form-group-->

  <div class="form-group">
    <label for="curso">Curso:</label>
    <select name="curso">
      <?php
        $curso = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.cursos`");
        $curso->execute();
        $curso = $curso->fetchAll();
        foreach($curso as $value){
      ?>
      <option value="<?php echo $value['nome']; ?>"><?php echo $value['nome']; ?></option>
      <?php } ?>
    </select>
  </div><!--form-group-->

  <div class="form-group">
    <label for="redes">Redes Sociais:</label>
    <div style="display:flex">
      <input type="text" name="facebook" placeholder="Facebook..." style="margin:0 2px;">
      <input type="text" name="twitter" placeholder="Twitter..." style="margin:0 2px;">
      <input type="text" name="linkedin" placeholder="linkedin..." style="margin:0 2px;">
    </div>
  </div><!--form-group-->

  <div class="form-group">
    <label for="nome" style="">Empresas:</label>
    <div style="display:flex"> 
    <input type="text" name="empresa_1" placeholder="Empresa 1" style="margin:0 4px">
    <input type="text" name="empresa_2" placeholder="Empresa 2" style="margin:0 4px">
    </div><!--flex-->
  </div><!--form-group-->

  <div class="form-group">
    <label for="nome" style="">Imagens empresas:</label>
    <div style="display:flex"> 
    <input type="file" name="img_empresa_1" placeholder="Empresa 1" style="margin:0 4px">
    <input type="file" name="img_empresa_2" placeholder="Empresa 2" style="margin:0 4px">
    </div><!--flex-->
  </div><!--form-group-->

  <div class="form-group">
    <label for="Experiencia">Experiência:</label>
    <textarea name="experiencia" id="experiência" placeholder="Experiencia"></textarea>
  </div><!--form-group-->


  <div class="form-group">
    <label for="sobre">Sobre:</label>
    <textarea name="sobre"></textarea>
  </div><!--form-group-->

  <div class="form-group">
    <label for="Experiencia">Causas:</label>
    <textarea name="causas" id="experiência" placeholder="Causas"></textarea>
  </div><!--form-group-->

  <div class="form-group">
    <input type="submit" name="acao" value="Enviar">
  </div><!--form-group-->
 </form>
<?php }else{ ?>
  <?php

  $verifica_01 = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudante_antigo_formacao` WHERE estudante_id = ?");
  $verifica_01->execute(array($_SESSION['id']));
  if($verifica_01->rowCount() == 0){
?>
  <?php
    if(isset($_POST['acao_formacao'])){
       
       $exId = \Mysql::conectar()->prepare("SELECT id FROM `tb_site.estudantes_antigos` WHERE email = ? ");
       $exId->execute(array($_SESSION['email']));
       $exId = $exId->fetch()['id'];
       $estudante_id = $exId;

       $ensino_primario = $_POST['ensino_primario'];
       $ensino_secundario = $_POST['ensino_secundario'];
       $ensino_superior = $_POST['ensino_superior'];
       //descricao
       $descricao_primario = $_POST['descricao_ensino_primario'];
       $descricao_secundario = $_POST['descricao_ensino_secundario'];
       $descricao_superior = $_POST['descricao_ensino_superior'];
       $descricao_mestrado = $_POST['descricao_mestrado'];
       $master = $_POST['mestrado'];
       $ok = true;


       if($ensino_primario == "" || $ensino_secundario == "" || $ensino_superior == ""){
        $ok = false;
        echo '<script>alert("Não são permitidos campos vazíos")</script>';
       }
       if($ok){
         $sql = \Mysql::conectar()->prepare("INSERT `tb_site.estudante_antigo_formacao` VALUES (null,?,?,?,?,?,?,?,?,?)");
         if($sql->execute(array($estudante_id,$ensino_primario,$ensino_secundario,$ensino_superior,$master,$descricao_primario,$descricao_secundario,$descricao_superior,$descricao_mestrado))){
          \Painel::mensagem("sucesso","Cadastro finalizado");
         }
       }


    }
  ?>
  
  <div class="mensagem_formacao">
      <h4>Continue com o processo de cadastro</h4>
      <p>Insira a baixo insira a tua jornada de formação</p>
  </div><!--mensagem_formacao-->

  <form method="post">
     <div class="form-group">
       <label for="ensino_primario">Ensino Primário</label>
       <input type="text" name="ensino_primario" />
       <textarea name="descricao_ensino_primario"></textarea>
     </div><!--form-group-->

     <div class="form-group">
       <label for="ensino_secundario">Ensino Secundário</label>
       <input type="text" name="ensino_secundario" />
       <textarea name="descricao_ensino_secundario"></textarea>
     </div><!--form-group-->

     <div class="form-group">
       <label for="ensino_superior">Ensino Superior</label>
       <input type="text" name="ensino_superior" />
       <textarea name="descricao_ensino_superior"></textarea>
     </div><!--form-group-->

     <div class="form-group">
       <label for="ensino_superior">Mestrado (Opcional):</label>
       <input type="text" name="mestrado" />
       <textarea name="descricao_mestrado"></textarea>
     </div><!--form-group-->

    

     <div class="form-group">
      <input type="submit" name="acao_formacao" value="Enviar" />
     </div><!--form-group-->
  </form>
<?php  } ?>
<?php } ?>

<?php
  if(isset($_POST['acao_atualizar'])){
     $experiencia_update = $_POST['experiencia_update'];
     $causas_update = $_POST['causas_update'];
     $sobre_update = $_POST['sobre_update'];
     $facebook_update = $_POST['facebook_update'];
     $twitter_update = $_POST['twitter_update'];
     $linkedin_update = $_POST['linkedin_update'];


    
     $sql = \Mysql::conectar()->prepare("UPDATE `tb_site.estudantes_antigos` SET Experiencia = ?, causas = ?, sobre = ?, facebook = ?, twitter = ? , linkedin = ? WHERE email = ?");
     if($sql->execute(array($experiencia_update,$causas_update,$sobre_update,$facebook_update,$twitter_update,$linkedin_update,$_SESSION['email']))){
      \Painel::mensagem("sucesso","Perfil Atualizado com  sucesso!");
     }
  }

  $dados = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes_antigos` WHERE email = ?");
  $dados->execute(array($_SESSION['email']));
  $dados = $dados->fetch();
?>

<div class="mensagem_formacao" style="background:green">
      <h4>Atualize os seus Dados:</h4>
      <p>Insira os novos dados  a baixo </p>
  </div><!--mensagem_formacao-->


  <form method="post">
    <div class="form-group">
      <label for="experiencia">Exepriencia:</label>
      <textarea name="experiencia_update"><?php echo $dados['Experiencia']; ?></textarea>
    </div><!--form-group-->

    <div class="form-group">
      <label for="experiencia">Causas:</label>
      <textarea name="causas_update"><?php echo $dados['causas']; ?></textarea>
    </div><!--form-group-->

    <div class="form-group">
      <label for="experiencia">Sobre:</label>
      <textarea name="sobre_update"><?php echo $dados['sobre']; ?></textarea>
    </div><!--form-group-->

   <div class="form-group">
    <label for="redes">Redes Sociais:</label>
    <div style="display:flex">
      <input type="text" name="facebook_update" value="<?php echo $dados['facebook']; ?>"  placeholder="Facebook..." style="margin:0 2px;">
      <input type="text" name="twitter_update"  value="<?php echo $dados['twitter']; ?>" placeholder="Twitter..." style="margin:0 2px;">
      <input type="text" name="linkedin_update" value="<?php echo $dados['linkedin']; ?>" placeholder="linkedin..." style="margin:0 2px;">
    </div>
  </div><!--form-group-->

  <div class="form-group">
    <input type="submit" name="acao_atualizar" value="Atualizar..." />
  </div><!--form-group-->


  </form>

 

</div><!--box-content-->

<?php }else{ ?>
    <?php
      include('pages/erro_404.php');
    ?>
<?php } ?>  
