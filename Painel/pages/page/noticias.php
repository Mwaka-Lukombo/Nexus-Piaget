
<?php

   if(isset($_GET['deletar'])){
       $noticia_id = (int)$_GET['deletar'];

       $sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site.noticias_alumin` WHERE id = ?");
       $sql->execute(array($noticia_id));
       $sql_1 = \Mysql::conectar()->prepare("DELETE FROM `tb_site.noticias_alumin_like` WHERE noticia_id = ?");
       $sql_1->execute(array($noticia_id));
       $sql_2 = \Mysql::conectar()->prepare("DELETE FROM `tb_site.guardados_noticia` WHERE noticia_id =  ?");
       $sql_2->execute(array($noticia_id));
       print '<script>alert("Noticia excluida com sucesso!")</script>';
       \Painel::redirectJS(INCLUDE_PATH_PAINEL.'noticias');
     }

    $id_estudante = \Mysql::conectar()->prepare("SELECT `id` FROM `tb_site.estudantes_antigos` WHERE email = ?");
    $id_estudante->execute(array($_SESSION['email']));
    $id_estudante = @$id_estudante->fetch()['id'];

   if(isset($_POST['cadastrar_noticia'])){


    $noticia =  $_POST['noticia'];
    $video = @$_FILES['video'];

    $dir = 'ficheiros_noticias/videos/';

  
    
    move_uploaded_file($video['tmp_name'],$dir.$video['name']);
    $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.noticias_alumin` VALUES (null,?,?,?)");
    $sql->execute(array($id_estudante,$video['name'],$noticia));
    print '<script>alert("Noticia cadastrada com sucesso!")</script>';
   
   }
?>
<div class="box">
  <h3><i class="fa fa-newspaper"></i> Post's</h3>
  <div class="line"></div>
  
  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label>Nome:</label>
      <input type="text" name="nome" placeholder="* Seu nome . . .">
    </div><!--from-group-->

    <div class="form-group">
      <label>Video:</label>
      <input type="file" name="video" accept="video/*">
    </div><!--form-group-->

    <div class="form-group">
      <label>Noticia:</label>
      <textarea name="noticia" placeholder="*Noticia . . ."></textarea>
    </div><!--form-group-->

    <div class="form-group">
      <input type="submit" name="cadastrar_noticia" value="Cadastar !">
    </div><!--form-group-->

  </form>

</div><!--box-->
<br>
<br>

<div class="box">
 <h3><i class="fa fa-pencil"></i> Gerenciar Postagens</h3>
   <div class="line"></div><!--line-->
    <div class="overflow" style="overflow-x: auto;">
      <table>
          <tr>
            <th>Noticia</th>
            <th>Editar</th>
            <th>Deletar</th>
          </tr>
            <?php

              $todas_noticias = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias_alumin` WHERE estudante_id = ?");
              $todas_noticias->execute(array($id_estudante));
              $todas_noticias = $todas_noticias->fetchAll();
              foreach($todas_noticias as $key => $noticia){
            ?>
          <tr>
             <td><?php echo $noticia['noticia']; ?></td>
             <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>editar_noticia?id_noticia=<?php echo $noticia['id']; ?>" class="editar"><i class="fa fa-pencil"></i></a></td>
             <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>noticias?deletar=<?php echo $noticia['id']; ?>" class="edtar deletar_noticia" style="background: tomato;"><i class="fa fa-trash"></i></a></td>
          </tr>
          <?php } ?>
      </table>
    </div><!--over-flow-->
</div><!--box-->  




