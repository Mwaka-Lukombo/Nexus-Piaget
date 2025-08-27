<?php

include ('../config.php');

$oldID = $_POST['id_Old'];
$id_estudante = $_POST['id_estudante'];

$sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.alumin_chat` WHERE estudante_id = ? AND aluno_id = ?");
$sql->execute(array($id_estudante,$oldID));
$sql = $sql->fetchAll();

foreach($sql as $id => $value){

    if($value['estudante_id'] == $_SESSION['id']){
        $classMensagem = 'estudante-envio';
    }else{
        $classMensagem = 'ex_aluno-envio';
    }

    $class = $value['estudante_id'] == $_SESSION['id'] ? 'sent' : 'received';
    echo '
    <div class="chat-single">
       <span>AL</span>
       <p>'.$value['mensagem'].'</p>
     </div><!--chat-single-->
    ';
}