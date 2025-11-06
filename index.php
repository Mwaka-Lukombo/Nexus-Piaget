<?php
include ('config.php');




$homeController = new \Controllers\homeController;

$compusController = new \Controllers\campusController;

$aluminController = new \Controllers\aluminController;
$conexoesController = new \Controllers\conexoesController;
$perfilSinlgeController = new \Controllers\perfilSinlgeController;
$pdfController = new \Controllers\pdfController;
$conexoesExistentes = new \Controllers\conexoesExistentesController;
$guardadosController = new \Controllers\guardadosController;
$mensagemController = new \Controllers\mensagemController;
$solicitacoesController = new \Controllers\solicitacoesController;
$assistenciaController = new \Controllers\assistenciaController;
$oldChatController = new \Controllers\oldChatController;
$vagasController = new \Controllers\vagasController;




Router::get('/',function() use ($homeController){
    $homeController->index();
});

Router::get('/campus',function() use ($compusController){
     $compusController->index();
});


Router::get('/alumin',function() use ($aluminController){
     $aluminController->index();
});

Router::get('/alumin/conexoes', function() use ($conexoesController){
   $conexoesController->index();
});

Router::get('/alumin/vagas',function() use ($vagasController){
  $vagasController->index();
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

