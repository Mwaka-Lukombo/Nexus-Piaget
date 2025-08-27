<?php




class Mysql{
  static $pdo;


  public static function conectar(){
      if(self::$pdo == null){
          try{
             self::$pdo = new PDO('mysql:host=localhost;dbname=nexus','root','');
          }catch(Exeception $e){
             print "<h1>Falha ao conectar ao banco de dados!</h1>";
          }
      }

      return self::$pdo;
  }
}