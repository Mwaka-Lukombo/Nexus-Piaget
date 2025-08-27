<?php

$experiencia = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes_antigos` WHERE email = ?");
$experiencia->execute(array($_SESSION['email']));
$experiencia = $experiencia->fetch();


$formacao = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudante_antigo_formacao` WHERE estudante_id = ?");
@$formacao->execute(array($experiencia['id']));
$formacao = $formacao->fetch();


 $id_estudante = \Mysql::conectar()->prepare("SELECT `id` FROM `tb_site.estudantes_antigos` WHERE email = ?");
     @$id_estudante->execute(array($_SESSION['email']));
     @$id_estudante = $id_estudante->fetch()['id']
?>
<style type="text/css">
  .alert{
    margin: 12px 0;
    max-width: 790px;
  }
</style>
<section class="gerencia-perfil">
  <?php

  if(isset($_POST['atualizar_dados'])){
    $nome = $_SESSION['nome'];
    $resumo = $_POST['resumo'];
    $curso = $_POST['curso'];
    $banner_perfil = @$_FILES['banner_peril'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $linkedin = $_POST['linkedin'];
    $email = $_POST['email'];

    $dir = 'banner_perfil/';

  if($nome == "" || $resumo == "" || $banner_perfil == ""){
    \Painel::alert('erro'," :( Não são permitidos campos vazios");
  }else{

      move_uploaded_file($banner_perfil['tmp_name'],$dir.$banner_perfil['name']);

      $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.estudantes_antigos` (id,nome,sobre,banner_perfil,curso,facebook,twitter,linkedin,email) VALUES (null,?,?,?,?,?,?,?,?)");
     if(\Painel::estudanteExistent()){
        \Painel::alert('erro', ":( Usuário existente no banco de dados!");
     }else{

      if($sql->execute(array($nome,$resumo,$banner_perfil['name'],$curso,$facebook,$twitter,$linkedin,$email))){
        \Painel::alert('sucesso',"Operação feita com sucesso!");
        \Painel::redirectJS(INCLUDE_PATH_PAINEL.'gerenciar-conta');
      }else{
          \Painel::alert('erro'," :( Falha na operação");
      }

    }
  }
       
  }
  if(isset($_POST['experiencia'])){
     $empresa_1 = $_POST['nome_empresa_1'];
     $empresa_2 = $_POST['nome_empresa_2'];
     $imagem_1 = @$_FILES['img_empresa_1'];
     $imagem_2 = @$_FILES['img_empresa_2'];
     $experiencia = $_POST['experiencia_conteudo'];
     $dir = "banner_perfil/";
     
     $id_estudante = \Mysql::conectar()->prepare("SELECT `id` FROM `tb_site.estudantes_antigos` WHERE email = ?");
     $id_estudante->execute(array($_SESSION['email']));
     $id_estudante = $id_estudante->fetch()['id'];




     $sql = \Mysql::conectar()->prepare("UPDATE `tb_site.estudantes_antigos` SET empresa_1 = ? , empresa_2 = ?, img_empresa_1 = ? , img_empresa_2 = ?, Experiencia = ? WHERE id = ?");
     if($sql->execute(array($empresa_1,$empresa_2,$imagem_1['name'],$imagem_2['name'],$experiencia,$id_estudante))){
      move_uploaded_file($imagem_1['tmp_name'],$dir.$imagem_1['name']);
      move_uploaded_file($imagem_2['tmp_name'],$dir.$imagem_2['name']);
      \Painel::alert("sucesso","Operação feita com sucesso!");
     }else{
       \Painel::alert('erro',":( Falha na operação");
     }

    
  }


    if(isset($_POST['enviar_formacao'])){
      $primario = $_POST['ensino_primario'];
      $secundario = $_POST['ensino_secundario'];
      $superior = $_POST['ensino_superior'];
      $mestrado = $_POST['mestrado'];
      $descricao_primario = $_POST['descricao_ensino_primario'];
      $descricao_secundario = $_POST['descricao_ensino_secundario'];
      $descrica_superior = $_POST['descricao_ensino_superior'];
      $descricao_mestrado = $_POST['descricao_mestrado'];

     
     if($primario == "" || $secundario == "" || $superior == ""){
        \Painel::alert("erro",":( Você precisa preencher pelo menos até a licenciatura!");
     }else{

      $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.estudante_antigo_formacao`
        VALUES (null,?,?,?,?,?,?,?,?,?)");
      $sql->execute(array($id_estudante,$primario,$secundario,$superior,$mestrado,$descricao_primario,$descricao_secundario,$descrica_superior,$descricao_mestrado));
      \Painel::alert("sucesso","Operação feita com sucesso!");

    }

    
    
    }


  
?>
<div class="flex-gerencia">

 <div class="row-left w80">
  <div class="box-perfil">
    <h3><i class="fa fa-pencil" style="color: #721011;"></i> Atualize as informações do seu perfil</h3>
    <form method="post" enctype="multipart/form-data">
      <div class="form-perfil">
       <input type="text" name="nome" placeholder="Nome Completo">  
      </div><!--form-perfil-->  

      <div class="form-perfil">
       <textarea name="resumo" placeholder="Resumo sobre si . . ."></textarea>  
      </div><!--form-perfil--> 

      <div class="form-perfil">
        <label style="color: #646464;">Banner perfil:</label>
        <label>
          <input type="file" name="banner_peril" style="padding:3px ">
        </label>
      </div> 

      <div class="form-perfil">
        <select name="curso">
          <?php
            
            $cursos = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.cursos`");
            $cursos->execute();
            $cursos = $cursos->fetchAll();
            foreach($cursos as $key => $curso){
          ?>
          <option value="<?php echo $curso['nome']; ?>"><?php echo $curso['nome']; ?></option>
          <?php } ?>
        </select>
      </div><!--form-perfil-->  

      <div class="form-perfil">
           <label><i class="fa fa-facebook facebook"></i></label>
       <input type="text" name="facebook" placeholder="Fecebook:" value="<?php echo @$experiencia['facebook'] ?>">  
      </div><!--form-perfil-->  

      <div class="form-perfil">
        <label><i class="fa fa-twitter twitter"></i></label>
       <input type="text" name="twitter" placeholder="Twitter:" value="<?php echo @$experiencia['twitter'] ?>"> 
      </div><!--form-perfil-->  

      <div class="form-perfil">
           <label><i class="fa fa-linkedin linkedin"></i></label>
       <input type="text" name="linkedin" placeholder="Linkedin:" value="<?php echo @$experiencia['linkedin']; ?>">  
      </div><!--form-perfil-->

      <div class="form-perfil">
        <label><i class="fa fa-envelope email"></i></label>
       <input type="text" name="email" placeholder="Email:" value="<?php echo @$experiencia['email']; ?>"> 
      </div><!--form-perfil-->  

      <div class="form-perfil" style="text-align: right;">
        <button name="atualizar_dados">Atualizar</button>
      </div><!--fom-perfil-->
    </form>
   </div><!--box-perfil-->

   <div class="sobre-perfil">
    <h3>Sua Experiência</h3>
     <form method="post" enctype="multipart/form-data"> 
     <div class="form-perfil">
       <label style="font-size: 13px;font-weight: normal;color: #646464;text-align: center;">Empresa 1:</label>
       <input type="text" name="nome_empresa_1" placeholder="Nome empresa 1" value="<?php echo @$experiencia['empresa_1'];  ?>">
       <label>
         <input type="file" style="display: none;" name="img_empresa_1">
         <i class="fa fa-photo" style="cursor: pointer;font-size: 17px;"></i>
       </label>
     </div><!--form-perfil-->

     <div class="form-perfil">
       <label style="font-size: 13px;font-weight: normal;color: #646464;text-align: center;">Empresa 2:</label>
       <input type="text" name="nome_empresa_2" placeholder="Nome empresa 2" value="<?php echo @$experiencia['empresa_2']  ?>">
       <label>
         <input type="file" style="display: none;" name="img_empresa_2">
         <i class="fa fa-photo" style="cursor: pointer;font-size: 17px;"></i>
       </label>
     </div><!--form-perfil-->

     <div class="form-perfil">
      <label style="color: #646464;font-size: 14px;font-weight: normal;">Experiencia:</label>
       <textarea name="experiencia_conteudo" placeholder="Experiência"><?php echo @$experiencia['Experiencia']  ?></textarea>
     </div><!--fom-perfil-->

     <div class="form-perfil">
       <button name="experiencia">Enviar</button>
     </div><!--form-perfil-->
     </form>
   </div><!--sobre-info-->

   <div class="formacao-academica">
     <h3>Formação acadêmica</h3>

     <form method="post">
        <div class="form-perfil">
           <input type="text" name="ensino_primario" placeholder="Ensino Primário" style="height: 40px;border: 0;border: 2px solid #ccc;border-radius: 12px;font-size: 17px;margin-right: 12px;" value="<?php echo @$formacao['ensino_primario'];  ?>"> 
           <textarea name="descricao_ensino_primario" placeholder="Descrição do ensino"><?php echo @$formacao['descricao_primario']; ?></textarea>
        </div><!--form-perfil-->

        <div class="form-perfil">
           <input type="text" name="ensino_secundario" placeholder="Ensino Secundário" style="height: 40px;border: 0;border: 2px solid #ccc;border-radius: 12px;font-size: 17px;margin-right: 12px;" value="<?php echo @$formacao['ensino_secundario']; ?>"> 
           <textarea name="descricao_ensino_secundario" placeholder="Descrição do ensino"><?php echo @$formacao['descricao_secundario']; ?></textarea>
        </div><!--form-perfil-->

        <div class="form-perfil">
           <input type="text" name="ensino_superior" placeholder="Ensino Superior" style="height: 40px;border: 0;border: 2px solid #ccc;border-radius: 12px;font-size: 17px;margin-right: 12px;" value="<?php echo @$formacao['ensino_superior']; ?>"> 
           <textarea name="descricao_ensino_superior" placeholder="Descrição do ensino"><?php echo @$formacao['descricao_superior']; ?></textarea>
        </div><!--form-perfil-->

        <div class="form-perfil">
           <input type="text" name="mestrado" placeholder="Mestrado" value="<?php echo @$formacao['Mestrado'] ?>" style="height: 40px;border: 0;border: 2px solid #ccc;border-radius: 12px;font-size: 17px;margin-right: 12px;"> 
           <textarea name="descricao_mestrado" placeholder="Descrição do ensino"><?php echo @$formacao['descricao_mestrado']; ?></textarea>
        </div><!--form-perfil-->

        <div class="form-perfil">
          <button name="enviar_formacao">Enviar formação</button>
        </div><!--form-perfil-->
     </form>
   </div><!--formacao-academica-->
   <?php

     if(isset($_POST['causas'])){
         $causas = $_POST['causas'];
         $sql = \Mysql::conectar()->prepare("UPDATE `tb_site.estudantes_antigos` SET causas = ? WHERE id = ?");
         $sql->execute(array($causas,@$experiencia['id']));
         \Painel::alert("sucesso","Operação feita com sucesso!");
     }
   ?>

   <div class="causas-perfil">
    <h3><i class="fa fa-rocket"></i> Causas</h3>
    <form method="post">
       <div class="form-perfil">
        <textarea placeholder="Causas . . ." name="causas"><?php echo @$experiencia['causas']; ?></textarea>
       </div><!--fom-perfil-->

       <div class="form-perfil">
         <button name="enviar_causa">Enviar</button>
       </div><!--form-perfil-->
    </form>
   </div><!--causas-perfil-->
  </div><!--row-left-w80-->

  <div class="row-right  w20">
      <div class="empresas">
          <h3><i class="fa fa-pencil" style="color:#721011"></i> Empresas</h3>
          <?php

            if(isset($experiencia) == true){

       
          ?>
          <div class="empresa-single">
              <span><img src="<?php echo INCLUDE_PATH_PAINEL ?>banner_perfil/<?php echo @$experiencia['img_empresa_1']; ?>"></span>
              <p><?php echo @$experiencia['empresa_1']; ?></p>
          </div><!--empresa-single-->

          <div class="empresa-single">
              <span><img src="<?php echo INCLUDE_PATH_PAINEL ?>banner_perfil/<?php echo @$experiencia['img_empresa_2']; ?>"></span>
              <p><?php echo @$experiencia['empresa_2']; ?></p>
          </div><!--empresa-single-->
          <?php } ?>
      </div><!--empresas-->
  </div><!--row-right-->

</div><!--flex-gerencia-->
</section><!--gerenciar-perfil-->