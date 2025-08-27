<?php

  
  if(isset($_POST['criar_turma'])){
     $docente_id = $_SESSION['id'];
     $nome_docente = $_SESSION['nome'];
     $nome = $_POST['nome'];
     $ano = $_POST['ano'];
     $curso = $_POST['curso'];
     $capa = $_FILES['capa_turma'];

     $dir = 'capa_turma/';

     $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.turma` VALUES (null,?,?,?,?,?,?)");
      move_uploaded_file($capa['tmp_name'],$dir.$capa['name']);
     if($sql->execute(array($docente_id,$nome_docente,$nome,$ano,$curso,$capa['name']))){
        print "<script>alert('Turma Criada com sucesso')</script>";
     }
  }
  
?>

<style type="text/css">
  .btn_s{
    display: flex;
    justify-content: center;
  }

  .btn_s a{
    padding: 8px 20px;
    margin: 0 5px;
    color: white;
  }
</style>

<div class="box">
  <h3>Turmas</h3>
  <div class="line"></div>
   <a href="" class="btn criar_turma" style="margin-bottom:12px"><span>Criar Turma</span></a>

   <div class="create-stream">
    <form method="post" enctype="multipart/form-data"> 
      <label>Nome da turma:</label>
      <div class="form-group">
        <input type="text" name="nome" placeholder="Nome da turma">
      </div><!--form-group-->


      <div class="form-group">
      <label>Ano</label>
        <select name="ano">
        <?php
            for($i = 1; $i <= 4; $i++){
        ?>
          <option value="<?php echo $i ?>"><?php echo $i.'º'; ?></option>
       <?php  } ?>
        </select>
      </div><!--form-group-->


      <div class="form-group">
      <label>Curso</label>
        <select name="curso">
          <?php
          $curso = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.cursos`");
          $curso->execute();
          $curso = $curso->fetchAll();
          foreach($curso as $key => $value){
          ?>
          <option value = "<?php echo $value['nome']; ?>"><?php echo $value['nome']; ?></option>
            <?php } ?>
        </select>
      </div><!--form-group-->


      <div class="form-group">
        <label>Capa da turma</label>
        <input type="file" name="capa_turma">
      </div><!--form-group-->

      <div class="form-group" style="">
        <input type="submit" name="criar_turma" value="cadastrar">
      </div><!--form-group-->
      </form>
  </div><!--create-stream-->

</div><!--box-->

<div class="listar-turmas">
<div class="row-turmas">
  <?php
    $turmas = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma` WHERE docente_id = ?");
    $turmas->execute([$_SESSION['id']]);
    $turmas = $turmas->fetchAll();
    foreach($turmas as $key => $value){
      $perfil = \Mysql::conectar()->prepare("SELECT perfil FROM `tb_site.funcionarios` WHERE id = ?");
      $perfil->execute(array($value['docente_id']));
      $perfil = $perfil->fetch()['perfil'];
  ?>
  <div class="turma-single">
      <div class="top" style="background-image:url('<?php echo INCLUDE_PATH_PAINEL ?>capa_turma/<?php echo $value['capa_turma']; ?>'">
        <h2><?php echo $value['curso']; ?></h2>
        <h3><a href="sala?id=<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></a></h3>
        <p><?php echo $value['nome_docente']; ?></p>

        <div class="perfil-docente">
            <img style="background-position: center;object-fit: cover" src="<?php echo INCLUDE_PATH_PAINEL ?>perfil/<?php echo $perfil; ?>">
        </div><!--perfil-docente-->
      </div><!--top-->
      <div class="roda-pe-bottom">
       <div class="btn_s"> 
        <a href="editar-turma?id=<?php echo $value['id']; ?>" class="btn " style="background: orange;">Editar</a>
        <a id_item = "<?php echo $value['id']; ?>" class="btn excluir apagar" style="background:tomato">Apagar</a>
       </div><!--btn's-->
      </div><!--roda-pe-bottom-->
    </div><!--turma-single-->
  <?php  } ?>
 </div><!--row-turma-->
</div><!--listar-turmas-->