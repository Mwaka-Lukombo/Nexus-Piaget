<?php
$estudante_id = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes_antigos` WHERE email = ?");
$estudante_id->execute(array($_SESSION['email']));
$estudante_id = $estudante_id->fetch();

if(isset($_GET['deletar'])){
  $noticia_id = (int)$_GET['deletar'];

  $sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site.noticias_alumin` WHERE id = ?");
  $sql->execute(array($noticia_id));
  $sql_1 = \Mysql::conectar()->prepare("DELETE FROM `tb_site.noticias_alumin_like` WHERE noticia_id = ?");
  $sql_1->execute(array($noticia_id));
  $sql_2 = \Mysql::conectar()->prepare("DELETE FROM `tb_site.guardados_noticia` WHERE noticia_id =  ?");
  $sql_2->execute(array($noticia_id));
  \Painel::mensagem('sucesso','Noticia Excluida com sucesso!');
  \Painel::redirectJS(INCLUDE_PATH_PAINEL.'gerenciar_postagens');
}


 $pdo = new PDO("mysql:host=localhost;dbname=nexus", "root", "");






 if(isset($_POST['acao'])){
  $noticia =  $_POST['noticia'];
  $video = @$_FILES['video'];
  $imagem = $_FILES['imagem'];
  $date = date('Y-m-d H:i:s');

  $dir = 'ficheiros_noticias/videos/';
  $dirImagem = 'ficheiros_noticias/imagens/';





  
  move_uploaded_file($video['tmp_name'],$dir.$video['name']);
  move_uploaded_file($imagem['tmp_name'],$dirImagem.$imagem['name']);
  $sql = $pdo->prepare("INSERT INTO `tb_site.noticias_alumin` VALUES (null,?,?,?,?,?)");
  if($sql->execute(array($estudante_id['id'],$video['name'],$imagem['name'],$noticia,$date))){
    $lastId = $pdo->lastInsertId();
    $recentes = $pdo->prepare("INSERT INTO `tb_site_noticias.recentes` VALUES (null,?,?,?,?,?)");
    $recentes->execute(array(@$lastId,$estudante_id['id'],$noticia,$imagem['name'],$date));
    \Painel::mensagem('sucesso','Noticia cadastrada com sucesso!');

  }else{
    \Painel::mensagem('erro','Falha ao cadastrar a noticia!');
  }
  
 }

 if(isset($_POST['acao_vaga'])){
     $estudante_id = $_SESSION['id'];
     $titulo = $_POST['titulo_vaga'];
     $capa_vaga = @$_FILES['capa_vaga'];
     $descricao = $_POST['descricao'];
     $curso = $_POST['curso'];     
     $link = $_POST['link_site'];
     $data = date("Y-d-m H:i");

     $ok = true;
     $dirVaga = "ficheiros_noticias/vagas/";

     if($titulo == "" || $capa_vaga == "" || $descricao == "" || $link == ""){
        echo '<script>alert("Nao sao permitidos campos vazios!")</script>';
        $ok = false;
     }



     // if($ok){
     //   move_uploaded_file($capa_vaga['tmp_name'],$dirVaga.$capa_vaga['name']);
     //   $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.vagas` VALUES (null,?,?,?,?,?,?,?)");
     //   if($sql->execute(array($estudante_id,$titulo,$link,$curso,$capa_vaga['name'],$descricao,$data))){
     //     \Painel::mensagem("sucesso","Vaga cadastrada com sucesso!");
     //   }else{
     //     \Painel::mensagem("erro","Falha ao cadastrar vaga!");
     //   }
     // }
   

 }

?>


<div class="box-content">
  <div class="wellcome">
     <h3>Gerenciar Postagens</h3>
     </div><!--wellcome-->
     <div class="flex">
<div class="flex"> 
     <form method="post" enctype="multipart/form-data">
       

        <div class="form-group">
          <label for="video">Video:</label>
          <input type="file" name="video" accept="video/*">
        </div><!--form-group-->

        <div class="form-group">
          <label>Imagem:</label>
          <input type="file" name="imagem" accept="image/*">
        </div>

        <div class="form-group">
          <label for="nome">Descricao:</label>
          <textarea name="noticia" placeholder="Mensagem"></textarea>
        </div><!--form-group-->

        <div class="form-group">
          <input type="submit" name="acao">
        </div><!--form-group-->
     </form>
  

</div><!--flex--> 

     </div><!--flex-->
</div><!--box-content-->

<div class="box-content" style="margin-top:20px">
 <h3>Adicione Vagas:</h3>

 <form method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label>Titulo da vaga:</label>
     <input type="text" name="titulo_vaga" placeholder="Digite o titulo da vaga">
    </div>

    <div class="form-group">
       <label>Link do site:</label>
       <input type="text" name="link_site">
    </div>

    <div class="form-group">
       <label>Cartaz:</label>
       <input type="file" name="capa_vaga" accept="image/*">
    </div>

    <div class="form-group">

      <label>Curso:</label>
      <select name="curso">
        <?php
          $cursos = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.cursos`");
          $cursos->execute();
          $curso = $cursos->fetchAll();
          foreach($curso as $key => $value){
        ?>
        <option value="<?php echo $value['nome'] ?>" key="<?php echo $value['id'] ?>"><?php echo $value['nome'] ?></option>
        <?php } ?>
      </select>
    </div>

    <div class="form-group">
      <label>Descricaco da Vaga: </label>
      <textarea  placeholder="Descricacoa da Vaga" name="descricao"></textarea>
    </div>

    <div class="form-group">
      <input type="submit" name="acao_vaga" value="Cadastrar">
    </div>
 </form>


</div>


<div class="box-content" style="margin-top:20px">
<div class="wellcome">
     <h3>Gerenciar Postagens</h3>
     </div><!--wellcome-->
<div class="gerenciar-row" style="margin:30px 0">
    <?php

      

      $noticias = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias_alumin` WHERE estudante_id = ?");
      $noticias->execute(array($estudante_id['id']));
      $noticias = $noticias->fetchAll();
      foreach($noticias as $value){
    ?>
     <div class="gerenciar-single">
       <div class="top">
        <?php
          if($value['video']){
        ?>
        <video controls muted autoplay>
        <source src="<?php echo INCLUDE_PATH_PAINEL ?>ficheiros_noticias/videos/<?php echo $value['video']; ?>" type="video/mp4">
        <source src="movie.ogg" type="video/ogg">
        </video>
      <?php }else if($value['imagem']){ ?>
          <img src="<?php echo INCLUDE_PATH_PAINEL ?>ficheiros_noticias/imagens/<?php echo $value['imagem']; ?>">
      <?php } ?>
          

       </div><!--top-->
       <div class="bottom">
         <p><?php echo $value['noticia'] ?></p>
          <div class="button">
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar_postagens?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</i>
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar_postagens?deletar=<?php echo $value['id']; ?>"><i class="fa fa-trash"></i> Apagar</a>
           </div><!--button-->
        </div><!--bottom-->
     </div><!--gerenciar-single-->
    <?php } ?>
  </div><!--gerenciar-row-->

      </div><!--content-->