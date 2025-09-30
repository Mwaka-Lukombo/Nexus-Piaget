<?php

namespace Controllers;
use Views\mainView;






class vagasController{


    public function index(){
       mainView::index('vagas.php',$arr=[],$header = 'pages/includes/headerForum.php',$footer = 'pages/includes/footer.php');
    }

}

