<?php

//todo 
// if(isset($_POST['acao_vaga'])){
//     $curso = $_POST['curso'];
// }

?>

<style>
    h2.curso_vaga{
    text-align:center;  
    margin-top:20px;
    font-size:2rem;
    text-transform:uppercase;
    font-weight:bold;
    color:#721011;
    }
</style>
<div class="content-alumin container">
  <div class="top-content-vagas">
    <form method="post">
        <div class="form-group">
          <label>Selecione o curso:</label>
          <select name="curso">
            <?php 
              $curso = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.cursos`");
              $curso->execute();
              $cursos = $curso->fetchAll();
              foreach($cursos as $key => $value){
            ?>
             <option value="<?php echo $value['nome']; ?>" key="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
           <?php } ?>
          </select>
        </div><!--form--group--> 
        <input type="submit" value="Enviar" name="acao_vaga" />
    </form>
  </div><!--top-content-vagas-->


  <?php 
   if(isset($_POST['acao_vaga'])){
    $curso = $_POST['curso'];

    $vagas = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.vagas` WHERE curso = ?");
    $vagas->execute(array($curso));
    $vaga = $vagas->fetchAll();
?>
<div class="row-content-vagas">
    <h3 style="display:block;width:100%; text-align:center;font-size:2rem">Curso: <span style="color:#721011;text-decoration:underline"><?php echo $curso; ?><span></h3>
    <h4 style="display:block;width:100%; text-align:center;font-weight:normal">Número de vagas: <b><?php echo count($vaga); ?></b></h4>
  <?php foreach($vaga as $key => $value){ ?>
     <div class="vaga-single">
         <div class="left-side-vaga">
           <img src="<?php echo INCLUDE_PATH_PAINEL ?>ficheiros_noticias/vagas/<?php echo $value['cartaz'] ?>" />
         </div><!--left-side-vaga-->

         <div class="right-side-vaga">
            <h3><?php echo $value['titulo']; ?></h3>
            <p class="descricao_vaga"><?php echo $value['descricacao']; ?></p>
            <p>Para mais informacoes entre em nosso site: <a href="#"><?php echo $value['link_site'] ?></a></p>
        </div><!--right-side-vaga-->
     </div><!--vaga-single-->
     <?php } ?>
  </div><!--row-content-vagas-->

  <?php }else{ ?>
       <h2 class="curso_vaga">Selecione o curso</h2>
   <?php  } ?>




</div><!--content-alumin container-->