<?php




class Painel{





    public static function logout(){
        session_unset();
        session_destroy();
        header('Location:'.INCLUDE_PATH);
    }


    public static function login(){
        return isset($_SESSION['login']) ? true : false;
    }

    public static function redirectJS($url){
        echo '<script>location.href="'.$url.'"</script>';
        die();
    }


    public static function alertJS($par){
        print '<script>"alert('."$par".')"</script>';
    }



    

    public static function mensagem($tipo,$mensagem){
        if($tipo == 'sucesso'){
            print '<section class="base"><i class="fa fa-check"></i> '.$mensagem.'</section>';
        }else if($tipo == 'erro'){
            print '<section class="base"><i class="fa fa-times"></i> '.$mensagem.'</section>';
        }
    }



    public static function Slug($string){
        
    $string = strtolower($string);
    
    
    $string = preg_replace('/[áàãâä]/u', 'a', $string);
    $string = preg_replace('/[éèêë]/u', 'e', $string);
    $string = preg_replace('/[íìîï]/u', 'i', $string);
    $string = preg_replace('/[óòõôö]/u', 'o', $string);
    $string = preg_replace('/[úùûü]/u', 'u', $string);
    $string = preg_replace('/[ç]/u', 'c', $string);
    
    $string = preg_replace('/[^a-z0-9]+/', '-', $string);
    
    
    $string = trim($string, '-');
    
    return $string;
    
}




public static function removeSlug($slug){
    $string = str_replace('-', ' ', $slug);
    
  
    $string = ucwords($string);
    
    return $string;
}

public static function imagemValida($imagem){
    if($imagem['type'] == 'image/jpeg' ||
        $imagem['type'] == 'imagem/jpg' ||
        $imagem['type'] == 'imagem/png'){

        $tamanho = intval($imagem['size']/1024);
        if($tamanho < 900)
            return true;
        else
            return false;
    }else{
        return false;
    }
}

public static function uploadFile($file,$dir){
    $formatoArquivo = explode('.',$file['name']);
    $imagemNome = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];
    if(move_uploaded_file($file['tmp_name'],$dir.$imagemNome))
        return $imagemNome;
    else
        return false;
}


public static function carregarPagina(){
    $url = explode('/',@$_GET['url'])[0] ? $_GET['url'] : 'home';

    if(file_exists('pages/'.$url.'.php')){
        include ('pages/'.$url.'.php');
    }else{
        print "<h3>A pagina nao existe!</h3>";
    }
}


public static function verifica($par){
    $url = explode('/',@$_GET['url'])[0];

    if($par == $url){
        print "class='selected'".'style="color:#faf3f3"';
    }
}





public static function verifica_turma($par){
   $url = explode('/',$_GET['url'])[1];
   if($par == $url){
     print 'selected_turma';
   }
}





public static function Existente($table,$query,$value){       
    $verifica = Mysql::conectar()->prepare(" SELECT * FROM $table $query");
    $verifica->execute(array($value));
    if($verifica->rowCount() == 1){
        return false;
    }else{
        return true;
    }
}

public static function estudanteExistent(){
    $sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes_antigos` WHERE email = ?");
    $sql->execute(array($_SESSION['email']));
    if($sql->rowCount() == 1){
        return true;
    }else{
        return false;
    }
}


public static function verificaCargo(){
    if($_SESSION['cargo'] < 3){
        print 'style="display:none"';
    }
}

public static function verificaAntigo(){
    if($_SESSION['cargo'] == 2){
         print 'style="display:none"';
    }
}

public static function permissaoAntigo(){
    if($_SESSION['cargo'] != 2){
        print 'style="display:none"';
    }
}




}