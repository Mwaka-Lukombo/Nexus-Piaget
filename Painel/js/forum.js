gsap.fromTo('.forum-gear',{
    rotation:0
},{
    rotation:360,
    duration:1.5,
    repeat:-1,
    ease:'linear'
})

gsap.fromTo('.id-card',{
    opacity:0,
    duration:2
},{
    opacity:1,


})


$('[name=curso_topico]').change(function(){
  let curso = $(this).val();
  let form = $('.forum-form') ;
    $.ajax({
        url:'../ajax/forum.php',
        method:'post',
        data:{'curso':curso}
    }).done(function(data){
        form.find('.form-group:nth-child(2)').remove();
        form.append('<div class="form-group"><label>Topico:</label><select name="topico"><option selected>'+data+'</option></select></div>');

        $(document).on('change', '[name=topico]', function() {
            let topico = $(this).val();
            let box = $('.box-iteraction-forum');

        
            // Segunda requisição AJAX para tratar o tópico selecionado
            $.ajax({
                url: '../ajax/forum_post.php',
                method: 'post',
                data: {'topico': topico}

            }).done(function(data){
                 box.find('.single-forum:nth-child(1)').remove();
                 box.prepend('<div class="single-forum">'+data+'</div>');
            })
        
    })

    $(document).on('change','[name=topico]', function(){
         let topico = $(this).val();
         let box = $('.box-iteraction-forum');

        let formHTML = `
         <form method="post">
           <div class="form-group">
            <textarea name = "mensagem" placeholder="Cadastrar Forum"></textarea>
           </div><!--form-group-->
            <input type="hidden" name="topico" value="${topico}">
           <div class = "form-group">
             <input type="submit" name="acao" value = "Enviar forum">
           </div><!--form--group-->
         </form>


         <script src="'.INCLUDE_PATH.'>js/jquery-3.7.1.js"></script>
         <script src="'.INCLUDE_PATH.'>tinymce/tinymce.min.js"></script>
         <script>
   tinymce.init({
            selector: "textarea",
            toolbar: "bold italic underline | bullist numlist | link emoticons",
            plugins: "link emoticons",
            height:300,
            content_css: "path/para/editor-style.css",
        });
</script>
        `;
        box.html(formHTML);
    })

    $(document).on('click','.box-iteraction-forum [name=acao]',function(e){
      let acao = $(this);
      let mensagem = $('[name=mensagem]').val();
      let topico = $('[name=topico]').val();

      
    console.log("Clicado com sucesso!");
        $.ajax({
            url:"../ajax/forum_post.php",
            method:'post',
            data:{'acao':acao,
                'mensagem':mensagem,
                'topico':topico
            }
        }).done(function(data){
            console.log(data);
        })

        e.prevetDefault();
    })

})

})



