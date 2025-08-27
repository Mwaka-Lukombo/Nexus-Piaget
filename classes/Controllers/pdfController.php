<?php


namespace Controllers;

use \Views\mainView;



class pdfController{



    public function index(){
        mainView::PDF();
    }
}