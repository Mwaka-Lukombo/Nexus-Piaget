
<style>
    div.box-sucesso{
    padding:10px;
    max-width:400px;
    margin:0 auto;
    position: relative;
    top:50px;
    background: var(--color-success);
}

div.box-sucesso p{
    text-align:center;
    font-size:14px;
    font-weight:normal;
    color:white;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-top:10px;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}



.btn-assistencia{
  display:inline-block;
  text-align:center;
  line-height:40px;
  width:100px;
  height:40px;
  color:#fff;
  font-size:0.9em;
  border-radius:20px;
  text-decoration:none;
}

.progresso{
  background:#cf5b53;
  cursor:not-allowed;
}

.resposta{
  background:#0b734b;
}


.resposta:hover{
  background:#0b5e3e;
}

</style>

<section class="assistencia">
  <div class="box-assistencia">
    <h3><i class="fa fa-pencil"></i> Assistência</h3>
    <form method="post">
      <div class="form-group">
        <label>Problema: </label>
        <select name="problema">
         <?php 
          $problema = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.tipo_assitencia`");
          $problema->execute();
          $problemas = $problema->fetchAll();
          foreach($problemas as $key => $value){
         ?>
         <option value="<?php echo $value['id']; ?>" key="<?php echo $key ?>"><?php echo $value['nome']; ?></option>
        <?php }  ?> 
        </select>
      </div><!--form-group-->

      <div class="form-group">
        <label>Assunto: </label>
        <textarea name="assunto" placeholder="Assunto"></textarea>
     </div><!--form-group-->

     <div class="form-group">
        <input type="submit" name="enviar_assunto" value="Assunto">
     </div><!--form-group-->
    </form><!--form-->

 </div><!--box-assistencia-->

 <?php

  $problemas = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.assistencia` WHERE estudante_id = ?");
  $problemas->execute(array($_SESSION['id']));
  if($problemas->rowCount() >= 1){
?>

 <div class="reporter-assistencia">
     <h3><i class="fa-solid fa-triangle-exclamation"></i> Problemas:</h3>

     <table>
  <tr>
    <th>Tipo de Problema</th>
    <th>Problema</th>
    <th>Status</th>
  </tr>

  <?php
   $meusProblemas = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.assistencia` WHERE estudante_id = ?");
   $meusProblemas->execute(array($_SESSION['id']));
   $meusProblemas = $meusProblemas->fetchAll();
   foreach($meusProblemas as $key => $value){
    $tipoProblema = \Mysql::conectar()->prepare("SELECT nome FROM `tb_site.tipo_assitencia` WHERE id = ?");
    $tipoProblema->execute(array($value['problema_id']));
    $tipoProblema = $tipoProblema->fetch()['nome'];
  ?>
  <tr>
    <td><?php echo $tipoProblema; ?></td>
    <td><?php echo $value['problema']; ?></td>
    <td>
      <?php 
        if($value['status'] == 0){
      ?>
      <a href="#" class="btn-assistencia progresso">Progresso</a>
    <?php }else if($value['status'] == 1){ ?>
        <a href="<?php echo INCLUDE_PATH ?>assistencia/<?php echo $value['id']; ?>" class="btn-assistencia resposta">Resposta</a>
      <?php } ?>
     </td>
  </tr>
<?php } ?>


  
</table>
 </div><!--reporter-assistencia-->
 <?php } ?>  

</section><!--assistencia-->





