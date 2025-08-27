<?php
  if(!@$_SESSION['login']){
      \Painel::redirectJS(INCLUDE_PATH);
  }
  

?>


<section class="side-forum">
 <div class="forum-elements"> 
  <div class="row">
    <div class="single">
        <h3>Fórum</h3>
    </div><!--single-->

    <div class="single_2">
        <form method="post">
          <div class="input">
             <input type="search" name="pesquisa" placeholder="Pesquise por palavras">
          </div><!--input-->

          <div class="input">
             <input type="submit" name="pesquisa">
             <i class="fa fa-search"></i>
          </div><!--input-->
        </form>
    </div><!--single-->
 </div><!--row-->



<table>
  <tr>
    <th>Curso</th>
    <th>Tópicos</th>
  </tr>

  <?php
    $cursos = $arr['controller']->listarCursos();
    foreach($cursos as $value){

      $topicos = \Mysql::conectar()->prepare("SELECT * FROM `tb_site_forum` WHERE id_curso = ?");
      $topicos->execute(array($value['id']));
      $total_topicos = count($topicos->fetchAll());
  ?>
  <tr>
    <td><a href="forum/<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></a></td>
    <td><i class="fa fa-comment"></i> <?php echo $total_topicos; ?></td>
  </tr>
  <div class="clear"></div><!--clear-->
  <?php } ?>

  


</table>
</div><!--forum-section-->
  </div><!--forum-elements-->
</section><!--side-forum-->
