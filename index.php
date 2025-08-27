<?php
include ('config.php');




$homeController = new \Controllers\homeController;
$editarTurmaController = new \Controllers\editarTurmaController;
$compusController = new \Controllers\campusController;
$comunidadeController = new \Controllers\comunidadeController;
$aluminController = new \Controllers\aluminController;
$conexoesController = new \Controllers\conexoesController;
$perfilSinlgeController = new \Controllers\perfilSinlgeController;
$pdfController = new \Controllers\pdfController;
$conexoesExistentes = new \Controllers\conexoesExistentesController;
$guardadosController = new \Controllers\guardadosController;
$mensagemController = new \Controllers\mensagemController;
$solicitacoesController = new \Controllers\solicitacoesController;
$assistenciaController = new \Controllers\assistenciaController;
$respostaController = new \Controllers\respostaController;
$forumController = new \Controllers\forumController;
$forumPostController = new \Controllers\forumPostController;
$topicoForumController= new \Controllers\topicosController;
$turmaController = new \Controllers\turmaController;
$turmaSingleController = new \Controllers\turmaSingleController;
$oldChatController = new \Controllers\oldChatController;



Router::get('/',function() use ($homeController){
    $homeController->index();
});

Router::get('/campus',function() use ($compusController){
     $compusController->index();
});

Router::get('/comunidade',function() use ($comunidadeController){
    $comunidadeController->index();
});

Router::get('/alumin',function() use ($aluminController){
     $aluminController->index();
});

Router::get('/alumin/conexoes', function() use ($conexoesController){
   $conexoesController->index();
});

Router::get('/alumin/conexoes/?',function ($arr) use ($perfilSinlgeController){
    $perfilSinlgeController->index($arr);
});


Router::get('/alumin/conexoes/?/GerarPDF',function() use ($pdfController){
    $pdfController->index();
});

Router::get('/alumin/conexoes_existentes',function() use ($conexoesExistentes){
    $conexoesExistentes->index();
});

Router::get('alumin/guardados',function() use ($guardadosController){
    $guardadosController->index();
});


Router::get('/mensagem',function() use ($mensagemController){
    $mensagemController->index();
});

Router::get('/solicitacoes',function() use ($solicitacoesController){
    $solicitacoesController->index();
});

Router::get('/assistencia',function() use ($assistenciaController){
      $assistenciaController->index();
});

Router::get('/resposta',function() use ($respostaController){
      $respostaController->index();
});


Router::get('/forum',function() use ($forumController){
    $forumController->index();
});

Router::get('/forum/?',function() use ($topicoForumController){
     $topicoForumController->index();
});

Router::get('/forum/?/?', function () use ($forumPostController){
    $forumPostController->index();
});

Router::get('/turma',function() use ($turmaController){
    $turmaController->index();
});

Router::get('/turma/?',function($par) use ($turmaSingleController){
     $turmaSingleController->index($par);
});

Router::get('/turma/?/?',function($par) use ($editarTurmaController){
  $editarTurmaController->index($par);
});


Router::get('mensagem_alumin/?',function() use($oldChatController){
   $oldChatController->index();
});