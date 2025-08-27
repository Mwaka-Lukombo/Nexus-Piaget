<base base="<?php echo INCLUDE_PATH ?>">
<id id="<?php echo @$_SESSION['id'] ?>">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
 <script src = "<?php echo INCLUDE_PATH ?>js/jquery-3.7.1.js"></script>
<script src="<?php echo INCLUDE_PATH ?>tinymce/tinymce.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
   $(function(){


    $('#criar_conta').click(function(e){
        e.preventDefault();
        let overlay = $('.overlay');

        overlay.css("display","block");
    })


    let base = $('base').attr('base');
    let overlay = $('.overlay');
        let content = $('.form-content');

        $('.cadastrar-post a').click(function(){
            $('.overlay').fadeIn();
        })

        $('.overlay i').click(function(){
            $('.overlay').fadeOut();
        })

    

      //Cadastro de usuarios  
     $('.btn-cadastrar').click(function() {
        overlay.css('display','block')
        overlay.css('trasition','all 0.10s ease')
        content.css('display','block')
        content.css('trasition','all 0.10s ease')
           
          return false;
     })
     
     //
     $('.close').click(function(){
        overlay.css('display','none')
        overlay.css('trasition','all 0.10s ease')
        content.css('display','none')
        content.css('trasition','all 0.10s ease')
     })

     //Like noticias
     $('.bottom .like').click(function(){
         let icon = $(this);

         alter('Deu like!');
     })
   



     // Variável global para controlar o último ID da mensagem
let ultimoIdMensagem = 0;

// Função para enviar mensagens via AJAX
function enviarMensagem() {
    let mensagem = $('.form_chat textarea').val();
    let id_from = $('[name=id_from]').val();
    let imagem_from = $('[name=imagem_from]').val();
    let id_to = $('[name=id_to]').val();
    let imagem_to = $('[name=imagem_to]').val();
   
   
    $('.form_chat textarea').val('');


    let formData = new FormData();
   
    formData.append('mensagem', mensagem); // Adiciona a mensagem ao FormData
    formData.append('id_from', id_from);   // Adiciona o id_from
    formData.append('id_to', id_to);       // Adiciona o id_to
    formData.append('imagem_from', imagem_from); // Adiciona a imagem do remetente
    formData.append('imagem_to', imagem_to); 

    $.ajax({
        url: 'ajax/chat.php',
        method: 'POST',
        data: formData,
        processData: false,  // Impede o jQuery de tentar processar os dados
        contentType: false,
        success: function(data) {
        // Adiciona a nova mensagem ao final da caixa de chat
        $('.chat-box').append(data);

            // Atualiza o scroll para o final do chat
            $('.chat-box').scrollTop($('.chat-box')[0].scrollHeight);
        },
        error: function(xhr, status, error) {
            console.log("Erro no envio da mensagem: ", error);
        }
     
    });
}

// Função para carregar novas mensagens dinamicamente
function carregarMensagens() {
    let id_from = $('[name=id_from]').val();
    let id_to = $('[name=id_to]').val();

    $.ajax({
        url: 'ajax/consultar_mensagens.php',
        method: 'POST',
        data: {
            id_from: id_from,
            id_to: id_to,
            ultimo_id: ultimoIdMensagem 
        },
        success: function(data) {
            if (data) {
                // Adicionar novas mensagens
                $('.chat-box').append(data);

                // Atualiza o último ID com a última mensagem recebida
                let novaUltimaMensagem = $('.chat-single:last').data('id');
                if (novaUltimaMensagem > ultimoIdMensagem) {
                    ultimoIdMensagem = novaUltimaMensagem;
                }

                // Scroll para o final da janela de chat
                $('.chat-box').scrollTop($('.chat-box')[0].scrollHeight);
            }
        }
    });
}

// Envio da mensagem ao pressionar Enter
$('.form_chat textarea').keydown(function(event) {
    if (event.keyCode === 13 || event.which === 13) {
        event.preventDefault(); // Evitar quebra de linha
        enviarMensagem(); // Enviar mensagem
    }
});

// Envio da mensagem ao submeter o formulário
$('.form_chat').submit(function(event) {
    event.preventDefault(); // Evitar comportamento padrão de recarregamento
    enviarMensagem(); // Enviar mensagem
});

// Carregar novas mensagens a cada 2 segundos
setInterval(carregarMensagens, 2000);




//cadastrar noticias
$('.btn-cadastro').click(function(){
   let form = $('.form-cadastro');
     form.slideToggle();
})

//turma content
$('h2.colegas').click(function(){
    let content_colegas = $('.content-colegas');

      content_colegas.slideToggle();
})

function formatText(command) {
    document.execCommand(command, false, null);
}



$('a.post-turma').click(function(){
    $('div.overlay').css('display','block');
    return false;
})

$('.dots').click(function(){
     let box = $(this).find('div.Menu-dots');
     let icon = $(this).find(' > i');

     if(box.is(':hidden') == true){
         box.css('display','block');
         icon.removeClass('fa-bars').addClass('fa-times');
     }else{
        box.css('display','none');
        icon.removeClass('fa-times').addClass('fa-bars');
     }
});



function uploadFile(input) {
        const file = input.files[0];
        if (file) {
            console.log("Aquivo carregado com sucesso!");
        }
    }



    function addLink(input) {
        const link = input.value;
        if (link) {
            alert(`Link ${link} adicionado.`);
            // Salve o link ou prepare-o para envio junto com o formulário
        }
    }

    function cancelPost() {
        alert("Ação de postar cancelada.");
    
    }

    function submitPost() {
       console.log("Informacao cadastrada com sucesso!");
    }

$('.btn-excluir').click(function(){
     let mensagem = confirm("Realmente Deseja excluir a nota");

     if(mensagem == false){
        return false;
     }else{
        return true;
     }
})


// Conexao javascript

$('h3.title-pesquisa > span').click(function(){
    let box = $('div.content-pesquisa-conexao');
    let button = $('h3.title-pesquisa span').find('i');

    if(box.is(':hidden') == false){
        box.css('display',"none");
        button.removeClass('fa-angle-up');
        button.addClass('fa-angle-down');
    }else{
        box.css('display',"block");
        button.addClass('fa-angle-up');
    }
})

$('div.perfil-content-info span').click(function(){
    $('div.overlay-geral').fadeIn(500);
})

$('.close-conexao-contato').click(function(){
    $('div.overlay-geral').fadeOut(500);
})

// $('.enviar-mensagem').click(function(e){
//     $('div.overlay-mensagem').fadeIn(500);

//     e.preventDefault();
// })
// $('.close-conexao-mensagem').click(function(){
//     $('div.overlay-mensagem').fadeOut(500);
// })


$('.sobre-content span').click(function(){
 $('.sobre-content p').css('height','auto');
    
})
$('.like').click(function(e) {
  e.preventDefault(); 

  let base = $('base').attr('base');
  let noticia_id = $(this).parent().find("form [name=noticia_id]").val();
  let estudante_id = $('id').attr('id'); 
  let icon = $(this).find('i');

  if (icon.hasClass("fa-solid")) {
    //  deslike
    $.ajax({
      method: 'post',
      url: base + 'ajax/deslike.php', 
      data: { 'noticia_id': noticia_id, 'estudante_id': estudante_id }
    }).done(function(data) {
      console.log(data); 
      icon.removeClass("fa-solid").addClass("fa-regular").css("color", "");
       location.reload();
    });
  } else {
    // like
    $.ajax({
      method: 'post',
      url: base + 'ajax/like.php',
      data: { 'noticia_id': noticia_id, 'estudante_id': estudante_id }
    }).done(function(data) {
      console.log(data);
      icon.removeClass("fa-regular").addClass("fa-solid").css("color", "#db1f1f");
      location.reload();
    });
  }
});



$('.box-alumin-top .botoes').click(function(){
   let base = $('base').attr('base');
   let noticia_id = $(this).parent().find("form [name=id_noticia]").val();
   let estudante_id = $('id').attr('id'); 
   let icon = $(this).find('i');

     if(icon.hasClass("fa-regular")){
        $.ajax({
            url:base+'ajax/guardados.php',
            method:'post',
            data:{'noticia_id':noticia_id,'estudante_id':estudante_id}
        }).done(function(data){
            console.log(data);
            icon.addClass("fa-solid");
            icon.removeClass("fa-regular");
        })
     }else{
        $.ajax({
            url:base+'ajax/remover_guardados.php',
            method:'post',
            data:{'noticia_id':noticia_id,'estudante_id':estudante_id}
        }).done(function(data){
            console.log(data);
            icon.removeClass("fa-solid");
            icon.addClass("fa-regular");
        })
     }
})

$('.line-top .remover_guardado').click(function(){
    let base = $('base').attr('base');
    let estudante_id = $('id').attr('id'); 
    let noticia_id = $(this).parent().find("[name=id_noticia]").val();
    let box = $(this).parent().parent().parent();


    $.ajax({
            url:base+'ajax/remover_guardados.php',
            method:'post',
            data:{'noticia_id':noticia_id,'estudante_id':estudante_id}
        }).done(function(data){
            console.log(data);
            location.reload();
            box.fadeOut("slow",function(){
                $(this).remove();
            })
        })
    
})


$('div.bottom form [name=comentar]').click(function(e){
    e.preventDefault();
    let button = $(this);
   let comentario = $(this).parent().parent().find("[name=comentario]").val();
   let noticia_id = $(this).parent().parent().find("[name=noticia_id]").val();
   let estudante_id = $(this).parent().parent().find("[name=estudante_id]").val();


   if (!comentario.trim()) {
        alert("Por favor, insira um comentário.");
        return;
    }

    $.ajax({
        url:base+'ajax/comentario.php',
        method:'post',
        data:{'noticia_id':noticia_id,'estudante_id':estudante_id,'comentario':comentario}
    }).done(function(data){
        console.log(data);
        button.parent().parent().find("[name=comentario]").val("");
        $("div.middle").scrollTop($("div.middle")[0].scrollHeight);
            location.reload();
    })
})


$('div.delete').click(function(e){
    e.preventDefault();
    let mensagem = confirm("Realmente deseja apagar o comentario?");
    let comentario = $(this).find("[name=comentario]").val();
    let estudante_id = $(this).find("[name=estudante_id]").val();
    let noticia_id = $(this).find("[name=noticia_id]").val();

    if(mensagem == true){
         $.ajax({
            url:base+'ajax/deletar_comentario.php',
            method:'post',
            data:{'comentario':comentario,'estudante_id':estudante_id,'noticia_id':noticia_id}
         }).done(function(data){
            console.log(data);
            location.reload();
         })
    }else{
          return false;
    }
     
})


// $('div.box-sucesso').fadeOut(2000);

setTimeout(() => {
    $('div.box-sucesso').animate({
    marginLeft:-10,
    marginTop:-40
},500)
}, 100);


$('.comentario').click(function(){
    let id_noticia = $(this).find('[name=noticia_id]').val();
    let body = $('body');
     
      $.ajax({
        url:base+'ajax/listar_comentario.php',
        method:'post',
        data:{'id_noticia':id_noticia},        
      }).done(function(data){
        setTimeout(function(){
            body.prepend(data);
            $('.listar-comentario-close').click(function(){
             $('.box-comentario-ajax').fadeOut();
            })
        },200)
        
      })
})


})

setTimeout(function(){
    $('div.box-sucesso').fadeOut();
},3000)







const swiper = new Swiper('div.conexao-piaget .swiper', {
    loop:true,
    autoplay: {
    delay: 3000,
    },

    pagination: {
        el: ".swiper-pagination",
      },
});







     
    
    
</script>


</body>
</html>