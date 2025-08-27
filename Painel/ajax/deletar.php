<?php



 \Mysql::conectar()->exec("DELETE FROM `tb_site.turma` WHERE id = $_POST[id_turma]");
 \Painel::alert('sucesso','Turma excluida com sucesso!');


?>