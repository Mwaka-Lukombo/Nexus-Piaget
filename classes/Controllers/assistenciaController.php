<?php



namespace Controllers;
use Models\assistenciaModel;



class assistenciaController{



    public function index(){
       
        if(isset($_POST['enviar_assunto'])){
            $estudante_id = $_SESSION['id'];
            $problema = $_POST['problema'];
            $assunto = $_POST['assunto'];
            $data = date('Y-m-d H:i:s');
            
            $ok = true;

            if($problema == "" || $assunto == ""){
                $ok = false;

                echo '<script>alert("Não são permitidos campos vazíos")</script>';
            }

            if($ok){
            assistenciaModel::casdastraProblema($estudante_id,$problema,$assunto,$data);
            }
        }

      
      \Views\mainView::index('assistencia.php',['controller'=>$this,],$header = 'pages/includes/headerLogado.php',$footer = "pages/includes/footer.php");
    }

    

    
}