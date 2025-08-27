<?php




class Galeria{

    public static function imagens($id){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias_imagens` WHERE noticia_id = ?");
        $sql->execute(array($id));
        
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function imagemAtual($id){
        $atual = isset($_GET['imagem']) ? (int)$_GET['imagem'] : '0';
        if($atual < 0)
          $atual = 0;
        if($atual >= count(self::imagens($id)))
            $atual = count(self::imagens($id)) - 1;
            return self::imagens($id)[$atual];
    }

    public static function imagemAnterior($id){
        $atual = isset($_GET['imagem']) ? (int)$_GET['imagem'] : '0';
        $atual--;
        if($atual < 0)
          $atual = 0;
          return '?imagem='.$atual;
    }

    public static function proximaImagem($id){
       $atual = isset($_GET['imagem']) ? (int)$_GET['imagem'] : '0';
       $atual++;
       if($atual >= count(self::imagens($id)))
          $atual = count(self::imagens($id)) - 1;

          return '?imagem='.$atual;
    }
  
}