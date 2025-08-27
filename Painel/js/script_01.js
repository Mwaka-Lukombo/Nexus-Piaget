

gsap.registerPlugin(ScrollTrigger);


 gsap.fromTo('.perfil .avatar img',{
    opacity:0,
    rotation:460,
    y:100
 },{
    opacity:1,
    rotation:0,
    y:0,
    duration:0.5,
 })



 gsap.utils.toArray('.line').forEach(line=>{
    gsap.fromTo('.line',{
        opacity:0,
        width:'0%'
     },{
        opacity:1,
        width:'100%',
        duration:1,
        delay:.5
     })
 })

 gsap.fromTo('input[type=submit]',{
    opacity:0,
 },{
    opacity:1,
    duration:1,
    delay:0.5
 })




    gsap.fromTo('.box_single',{
        opacity:0,
        scale:0.1
    },{
        opacity:1,
        scale:1,
        duration:1,
        delay:0.5,
        stagger:{
            amount:1
        },
        scrollTrigger:'.box_single'
    })

    gsap.fromTo('.delete, .editar',{
       opacity:0,
       scale:0.1
    },{
        opacity:1,
        scale:1,
        duration:1,
        delay:1,
        stagger:{
            amount:1
        }
    })





$('.criar_turma').click(function(e){
   let box = $('.create-stream');
   let span = $('.create-stream a span');

   if(box.is(':hidden') == false){
       span.html('Esconder');
        box.slideUp();
   }else{
       box.slideDown();
   }

    e.preventDefault();
})