<?php

  if(isset($_POST['cadastar_topico'])){
    $curso = $_POST['curso'];
    $topico = $_POST['topico'];
    if($topico == ""){
      print "<script>alert('Campus vazios não são vazíos permit')</script>";
    }else{
      $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site_forum` VALUES (null,?,?)");
      $sql->execute(array($curso,$topico));
      print "<script>alert('Topico cadastro com sucesso!')</script>";
    }
  
  }

?>


<div class="box">
    <h3><i class="fa fa-gear forum-gear" style="color:rgba(167, 171, 176,0.7);font-size:18px"></i> Gerenciamento de cursos e fóruns </h3>
    <div class="line"></div><!--line-->

    <div class="forum">
      <form method="post">
        <div class="form-group">
            <label>Todos os cursos:</lable>
            <select name="curso">
               <?php
                 $cursos = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.cursos`");
                 $cursos->execute();
                 $cursos = $cursos->fetchAll();
                 foreach($cursos as $key => $value){
               ?>
               <option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
               <?php } ?>
            </select>
        </div><!--form-group-->

        <div class="form-group ">
            <label>Topico:</label>
            <input type="text" name="topico" placeholder="Topico">
        </div><!--form-group-->

        <div class="form-group">
          <input type="submit" name="cadastar_topico" value="Enviar topico">
        </div><!--form-group-->


      </form>
    </div><!--forum-->
</div><!--box-->

<div class="box" style="margin:20px 0;margin: bottom 100px;">
 <h3><i class="fa fa-id-card-o id-card" style='color:rgba(167, 171, 176,0.7);font-size:18px'></i> Reagir no fórum</h3>
<div class="line"></div><!--line-->
<div class="forum-form">
  <form method="post">
  <div class="form-group">
  <label>Curso:</label>
  <select name="curso_topico">
    <?php
        $curso = \Mysql::conectar()->prepare(" SELECT DISTINCT c.id, c.nome, tp.id_curso 
        FROM `tb_site.cursos` as c
        INNER JOIN `tb_site_forum` as tp 
        WHERE tp.id_curso = c.id ");
        $curso->execute();
      foreach($curso as $key => $value){
    ?>
      <option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
    <?php } ?>
  </select>
  </div><!--form-group-->
 </form>
</div><!--forum-form-->
</div><!--segunda-box-da-aplicacao-->



<div class="box-iteraction-forum">
  
</div><!--box-iteraction-forum-->



<script src="<?php echo INCLUDE_PATH ?>js/jquery-3.7.1.js"></script>
<script src="<?php echo INCLUDE_PATH ?>tinymce/tinymce.min.js"></script>
<script>
   tinymce.init({
            selector: 'textarea',
            toolbar: 'bold italic underline | bullist numlist | link emoticons',
            plugins: 'link emoticons',
            height:300,
            content_css: 'path/para/editor-style.css',
        });
</script>
