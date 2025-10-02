<?php
$url = explode('/',@$_GET['url'])[0];
@$header = explode ('/',@$_GET['url'])[0];
  if(isset($_GET['logout'])){
     \Painel::logout();
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="icon" href="<?php echo INCLUDE_PATH ?>img/logo.webp">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH ?>css/forum_2100.css">
    <script src="https://kit.fontawesome.com/83f5ffa4ac.js" crossorigin="anonymous"></script>
    
</head>
<body>


<?php

?>

<header <?php if($header == 'turma' || $header == 'forum') echo 'style="position:fixed;width:100%;z-index:2"'; ?>>
 <div class="container">
    <div class="logo left">
        <a href="<?php echo INCLUDE_PATH ?>campus"><img src="<?php echo INCLUDE_PATH ?>img/Logo.webp"></a>
    </div><!--logo-->


    <div class="icon">
        <i class="fa fa-bars"></i>
    </div><!--icon-->

    
    <ul class="desktop right">
    <li>
            <a href="<?php echo INCLUDE_PATH ?>campus">Home</a>
        </li>
        <li>
            <a href="<?php echo INCLUDE_PATH ?>comunidade" <?php \Painel::verifica('comunidade'); ?>>Comunidade</a>
        </li>

        <li>
            <a href="<?php echo INCLUDE_PATH ?>alumin" <?php \Painel::verifica('alumin'); ?>>Alumin</a>
        </li>

        <li>
            <a href="<?php echo INCLUDE_PATH ?>assistencia  " <?php \Painel::verifica('assistencia'); ?>>Assistência</a>
        </li>

        <li>
            <a href="<?php echo INCLUDE_PATH ?>forum" <?php \Painel::verifica('forum'); ?>>Fórum</a>
        </li>

        <li>
            <a href="<?php echo INCLUDE_PATH ?>turma" <?php \Painel::verifica('turma'); ?>>Turma</a>
        </li>

        <li>
            <a href="?logout"><i class="fa fa-power-off"></i></a>
        </li>
    </ul>

    
    <ul class="mobile right">

    <div class="icon-close">
      <i class="fa fa-times"></i>
    </div><!--icon-close-->
        <li>
            <a href="<?php echo INCLUDE_PATH ?>campus">Home</a>
        </li>
        <li>
            <a href="<?php echo INCLUDE_PATH ?>comunidade" <?php \Painel::verifica('comunidade'); ?>>Comunidade</a>
        </li>

        <li>
            <a href="<?php echo INCLUDE_PATH ?>alumin" <?php \Painel::verifica('alumin'); ?>>Alumin</a>
        </li>

        <li>
            <a href="<?php echo INCLUDE_PATH ?>assistencia  " <?php \Painel::verifica('assistencia'); ?>>Assistência</a>
        </li>

        <li>
            <a href="<?php echo INCLUDE_PATH ?>forum" <?php \Painel::verifica('forum'); ?>>Fórum</a>
        </li>

        <li>
            <a href="<?php echo INCLUDE_PATH ?>turma" <?php \Painel::verifica('turma'); ?>>Turma</a>
        </li>

        <li>
            <a href="?logout"><i class="fa fa-power-off"></i></a>
        </li>
    </ul>

    <div class="clear"></div><!--clear-->
 </div><!--container-->
</header>