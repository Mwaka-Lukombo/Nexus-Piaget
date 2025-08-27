<?php


namespace Controllers;
use \Views\mainView;




class oldChatController{


    public function index(){
        if(isset($_POST['enviar'])){
            
        }
        mainView::oldChat('chatOld');
    }
}