<?php
   $oldID = explode ('/',$_GET['url'])[1];

?>

<section class="content-box-chat">
  <div class="content-chat">
    <?php
      for($i = 0; $i < 0; $i++){
    ?>
     <div class="chat-single">
       <span>AL</span>
       <p>Ola tudo bem?</p>
     </div><!--chat-single-->

     <?php } ?>
  
   </div><!--content-chat-->
  <form method="post">
    <div class="form-group">
      <input type="text" name="message" placeholder="Chat on...">
      <input type="submit" name="enviar" value="Chat">
      <input type="hidden" name="oldID" value="<?php echo $oldID; ?>">
      <input type="hidden" name="estudante_id" value="<?php echo $_SESSION['id']; ?>">
    </div><!--form-group-->
  </form>
</section><!--content-box-chat-->