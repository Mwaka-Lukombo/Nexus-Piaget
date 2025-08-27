<?php

  if($_SESSION['cargo'] < 2){
    \Painel::redirectJS(INCLUDE_PATH_PAINEL);
  }


?>


<div class="box-content" style="padding-bottom:20px">
 <div class="wellcome">
  <h3>Perfil Alumin</h3>
 </div><!--wellcome-->

 <form method="post">
  <div class="form-group">
    <label for="nome">Nome Completo:</label>
    <input type="text" name="nome" placeholder="Nome Completo">
  </div><!--form-group-->

  <div class="form-group">
    <label for="nome">E-mail:</label>
    <input type="email" name="email" placeholder="Seu email">
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
      <input type="text" name="instagram" placeholder="Instagram..." style="margin:0 2px;">
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
    <textarea name="mensagem" id="experiência" placeholder="Experiencia"></textarea>
  </div><!--form-group-->

  <div class="form-group">
    <label for="Experiencia">Causas:</label>
    <textarea name="cusas" id="experiência" placeholder="Causas"></textarea>
  </div><!--form-group-->

  <div class="form-group">
    <input type="submit" name="acao" value="Enviar">
  </div><!--form-group-->
 </form>
</div><!--box-content-->
