<?php


namespace Views;




class mainView{

    static $par;


    public static function setParam($par){
      self::$par = $par;
    }
    public static function index($file, $arr = [],$header = 'pages/includes/header.php',$footer = 'pages/includes/footer.php'){
        include ($header);
        include ('pages/'.$file);
        include ($footer);
      }

      public static function PDF(){
        include ('pages/pdf.php');
      }

      public static function oldChat($file, $arr = [],$header = 'pages/includes/headerOld.php', $footer = 'pages/includes/footerOld.php'){
        include ($header);
        include ('pages/'.$file.'.php');
        include ($footer);
      }
}







?>