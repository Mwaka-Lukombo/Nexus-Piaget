<?php



namespace Controllers;



class assistenciaController{



    public function index(){
       
        // if(isset($_POST['enviar_assunto'])){
        //     $email = $_POST['email'];
        //     $assunto = $_POST['assunto'];

        //     // $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.assistencia` VALUES (null,?,?)");
        //     // $sql->execute(array($email,$assunto));
        //     print '<div class="box-sucesso">
        //         <i class="fa fa-check"></i> Responta
        //       </div>
        //     ';
            
        // }

      
      \Views\mainView::index('assistencia.php',['controller'=>$this,],$header = 'pages/includes/headerLogado.php',$footer = "pages/includes/footer.php");
    }

    

    
}