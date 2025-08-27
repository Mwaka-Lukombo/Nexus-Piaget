<?php

namespace Controllers;
use \Views\mainView;




class solicitacoesController{



    public function index(){
        if(isset($_GET['Aceitar'])){
            $idAmigo = (int)@$_GET['Aceitar'];
            $sql = \Mysql::conectar()->prepare(" UPDATE `tb_site.solicitacoes` SET status = 1 WHERE id_from = ? AND id_to = ? AND status = 0");
            $sql->execute(array($idAmigo,$_SESSION['id']));
            print "<script>alert('Aceitou o pedido!')</script>";   
            \Painel::redirectJS(INCLUDE_PATH.'solicitacoes');
        }else if(isset($_GET['Rejeitar'])){
            $idAmigo = (int)@$_GET['Rejeitar'];
            $sql = \Mysql::conectar()->prepare("DELETE FROM `tb_site.solicitacoes` WHERE id_from = ? AND id_to = ? AND status = 0");
            $sql->execute(array($idAmigo,$_SESSION['id']));
            print "<script>alert('Rejeitou o pedido')</script>";
            \Painel::redirectJS(INCLUDE_PATH.'solicitacoes');
        }
        mainView::index('solicitacoes.php',['controller'=>$this],$header = 'pages/includes/headerLogado.php');
    }

    public function listarPedidos(){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.solicitacoes` WHERE id_to = ? AND status = 0");
        $sql->execute(array($_SESSION['id']));
        return $sql->fetchAll(); 
    }

    public function pegarUsuario($id){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }


    // public static function totalPedentes(){
    //      // Buscar todas as solicitações onde id_to é igual ao id da sessão
    // $sql = \Mysql::conectar()->prepare("SELECT COUNT(*) as total FROM `tb_site.solicitacoes` WHERE id_to = ?");
    // $sql->execute(array($_SESSION['id']));

    // // Retornar o total de solicitações pendentes
    // $resultado = $sql->fetch();
    // return $resultado['total'];
    // }

   
}