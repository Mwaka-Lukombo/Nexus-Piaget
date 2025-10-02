<?php

include ('../config.php');

$url = explode('/',@$_GET['url'])[0] ? explode('/',$_GET['url'])[0] : 'home';





$nome = explode(" ",$_SESSION['nome'])[0];





 if(isset($_GET['logout'])){
  session_unset();
  session_destroy();
  header('Location:'.INCLUDE_PATH_PAINEL);
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel de Controle</title>
  
  <!-- link do css -->
   <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL ?>css/painel_1200.css">
   <link rel="icon" href="<?php echo INCLUDE_PATH ?>img/Logo.webp">
   <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <script src="https://kit.fontawesome.com/83f5ffa4ac.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="sidebar open">
  <div class="toggle_button">
     <span>>></span>
  </div><!--toggle_button-->


  <div class="logo">
    <img src="<?php echo INCLUDE_PATH ?>img/Logo.webp">
  
  </div><!--logo-->


  <div class="content-items">

    <div class="items-single <?php if($url == 'home' || $url == '') print 'selected' ?>" >
      <a href="<?php echo INCLUDE_PATH_PAINEL ?>"><i class="bx bx-home"></i></a>
      <span>Painel</span>
    </div><!--items-single-->

  
    <div class="items-single <?php if($url == 'postagens') print 'selected' ?>">
      <a href="<?php echo INCLUDE_PATH_PAINEL ?>postagens"><i class="bx bx-news"></i></a>
      <span>Post's</span>
    </div><!--items-single-->
   

   <?php 
     if($_SESSION['cargo'] == 2){
   ?>
    <div class="items-single <?php if($url == 'gerenciar_postagens') print 'selected' ?>">
      <a href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar_postagens"><i class="bx bx-doughnut-chart"></i></a>
      <span>Gerenciar Post's</span>
    </div><!--items-single-->
    <?php } ?>


 <?php 
   if($_SESSION['cargo'] == 3){
 ?>
    <div class="items-single <?php if($url == 'funcionarios') print 'selected' ?>">
      <a href="<?php echo INCLUDE_PATH_PAINEL ?>funcionarios"><i class="bx bx-user-check"></i></a>
      <span>Funcionários</span>
    </div><!--items-single-->
    <?php } ?>

<?php
  if($_SESSION['cargo'] == 2 || $_SESSION['cargo'] == 1){
?>
    <div class="items-single <?php if($url == 'foruns') print 'selected' ?>">
      <a href="<?php echo INCLUDE_PATH_PAINEL ?>foruns"><i class="bx bx-user-voice"></i></a>
      <span>Fóruns</span>
    </div><!--items-single-->
    <?php } ?>

   
<?php 
   if($_SESSION['cargo'] == 1){
?>
    <div class="items-single <?php if($url == 'turmas') print 'selected' ?>">
      <a href="<?php echo INCLUDE_PATH_PAINEL ?>turmas"><i class="bx bx-chalkboard"></i></a>
      <span>Turmas</span>
    </div><!--items-single-->
   <?php } ?>

<?php
  if($_SESSION['cargo'] == 2){
?>
    <div class="items-single <?php if($url == 'mensagens') print 'selected' ?>">
      <a href="<?php echo INCLUDE_PATH_PAINEL ?>mensagens"><i class="bx bx-conversation"></i></a>
      <span>Mensagens</span>
    </div><!--items-single-->
<?php  } ?>


<?php
  if($_SESSION['cargo'] == 2){
?>
    <div class="items-single <?php if($url == 'conta') print 'selected' ?>">
      <a href="<?php echo INCLUDE_PATH_PAINEL ?>conta"><i class="bx bx-user-pin"></i></a>
      <span>Conta</span>
    </div><!--items-single-->
 <?php  } ?>
  

    <div class="items-single <?php if($url == 'configuracoes') print 'selected'; ?>">
      <a href="<?php echo INCLUDE_PATH_PAINEL ?>configuracoes"><i class="bx bx-cog"></i></a>
      <span>Configurações</span>
    </div><!--items-single-->

    <div class="items-single">
      <a href="<?php echo INCLUDE_PATH_PAINEL ?>?logout"><i class="bx bx-log-out-circle"></i></a>
      <span>Logout</span>
    </div><!--items-single-->

    


   </div> 
  </div><!--content-items-->
</div><!--sidebar-->


<div class="main">
  <div class="menu-perfil">
    <div class="perfil-content right">  
      <div class="perfil-row">
        <div class="dark-content">
          <i class="bx bx-sun"></i>
          <i class="bx bx-moon"></i>
          <div class="selected-icon"></div><!--selected-icon-->
        </div>

        <div class="perfil-info">  
         <h3><?php echo $_SESSION['nome']; ?></h3>
         <p style="font-size:12px;font-weight:normal"><?php echo cargos[$_SESSION['cargo']]; ?></p>
        </div><!--perfil-info-->
        <div class="perfil-avatar">
         <img src="<?php echo INCLUDE_PATH_PAINEL ?>perfil/<?php echo $_SESSION['img']; ?>">
        </div><!--perfil-avatar-->
      </div><!--perfil-row-->
   </div><!--perfil-content-->
   <div class="clear"></div><!--clear-->
 </div><!--meu-perfil-->

<?php



    if(file_exists('pages/'.$url.'.php')){
      include ('pages/'.$url.'.php');
    }else{
      print '<h4>404</h4>
         <p>Pagina nao encontrada</p>
      ';
    }

?>



</div><!--main-->
  


<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/player_4.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/script05.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>



$(()=>{
   $('.deletar-forum').click(function(e){
     mensagem = confirm("Realmente deseja excluir o forum?")
     if(mensagem){
      console.log("Eliminado com sucesso!")
     }else{
      return false;
     }
   })
})


  let section = document.querySelector("section.base");

  setTimeout(() => {
    section.style.opacity = '0';
  }, 2000);
</script>
</body>
</html>