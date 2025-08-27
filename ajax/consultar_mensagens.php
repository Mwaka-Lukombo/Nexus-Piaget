<?php
include ('../config.php');
// Conectar ao banco de dados
$pdo = \Mysql::conectar();




// Dados enviados via AJAX
$id_from = $_POST['id_from'];
$id_to = $_POST['id_to'];
$ultimo_id = $_POST['ultimo_id']; // O último ID de mensagem carregado (se houver)



// Preparar a consulta das mensagens
$query = $pdo->prepare("
   SELECT * FROM `tb_site.chat`
    WHERE id > :ultimo_id 
    AND ((id_from = :id_from AND id_to = :id_to)
    OR (id_from = :id_to AND id_to = :id_from))
    ORDER BY data_envio ASC
");
$query->execute([
    ':id_from' => $id_from,
    ':id_to' => $id_to,
    ':ultimo_id' => $ultimo_id
]);

$mensagens = $query->fetchAll(PDO::FETCH_ASSOC);




if ($mensagens) {
    foreach ($mensagens as $mensagem) {
        if ($mensagem['id_from'] == $id_from) {
            $classeMensagem = 'mensagem-envio';
            // $imagem = 'uploads/' . $mensagem['imagem_from']; 
        }else{
            $classeMensagem = 'mensagem-recebida';
            // $imagem = 'uploads/' . $mensagem['imagem_to']; 
        }

        $data = date('D, H:i',strtotime($mensagem['data_envio']));
        $dateTime = new DateTime($mensagem['data_envio']);
        $data_atual = new DateTime();
        $dia = $data_atual->diff($dateTime)->days;

        
          $class = $mensagem['id_from'] == $_SESSION['id'] ? 'sent' : 'received';

          
       
        
        echo '
      
        <div class="chat-single '.$class.'" data-id="' . $mensagem['id'] . '">
     
            <p class = '.$classeMensagem .'>' . $mensagem['mensagem'] . '</p>
             <p class="hora">'.$data.'</p>
        </div><!--chat-single-->';
    }
}
