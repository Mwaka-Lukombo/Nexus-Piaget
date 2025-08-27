<?php

require ('vendor/autoload.php');

@session_start();

$autoload = function($class){
   include ('classes/'.$class.'.php');
};
spl_autoload_register($autoload);






@define('cargos',[
  '0'=>'Secretaria',
  '1'=>'Docente',
  '2'=>'Antigo estudante',
  '3'=>'Administrador'
]);

@define('INCLUDE_PATH', 'http://localhost/nexus/');
@define('INCLUDE_PATH_PAINEL','http://localhost/nexus/painel/');
