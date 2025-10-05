<?php

 if($_SESSION['cargo'] == 3){
?>

<?php

 if(isset($_POST['acao'])){
    $curso = $_POST['curso'];

    $ok = true;

    if($curso == ""){
      echo '<script>alert("O campo nao pode estar vazio")</script>';
      $ok = false;
    }

    $verifica = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.cursos` WHERE nome = ?");
    $verifica->execute(array($curso));
    if($verifica->rowCount() == 1){
      $ok = false;
      echo '<script>alert("O curso ja existe!")</script>';
    }

    if($ok){
      $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.cursos` VALUES (null,?)");
      if($sql->execute(array($curso))){
        \Painel::mensagem("sucesso","Curso cadastrado com sucesso!");
      }
    }
 }

 if(isset($_GET['apagar'])){
   $id = (int)$_GET['apagar'];

   $sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site.cursos` WHERE id = ?");
   if($sql->execute(array($id))){
     \Painel::mensagem("sucesso","Curso excluido com sucesso!");
   }
 }


?>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

a.btn{
 display:flex;
 justify-content:center;
 align-items:center;
 width:100px;
 height:30px;
 text-decoration:none;
 color:white;
 background:tomato;
 margin-inline:auto;
 font-size:0.9em;
 transition:all 0.3s ease;
}

a.btn:hover{
  background:#d94b41;
}
</style>

<div class="box-content">
  <div class="wellcome">
    <h3>Cursos:</h3>
  </div><!--wellcome-->

  <form method="post">
    <div class="form-group">
        <label>Nome do curso:</label>
        <input type="text" name="curso" palceholder="Digite o nome do curso" />
    </div>

    <div class="form-group">
    <input type="submit" name="acao" value="Cadastrar">
  </div><!--form-group-->
    
  </form>
</div><!--box--content-->

<div class="box-content" style="margin-top:20px">
  <h3>Cursos disponiveis:</h3>

  <form>
    <div class="form-group" style="margin-top:10px">
     <table>
      <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Excluir</th>
      </tr>
        <?php 
        $cursos = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.cursos`");
        $cursos->execute();
        $curso = $cursos->fetchAll();
        foreach($curso as $key => $value){
       ?>
      <tr>
        <td><?php echo $value['id']; ?></td>
        <td><?php echo $value['nome']; ?></td>
        <td><a class="btn" href="<?php echo INCLUDE_PATH_PAINEL ?>cursos/?apagar=<?php echo $value['id']; ?>">Exluir</a></td>
      </tr>
      <?php } ?>
</table>
    
      
  
  </div><!--form-group-->
 </form>
</div><!--box-content-->

<script>
 
</script>


<?php }else{ ?>
  <?php 
    include('pages/erro_404.php');   
  ?>
<?php }?>