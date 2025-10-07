<?php

namespace Models;


class assistenciaModel{



    public static function casdastraProblema($estudante_id,$problema,$assunto,$data){
        $ok = true;
        $verifica = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.assistencia` WHERE estudante_id = ? AND problema = ? AND problema_id = ?");
        $verifica->execute(array($estudante_id,$assunto,$problema));
        if($verifica->rowCount() == 1){
          $ok = false;
          echo  '<script>alert("O problema ja foi reportado!")</script>';
        }

        if($ok){
           $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_site.assistencia` VALUES (null,?,?,?,?,?)");
            if($sql->execute(array($estudante_id,$problema,$assunto,$data,0))){
              echo '<script>alert("Problema enviado com sucesso!")</script>';
           }
        }
    }
}