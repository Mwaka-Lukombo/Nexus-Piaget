
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

</style>

<?php
   if(isset($_POST['enviar_assunto'])){
    $email = $_POST['email'];
    $assunto = $_POST['assunto'];

    if($email != $_SESSION['email']){
        print "<script>alert(':( O email e invalido!')</script>";
    }else{
        $verifica = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.assistencia` WHERE email_estudante = ? AND assunto = ?");
        $verifica->execute(array($email,$assunto));
        if($verifica->rowCount() == 0){
    $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.assistencia` VALUES (null,?,?)");
    $sql->execute(array($email,$assunto));
    print '<div class="box-sucesso">
            <p><i class="fa fa-check"></i> Solicitação enviada com sucesso, aguarde a resposta !</p>
        </div>
    ';   
     }else{
            print '<div class="box-sucesso" style="background:tomato">
            <p><i class="fa fa-close"></i> Você já enviou esse assunto, aguarde pela resposta!</p>
        </div>
            ';  
     }
   }

}


?>

<section class="assistencia">
  <div class="box-assistencia">
    <h3><i class="fa fa-pencil"></i> Assistência</h3>
    <form method="post">
      <div class="form-group">
        <label>Email: </label>
        <input type="text" name="email" placeholder = "Email. . .">
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
</section><!--assistencia-->


s




