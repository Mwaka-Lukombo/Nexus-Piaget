<?php


namespace Controllers;
use \Views\mainView;



class respostaController{



    public static function index(){
        mainView::index('resposta.php',[],$header = 'pages/includes/headerLogado.php',$footer = "pages/includes/footer.php");
    }
}