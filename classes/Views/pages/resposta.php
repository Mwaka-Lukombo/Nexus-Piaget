
<style>
    section.resposta{
        width: 90%;
        max-width:800px;
        height:auto;
        background:#fff;
        padding:20px;
        border-radius:12px;
        margin:100px auto;
        position:relative;
    }

    div.question{
        padding:8px;
        overflow-y:auto;
        border:1px solid #ccc;
        border-radius:12px;
        margin-bottom:10px;
    }

    div.question p{
        font-size:14px;
        line-height:20px;
        text-align:justify;
        font-weight:normal;
        color:#646464;
    }

    h4.question{
        padding:5px;
        color:#646464;
        font-size:13px;
    }
</style>

<?php




$perguntas = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.assistencia` WHERE email_estudante = ?");
$perguntas->execute(array($_SESSION['email']));
$perguntas = $perguntas->fetchAll();
   foreach($perguntas as $value){
?>
<section class="resposta">
  <h3 class="title"><i class="fa fa-comment-o" style="color:#721011"></i> Respostas: </h3>
    <h4 class="question">Questão <i class="fa fa-lightbulb" style="color:#721011"></i></h4>
    <div class="question">
      <p><?php echo $value['assunto']; ?></p>
    </div><!--question-->

    <h4 class="question">Respota: <i class="fa fa-circle-exclamation" style="color:#721011"></i></h4>
    <div class="question">
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eaque voluptate reprehenderit ab saepe maiores illum porro ex, voluptatum ducimus vel inventore harum commodi, quasi quam necessitatibus suscipit vero itaque tempora!</p>
    </div><!--question-->

</section><!--resposta-->

<?php } ?>