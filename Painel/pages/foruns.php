
<?php
 $idCurso = (int)@$_GET['Singleid'];


@$idForumPath = explode('/',@$_GET['url'])[1];


if(isset($_GET['deletar'])){
  $id = (int)$_GET['deletar'];
  $sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site_forum` WHERE id = ?");
  $sql->execute(array($id));
  $post = \Mysql::conectar()->prepare("DELETE FROM `tb_site_forum.post` WHERE id_topico = ?");
  $post->execute(array($id));
  \Painel::redirectJS(INCLUDE_PATH_PAINEL.'foruns');
}

if(isset($_GET['postSingle'])){
  $idPost = (int)$_GET['postSingle'];
  $sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site_forum.post` WHERE id = ?");
  $sql->execute(array($idPost));
  \Painel::redirectJS(INCLUDE_PATH_PAINEL.'foruns/'.$idForumPath);
}



$nome_curso = \Mysql::conectar()->prepare("SELECT `nome` from `tb_site.cursos` WHERE id = ?");
$nome_curso->execute(array($idCurso));
$nome_curso = $nome_curso->fetch(PDO::FETCH_COLUMN);



//Encapsulamento de todo container para mostrar os post's do forum single

if(!$idForumPath){  
?>

<!-- Validacao para cadastrar forum com adiministrador e Docentes -->
<?php
if($_SESSION['cargo'] == 3 || $_SESSION['cargo'] == 1){
if(isset($_POST['cadastar_topico'])){
  $curso = $_POST['curso'];
  $topico = $_POST['topico'];
  if($topico == ""){
    print "<script>alert('Campus vazios não são vazíos permit')</script>";
  }else{
    $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site_forum` VALUES (null,?,?)");
    $sql->execute(array($curso,$topico));
    \Painel::mensagem('sucesso','Topico cadastrado com sucesso!');
  }

}

?>
<div class="box-content" style="margin-bottom:10px">
  <div class="wellcome">
    <h3>Cadastrar Foruns</h3>
  </div><!--wellcome-->

  <form method="post">
    <div class="form-group" style="width:100%">
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
</div><!--box-content-->
<?php } ?> <!-- validacao para cadastrar forum -->


<div class="box-content">
 <div class="wellcome">
    <h3>Curso / Tópico</h3>
 </div>
<?php
  $topicos = \Mysql::conectar()->prepare("SELECT * FROM `tb_site_forum` GROUP BY id_curso");
  $topicos->execute();
  $topicos = $topicos->fetchAll();

 
  foreach($topicos as $key => $value){
  $nome_curso = \Mysql::conectar()->prepare("SELECT `nome`,`id` FROM `tb_site.cursos` WHERE id = ?");
  $nome_curso->execute(array($value['id_curso']));
  $nome_curso = $nome_curso->fetch();

?>
<div class="content-curso">
  <h4><?php echo $nome_curso['nome'] ?></h4>
  <?php
    $topico = \Mysql::conectar()->prepare("SELECT * FROM `tb_site_forum` WHERE id_curso = ?");
    $topico->execute(array($nome_curso['id']));
    $topico = $topico->fetchAll();
    foreach($topico as $key => $value){
  ?>
  <a href="<?php echo INCLUDE_PATH_PAINEL ?>foruns/<?php echo $value['id'] ?>"><?php echo $value['topico'] ?></a>
<?php } ?>
</div><!--content-curso-->
<?php } ?>
</div>
<?php }else{ ?>
  <?php
  if(isset($_POST['cadastrar_forum'])){
     $mensagem = $_POST['post_mensagem'];
     $ok = true;
     $error;

     if($mensagem == ""){
       $ok = false;
       $error = "A mensagem nao pode estar vazia!";
     }else{
       $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site_forum.post` (id,id_topico,nome,mensagem,funcionario_id,cargo) VALUES (null,?,?,?,?,?)");
       $sql->execute(array($idForumPath,$_SESSION['nome'],$mensagem,$_SESSION['id'],$_SESSION['cargo']));
     }
  }



?>
<div class="row-singleForum">
  <?php
    $topicoNome = \Mysql::conectar()->prepare("SELECT `topico` from `tb_site_forum` WHERE id = ?");
    $topicoNome->execute(array($idForumPath));
    $topicoNome = $topicoNome->fetch()['topico'];
  ?>
  <h3 class="title-Single"><?php echo $topicoNome; ?></h3>

  <div class="deletar-forum" id="deletar-forum">
    <a href="<?php echo INCLUDE_PATH_PAINEL ?>foruns/<?php echo $idForumPath ?>/?deletar=<?php echo $idForumPath ?>" class="right"><i class="fa fa-trash"></i></a>
    <div class="clear"></div>
  </div><!--deletar-forum-->
   <div class="row-postagemForumSingle">
    <?php
      $posts = \Mysql::conectar()->prepare("SELECT * FROM `tb_site_forum.post` WHERE id_topico = ?");
      $posts->execute(array($idForumPath));
      $posts = $posts->fetchAll();
     foreach($posts as $key => $value){ ?>
      <?php
        $estudante = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
        $estudante->execute(array($value['id_usuario']));
        $estudante = $estudante->fetch();
      ?>
    <div class="single-Post">
      <?php
        if($value['cargo'] > 0){
          $perfil = \Mysql::conectar()->prepare("SELECT `perfil` from `tb_site.funcionarios` WHERE id = ?");
          $perfil->execute(array($value['funcionario_id']));
          $perfil = $perfil->fetch()['perfil'];
      ?>
       <div class="perfil-single-post">
         <img src="<?php echo INCLUDE_PATH_PAINEL ?>perfil/<?php echo $perfil; ?>">
       </div><!--perfil-single-post-->
       <?php }else{ ?>
         <div class="perfil-single-post">
         <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $estudante['perfil']; ?>">
       </div><!--perfil-single-post-->
      <?php } ?>

       <div class="single-info-post">
        <?php
         if($value['funcionario_id'] == $_SESSION['id']){
        ?>  
        <div class="tools-editing right">
          <a  href="<?php echo INCLUDE_PATH_PAINEL ?>foruns/<?php echo $idForumPath ?>/?postSingle=<?php echo $value['id'] ?>"><i class="fa fa-trash"></i></a>
          <a style="background-color:#FFC107"  href=""><i class="fa fa-pencil"></i></a>
           <div class="clear"></div><!--clear-->
         </div><!--tools-editing-->
         <?php } ?>
        
         <?php
          if($value['cargo'] == 1){
         ?>
         <h4><?php  echo cargos[$value['cargo']]; ?></h4>
         <?php }else if($value['cargo'] == 3){ ?>
           <h4><?php  echo cargos[$value['cargo']] ?></h4>
         <?php }else{ ?>
            <h4><?php  echo $value['nome'] ?></h4>
         <?php } ?>
         <p><?php echo $value['mensagem'] ?></p>
        </div><!--single-info-post-->
     </div><!--single-Post-->
    <?php } ?>


   </div>

   <form method="post" style="margin:40px 0">
    <div class="form-group">
      <textarea placeholder="Mensagem" name="post_mensagem"></textarea>
    </div>

    <div class="form-group">
      <input type="submit" name="cadastrar_forum" value="Enviar" />
    </div>
  </form>
</div>

<?php } ?>


<script>



</script>
