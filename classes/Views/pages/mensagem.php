<?php

if(!isset($_SESSION['login'])){
   \Painel::redirectJS(INCLUDE_PATH);
}
$id_to = (int)@$_GET['usuario'];
$id_from = $_SESSION['id'];
$verifica_id = \Mysql::conectar()->prepare("SELECT id_estudante FROM `tb_site.estudantes` WHERE id_estudante = ?");
$verifica_id->execute(array($id_to));
$imagem_from = \Mysql::conectar()->prepare("SELECT perfil FROM `tb_site.estudantes` WHERE id_estudante = ?");
$imagem_from->execute(array($id_from));
$imagem_from = $imagem_from->fetch()['perfil'];
$imagem_to = \Mysql::conectar()->prepare("SELECT perfil FROM `tb_site.estudantes` WHERE id_estudante = ?");
$imagem_to->execute(array($id_to));
$imagem_to = $imagem_to->fetch()['perfil'];







if(!isset($_GET['usuario'] ) || $_GET['usuario'] == ""){
   \Painel::redirectJS('comunidade');
}



$user = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
$user->execute(array((int)$_GET['usuario']));
$user = $user->fetch();

  
?>





<input type="hidden" name="id_from" value="<?php echo $_SESSION['id']; ?>">
<input type="hidden" name="id_to" value="<?php echo $id_to; ?>">
<input type="hidden" name="imagem_from" value="<?php echo $imagem_from ?>">
<input type="hidden" name="imagem_to" value = "<?php echo $imagem_to?>">

<div class="box container">
 <h3 class='title'>Chat com: <span style='text-transform:capitalize;'><?php print $user['nome'];  ?><span></h3>

      <div class="chat-box  ">
      <!-- <div class="atual_date">'.$labelDia.'</div> -->
      <div class= "logo_mensagem"><img src ="<?= INCLUDE_PATH ?>img/Logo.png"></div>
     

     </div><!--chat-box-->

    <div class="form_chat"> 

     <form method="post" class='mensagem'>
     
      <textarea id="inputMessage" name="mensagem"  placeholder="Mensagem"></textarea>
        <div class="buttons">
         <label>
          <input type="file" multiple name="ficheiros"  style="display:none" accept=".pdf,.doc,.docx,.txt">
          <i class="fa fa-paperclip"></i>
        </label>

        <label class="right-button">
           <input type="submit" name="acao">
           <i class="fa fa-arrow-up"></i>
        </label>
       </div><!--buttons-->
            <!-- <input type="text" name="mensagem" placeholder="mensagem"> -->
            
      </form>
      </div><!--form-->
     

     
</div><!--box-->