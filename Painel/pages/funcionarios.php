
<section class="base">
  <p><i class="fa fa-check"></i> Usuario cadastrado com sucesso! </p>
</section>
<div class="box-content">
  <div class="wellcome">
    <h3>Funcionários</h3>
  </div><!--wellcome-->

  <form method="post">
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

</div><!--box-content-->

<div class="box-content" style="margin-top:20px;background:transparent">
 <div class="flex">
  <?php 
    $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.funcionarios`");
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