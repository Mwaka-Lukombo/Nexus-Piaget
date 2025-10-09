<?php


if($_SESSION['cargo'] == 3){

  $id = (int)@$_GET['tipo'];

  if(isset($_GET['delete'])){
     $deleteId = (int)$_GET['delete'];

     $sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site.assistencia` WHERE problema_id = ?");
     if($sql->execute(array($deleteId))){
       echo '<script>alert("Item excluido com sucesso!")</script>';
       \Painel::redirectJS(INCLUDE_PATH_PAINEL.'suporte');
     }
  }
?>



<div class="box-content">
  <div class="wellcome">
    <h3>Suporte: <span></span></h3>
  </div><!--wellcome-->



<?php
    if(!isset($_GET['tipo'])){
?>
  <!-- suporte types -->
  <div class="row-elements">
    <?php
        $tipo_erro = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.tipo_assitencia`");
        $tipo_erro->execute();
        $tipo_erro = $tipo_erro->fetchAll();
        foreach($tipo_erro as $key => $value){
    ?>
    <div class="single-element" key="<?php echo $key; ?>">
      <a href="<?php echo INCLUDE_PATH_PAINEL ?>suporte?tipo=<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></a>
    </div><!--single-element-->
   <?php } ?>

  </div><!--row-elements-->
  <?php }else{ ?>
      <div class="row-problemas">

      <!-- Se nao tiver problemas -->

    <?php
      if(!isset($_GET['responder'])){
    ?>
       
      <?php
       $id = (int)$_GET['tipo'];
        $problemas = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.assistencia` WHERE problema_id = ? AND status = 0");
        $problemas->execute(array($id));
        $problemas = $problemas->fetchAll();
        foreach($problemas as $key => $value){
          $estudante = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
          $estudante->execute(array($value['estudante_id']));
          $estudante = $estudante->fetch();
      ?>
        <div class="problemas-single">
          
        <div class="delete-problem">
          <a href="<?php echo INCLUDE_PATH_PAINEL ?>suporte?tipo=<?php echo $id ?>&&delete=<?php echo $id; ?>"><i class="fa fa-trash"></i></a>
        </div><!--delete-problem-->
        
          <div class="top-problemas-single">
             <div class="dados-stutent">
               <div class="perfil-avatar">
                 <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $estudante['perfil'];  ?>" />
               </div>
               <p><?php echo $estudante['nome']; ?></p>
               <p><?php echo $estudante['curso']; ?></p>
             </div><!--dados-stutent-->
          </div><!--top-problemas-single-->

          <div class="description-problem">
            <p><?php echo $value['problema']; ?></p>
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>suporte?tipo=<?php echo $id ?>&&responder=<?php echo $id; ?>">Reponder</a>
          </div><!--description-problem-->
        </div><!--problemas-single-->



       <?php } ?>
      </div><!--row-problemas-->
     <?php }else{ ?>
      <?php
       $idResponder = (int)$_GET['responder'];
       $problema = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.assistencia` WHERE problema_id = ?");
       $problema->execute(array($idResponder));
       $problema = $problema->fetch();

       if(isset($_POST['acao_responder'])){
          $estudante_id = $_POST['estudante_id'];
          $problema_id = $_POST['problema_id'];
          $assistencia_id = $_POST['assistencia_id'];
          $resposta = $_POST['resposta'];
          $data = date('Y-m-d H:i:s');

          $ok = true;

          if($resposta == ""){
            $ok = false;
            echo '<script>alert("Você não pode passar campos vazíos!")</script>';
          }

          if($ok){
             $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.assistencia.resposta` VALUES (null,?,?,?,?,?)");
             if($sql->execute(array($estudante_id,$problema_id,$assistencia_id,$resposta,$data))){
              $update = \Mysql::conectar()->prepare("UPDATE `tb_site.assistencia` SET status = 1 WHERE id = ?");
              $update->execute(array($assistencia_id));
               \Painel::mensagem("sucesso","Resposta enviada com sucesso!");
             }
          }
       }
      ?>
          <div class="content-problema">
            <p><?php echo $problema['problema']; ?></p>
          </div><!--content-problema-->
         <form method="post">
           <div class="form-group">
             <label for="resposta">Resposta:</label>
             <textarea name="resposta"></textarea>
           </div><!--form-groupp-->

           <div class="form-group">
             <input type="hidden" name="estudante_id" value="<?php echo $problema['estudante_id']; ?>" />
             <input type="hidden" name="problema_id" value="<?php echo $problema['problema_id'] ?>" />
             <input type="hidden" name="assistencia_id" value="<?php echo $problema['id'];  ?>" />
           </div><!--form-group-->

           <div class="form-group">
            <input type="submit" name="acao_responder" value="Responder" />
           </div><!--form-group-->
         </form>
     <?php  } ?>

   <?php } ?>
  
</div><!--box-content-->



<?php }else{ ?>
 <?php
  include ('pages/erro_404.php');
 ?>
<?php } ?>