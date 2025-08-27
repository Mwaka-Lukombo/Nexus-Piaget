<?php
include ('../config.php');
// Conectar ao banco de dados
$pdo = \Mysql::conectar();

// Dados enviados via AJAX
$id_from = $_POST['id_from'];
$id_to = $_POST['id_to'];
$mensagem = $_POST['mensagem'];
$imagem_from = $_POST['imagem_from'];
$imagem_to = $_POST['imagem_to'];
$data = date('Y-m-d H:i:s');




// if (isset($_FILES['ficheiro'])) {
//     // Recuperar informações do arquivo
//     $ficheiro = $_FILES['ficheiro'];
//     $nomeArquivo = $ficheiro['name']; // Nome original do arquivo enviado
//     $tmpName = $ficheiro['tmp_name'];
    
  
//     move_uploaded_file($tmpName,$pasta.$nomeArquivo);
//     $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.documentos_chat`  VALUES (null, ?, ?, ?)");
//     $sql->execute([$id_from, $id_to, $nomeArquivo]);

//     echo '<script>alert("Ficheiro registrado no banco de dados com sucesso.");</script>';
// } else {
//     echo '<script>alert("Nenhum ficheiro enviado.");</script>';
// }



// Preparar a inserção da mensagem no banco de dados
$query = $pdo->prepare("
    INSERT INTO `tb_site.chat` (id_from, id_to, mensagem,data_envio) 
    VALUES (:id_from, :id_to, :mensagem,:data)
");
$query->execute([
    ':id_from' => $id_from,
    ':id_to' => $id_to,
    ':mensagem' => $mensagem,
    ':data'=>$data,
]);

