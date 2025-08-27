<?php

include ('../config.php');


$mensagem = $_POST['message'];
$oldID = $_POST['id_Old'];
$id_estudante = $_POST['id_estudante'];


$sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.alumin_chat` (id,estudante_id,aluno_id,mensagem) VALUES (null,?,?,?)");
$sql->execute(array($id_estudante,$oldID,$mensagem));
$lastID = \Mysql::conectar()->lastInsertId();



echo '
 <div class="chat-single">
       <span>AL</span>
       <p>'.$mensagem.'</p>
     </div><!--chat-single-->
';
