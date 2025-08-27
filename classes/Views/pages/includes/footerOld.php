<base base="<?php echo INCLUDE_PATH  ?>">
<id id="<?php echo @$_SESSION['id'] ?>">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
 <script src = "<?php echo INCLUDE_PATH ?>js/jquery-3.7.1.js"></script>
<script src="<?php echo INCLUDE_PATH ?>tinymce/tinymce.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>



<script>
    $(()=>{
        var base = $('[name=base]').attr('href');
        var mensagem = $('[name=message]');
        var idOld = $('[name=oldID]').val();
        var estudante_id = $('[name=estudante_id]').val();
        var content = $('.content-chat');
        $('form').submit(function(e){
            e.preventDefault();
            $.ajax({
                method:'POST',
                url:'../ajax/oldChat.php',
                data:{message:mensagem.val(),id_Old:idOld,id_estudante:estudante_id}
            }).done(function(data){
                mensagem.val("");
                content.append(data);
            })
        })

        function consultarMensagem(){
            $.ajax({
                method:'post',
                url:'../ajax/chatOld.php',
                data:{message:mensagem.val(),id_Old:idOld,id_estudante:estudante_id}
            }).done(function(data){
                content.append(data);
            })
        }
        // setInterval(consultarMensagem,1000)
    })
</script>
</body>
</html>