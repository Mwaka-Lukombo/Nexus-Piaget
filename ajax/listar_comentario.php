<?php


include ('../config.php');



$id_noticia = $_POST['id_noticia'];



$sql = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.comentario_alumin` WHERE noticia_id = ?");
$sql->execute(array($id_noticia));
if($sql->rowCount() == 0){
    return false;
}else{

  $sql = $sql->fetchAll();
  
  $total = count($sql);
    
print '

<div class="box-comentario-ajax" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(86, 84, 84, 0.6);z-index:1099">
 <div class="listar-comentario-close" style="font-size:20px;position:fixed;top:20px;right:20px;cursor:pointer;color:white">
   <i class="fa fa-times"></i>
 </div><!--lose-listar-comentarios--> 



 <div class="coment-content-list" style="max-width:700px;width:90%;height:400px;overflow-y: auto;border-radius:12px;margin:100px auto;background:white">
   <h3 style="border-radius:12px 12px 0px 0px;padding:15px;background:brown;color:white;width:100%"> <b>'.$total.'</b> Comentário(os) <i style="color:" class="fa fa-comments"></i></h3>
    
   ';
   foreach($sql as $key => $value){
    $aluno = \Mysql::conectar()->prepare("SELECT * FROM `tb_site.estudantes` WHERE id_estudante = ?");
    $aluno->execute(array($value['estudante_id']));
    $aluno = $aluno->fetch();
     print '
   <div class="flex-elements" style="display:flex;flex-wrap:nowrap;padding:20px">
     <div class="avatar-element-perfil w10" style="width:40px;height:40px;border:1px solid red;border-radius:50%">
         <img src="'.INCLUDE_PATH.'uploads/'.$aluno['perfil'].'" style="width:100%;height:100%;border-radius:100%;object-fit:cover">
     </div><!--avatar-element-perfil-->

     <div class="comment-perfil-element w90" style="background:#646464;border-radius:12px;color:white;padding:5px;margin-left:12px;font-size:13px;font-weight:normal">
       <h4 style="color:#868a87">'.$aluno['nome'].'</h4>
       <p style="font-weight:normal">'.$value['comentario'].'</p>
     </div><!--comment-perfil-element-->
   </div><!--flex-elements-->
   ';

  };

 print '
</div><!--comentario-ajax-->

';
}









