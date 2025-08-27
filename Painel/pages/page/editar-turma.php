<?php



  
   $id_turma = (int)$_GET['id'];

  $turma = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma` WHERE id = ?");
  $turma->execute(array($id_turma));
  $turma = $turma->fetchAll();

  foreach($turma as $key => $value)
    $nome_docente = \Mysql::conectar()->prepare("SELECT nome FROM `tb_site.funcionarios` WHERE id = ?");
    $nome_docente->execute(array($value['docente_id']));
    $nome_docente = $nome_docente->fetch()['nome'];



?>


<div class="box">
  <?php
      if(isset($_GET['Imagem'])){
        $imagemId = $_GET['Imagem'];
        unlink('capa_turma/'.$imagemId);
        \Painel::alert('sucesso','Imagem excluida com sucesso!');
        \Painel::redirectJS('editar-turma?id='.$id_turma);
        
      }
  ?>
  <h3><i class="fa fa-pencil"></i> Editar turma <?php echo (int)$_GET['id']; ?></h3>
    <div class="line"></div><!--line-->
      <h2 class="capa">Capa da turma:</h2>
       <div class="top-edit-turma">
      	  <img src="<?php echo INCLUDE_PATH_PAINEL ?>capa_turma/<?php echo $value['capa_turma']; ?>">
      	  <div class="content-btn">
      	  	<a href="editar-turma?id=<?php echo $id_turma; ?>&Imagem=<?php echo $value['capa_turma']; ?>" style="text-decoration: none;color: white;">Deletar</a>	
      	  </div><!--btn-->
       </div><!--top-edit-turma-->

       <div class="bottom-edit-noticia">
        <?php
          if(isset($_POST['atualizar'])){
            $nome = $_POST['nome'];
            $ano = $_POST['ano'];
            $curso = $_POST['curso'];
            $imagem = $_FILES['capa_turma'];
            $imagem_atual = $_POST['imagem_atual'];


              if($imagem == ""){
                $imagem = $imagem_atual;
              }

           

              $dir = 'capa_turma/';
              move_uploaded_file($imagem['tmp_name'],$dir.$imagem['name']);
              $sql = \Mysql::conectar()->prepare("UPDATE `tb_site.turma` SET nome = ?, ano = ?, curso = ?, capa_turma = ? WHERE id = $id_turma");
              $sql->execute(array($nome,$ano,$curso,$imagem['name']));
              \Painel::alert('sucesso','Noticia atualizada com sucesso!');
              \Painel::redirectJS('editar-turma?id='.$id_turma);
              $turma = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.turma` WHERE id = ?");
              $turma->execute(array($id_turma));
              $turma = $turma->fetchAll();
              foreach($turma as $key => $value){}
             
          }
        ?>
       	 <h2 class="capa">Informações da turma</h2>

    <form method="post" enctype="multipart/form-data"> 
      <div class="form-group">	
        <label>Nome da turma:</label>
        <div class="form-group">
        <input type="text" name="nome" placeholder="Nome da turma" value="<?php echo $value['nome'] ?>">
      </div><!--form-group-->

       <div class="form-group">	
        <label>Docente:</label>
        <div class="form-group">
        <input type="text" name="nome_docente" placeholder="Nome do Docente" value="<?php echo $nome_docente; ?>">
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
          foreach($curso as $key => $curso){
          ?>
          <option value = "<?php echo $curso['nome']; ?>"><?php echo $curso['nome']; ?></option>
            <?php } ?>
        </select>
      </div><!--form-group-->


      <div class="form-group">
        <label>Nova Capa</label>
        <input type="file" name="capa_turma">
        <input type="hidden" name="imagem_atual" value="<?php echo $value['capa_turma']; ?>">
      </div><!--form-group-->

      <div class="form-group" style="">
        <input type="submit" name="atualizar" value="Atualizar">
      </div><!--form-group-->
      </form>

       </div><!--bottom-edit-noticia-->

</div><!--box-->