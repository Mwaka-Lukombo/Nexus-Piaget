<?php

namespace Controllers;
use Views\mainView;



class assistenciaSingle{


    public function index(){
      mainView::index('assistenciaSingle.php',[],$header = 'pages/includes/headerLogado.php',$footer = 'pages/includes/footer.php');
    }
}


