<?php


$id_estudante = explode ('/',$_GET['url'])[2];

$estudante = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes_antigos` WHERE id = ?");
$estudante->execute(array($id_estudante));
$estudante = $estudante->fetch();


$dados = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.funcionarios` WHERE cargo = 2 AND email = ?");
$dados->execute(array($estudante['email']));
$dados = $dados->fetch();

$formacao = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudante_antigo_formacao` WHERE id = ?");
$formacao->execute(array($estudante['id']));
$formacao = $formacao->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <script src="https://kit.fontawesome.com/83f5ffa4ac.js" crossorigin="anonymous"></script>
    <!-- link do css -->
     
     <style>
      *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Roboto", sans-serif;
}

html,body{
    height: 100vh;

}

/* == Boot css == */
:root{
    --body-color:#E5E5E5;
    --dominante-color:#FFFFFF;
    --secundary-color:#721011;
    --destaque-color:#FFC107;
    --hover:#8A1A20;
    --color:#e1e1e6;
    --facebook-color:rgba(167, 171, 176,0.7);
}


.clear{
    clear: both;
}

.right{
    float: right;
}

.left{
    float: left;
}

.center{
    float: center;
}

.line{
    width: 700px;
    height: 1px;
    background: #ccc;
    position: absolute;
    top: 30%;
    left: 50%;
    transform: translateX(-50%);
    -ms-transform: translateX(-50%);
}

.container{
    max-width: 900px;
    margin: 0 auto;
    padding: 0 2%;
}

.icon{
    display: none;
}

.selected{
    padding: 10px;
    background:var(--hover);
    border-radius: 12px;
}

.selected_turma{
    padding: 10px;
    background: var(--secundary-color);
}


.fixed{
    position: fixed;
}

.w5{
    width: 5%;
}
.w10{
    width: 10%;
}

.w15{
    width: 15%;
}

.w20{
    width: 20%;
}

.w22{
    width: 22%;
}

.w30{
    width: 25%;
}

.w32{
    width: 32%;
}

.w31{
    width: 31%;
}

.w33{
    width: 33%;
}

.w35{
    width: 35%;
}

.w40{
    width: 40%;
}


.w50{
    width: 53%;
}

.w60{
    width: 60%;
}

.w65{
    width: 65%;
}

.w68{
    width: 68%;
}

.w69{
    width: 69%;
}

.w70{
    width: 70%;
}

.w75{
    width: 75%;
}

.w80{
    width: 80%;
}

.w85{
    width: 85%;
}

.w90{
    width: 90%;
}




.facebook{
 
 color:#1877F2;
}

.twitter{
    color: 	#1DA1F2;
}

.linkedin{
    color: #0a66c2 ;
}

.email{
    color: #c4aeae;
}



/* pdf-content */
div.pdf-content{
    width: 100%;
    height: 500px;
    background: var(--dominante-color);
    margin-top: 20px;
    margin-bottom: 30px;
}


div.pdf-left{
  height:100%;
  padding:20px;
  background: var(--secundary-color);
}

div.pdf-left h3{
    text-align: center;
    font-size: 18px;
    letter-spacing: 0.5px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 15px;
    font-weight: normal;
    color: white;
}


div.contato-single{
  margin-top: 20px;
}

div.contato-single a{
    display: inline-block;
    width: 100%;
    font-size: 12px;
    margin-bottom: 15px;
    font-weight: normal;
    text-decoration: none;
    color: white;
}



div.copy-right{
    width: 100%;
    height: 100px;
    margin-top: 30px;
    text-align: center;
}

div.copy-right span{
    display: inline-block;
    width: 100px;
    height: 100px;
    border-radius: 50%;
}

div.copy-right span > img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}

div.copy-right span:nth-of-type(2){
    color: #646464;
    font-size: 12px;
    font-weight: normal;
}

div.copy-right  p{
    font-size: 14px;
    font-weight: normal;
    color: #646464;
    margin-top: 7px;
}


/* right-pdf  */

div.right-pdf {

    padding: 25px;
    background: var(--dominante-color);
    margin-bottom: 30px;
}


div.right-single{
    padding: 10px;
    margin-bottom: 15px;
}


div.right-single .perfil{
    margin: 12px auto;
    width: 200px;
    height: 200px;
    border: 1px solid #ccc;
    margin-bottom: 50px;
}

div.right-single .perfil img{
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

div.right-single h3{
    font-size: 17px;
    font-weight: bold;
    margin-bottom: 6px;
}

div.right-single p{
    text-align: justify;
    font-size: 13px;
    font-weight: normal;
    line-height: 20px;
    color: #646464;
}


div.formacao-single{
    width: 100%;
    padding: 5px;
    height: auto;
    margin-bottom: 5px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 20px;
}

div.formacao-single .logo-cap{
    width: 30px;
    height: 30px;
}

div.formacao-single .logo-cap img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}


div.formacao-single .info-formacao{
    margin-left: 12px;
}

div.formacao-single .info-formacao p{
    text-align: justify;
}

div.formacao-single .info-formacao h3{
    font-size: 15px;
    font-weight: normal;
    color: #646464;
}

div.formacao-single .info-formacao  p{
    font-size: 13px;
}

div.finaly-copy{
  width: 60px;
  height:60px;
}

div.finaly-copy img{
  width:100%;
  height:100%;
  object-fit:cover;
}

div.rodape-pdf{
   text-align:center;
}

div.rodape-pdf p{
  font-size:14px;
  font-weight:normal;
  color:var(--secundary-color);
}

div.right-single a{
    display:inline-block;
    font-size:13px;
    font-weight:normal;
    color:#646464;
    margin-bottom:10px;
}

     </style>
</head>
<body>

<div class="container">
    <div class="pdf-content">
 

    <div class="right-pdf">
      <div class="finaly-copy">
        <img src="<?php echo INCLUDE_PATH ?>img/Logo.webp">
      </div><!--finaly-copy-->
      <div class="right-single">
        
        <div class="perfil">
          <img src="<?php echo INCLUDE_PATH_PAINEL?>perfil/<?php echo $dados['perfil']; ?>">
          <p style="font-size:11px;width:100%;text-align:center"><?php echo $estudante['curso']; ?></p>
        </div><!--perfil-->
        <h3><?php echo $estudante['nome']; ?></h3>
        <p><?php echo $estudante['sobre']; ?></p>
      </div><!--right-single-->
      
      <div class="right-single">
        <h3>Resumo</h3>
        <p><?php echo $estudante['causas']; ?></p>
      </div><!--right-single-->

  

      <div class="right-single">
        <h3>Experiência</h3>
        <p><?php echo $estudante['Experiencia']; ?></p>
      </div><!--right-single-->

    
      <div class="right-single">
        <h3 style="margin:40px">Formação Académica </h3>
        <div class="formacao-single">
          <div class="logo-cap w5 left">
           <img src="<?php echo INCLUDE_PATH ?>img/graduate.png">
          </div><!--logo-cap-->


          <div class="info-formacao w90 left">
              <h3><?php echo $formacao['ensino_primario']; ?></h3>
              <p><?php echo $formacao['descricao_primario']; ?></p>
           </div><!--info-formacao-->
           
          <div class="clear"></div>
        </div><!--formacao-single-->

        <div class="formacao-single">
          <div class="logo-cap w5 left">
           <img src="<?php echo INCLUDE_PATH ?>img/graduate.png">
          </div><!--logo-cap-->


          <div class="info-formacao w90 left">
              <h3><?php echo $formacao['ensino_secundario']; ?></h3>
              <p><?php echo $formacao['descricao_secundario']; ?></p>
           </div><!--info-formacao-->
           
          <div class="clear"></div>
        </div><!--formacao-single-->


       <div class="formacao-single">
          <div class="logo-cap w5 left">
           <img src="<?php echo INCLUDE_PATH ?>img/graduate.png">
          </div><!--logo-cap-->


          <div class="info-formacao w90 left">
              <h3><?php echo $formacao['ensino_superior']; ?></h3>
              <p><?php echo $formacao['descricao_superior']; ?></p>
           </div><!--info-formacao-->
           
          <div class="clear"></div>
        </div><!--formacao-single-->
      </div><!--right-single-->

      <div class="right-single contato" style="text-align:center">
        <h3>Contato</h3> 
       <div style="display:inline-block"> 
        <p style="margin-bottom:5px;text-align: center;"><?php echo $estudante['facebook']; ?></a>
        <p style="margin-bottom:5px;text-align: center;"><?php echo $estudante['linkedin']; ?></a>
        <p style="margin-bottom:5px;text-align: center;"><?php echo $estudante['twitter']; ?></a>
        <p style="margin-bottom:5px;text-align: center;"><?php echo $estudante['email']; ?></a>
       </div><!--style-->
      </div><!--right-single-->


      <div class="rodape-pdf">
          <p>&copy; Todos os direitos reservados - awTech</p>
        </div><!--rodape-pdf-->
    </div><!--right-pdf w65-->

    </div><!--pdf--content-->
    <br>
    <br>
</div><!--container-->
</body>
</html>