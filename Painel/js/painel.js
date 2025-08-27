$(function(){




$('a.apagar').click(function(){
   let id = $(this).attr('id_item');
     mensagem = confirm("Realmente deseja excluir a turma?");
     if(mensagem == true){
     	  $.ajax({
     	  	url:'ajax/deletar.php',
     	  	method:'post',
     	  	data:{'id_turma':id}
     	  }).done(function(data){
     	  	   alert(data);
     	  });
     }else{
     	return false;
     }


   console.log(id);
})



})