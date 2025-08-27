var players = document.querySelectorAll('.video-player');

for (let i = 0; i < players.length; i++) {
  players[i].addEventListener('mouseenter', (e) => {
  var menuPlayer = players[i].querySelector('.menu-player');
  var barraProgresso = players[i].querySelector('.barraProgresso');
  var initFinal = players[i].querySelector('.initFinal');
  var video = players[i].querySelector('video');
  var play = players[i].querySelector('.menu-player .play');
  var iconPlay = players[i].querySelector('.menu-player .play i');
  var screenFull = players[i].querySelector('.screen');
  var iconScreen = players[i].querySelector('.screen i');

    if (menuPlayer) {
      menuPlayer.style.display = 'block';
    } else {
      alert('Tools não encontrada neste player');
    }


    function formato(tempo){
      const min = Math.floor(tempo / 60).toString().padStart(2,'0');
      const seg = Math.floor(tempo % 60).toString().padStart(2,'0');

      return `${min}:${seg}`;
    }

    
     

      play.addEventListener('click',(e)=>{
        e.preventDefault()
        if(video.paused){
          video.play();
          menuPlayer.style.display = 'none'
          iconPlay.classList.remove('fa-play')
          iconPlay.classList.add('fa-pause');
  
        }else{
          video.pause();
          iconPlay.classList.remove('fa-pause');
          iconPlay.classList.add('fa-play');
        }      
      })



      video.addEventListener('loadedmetadata', () => {
      barraProgresso.max = video.duration;
    });

    video.addEventListener('timeupdate', () => {
      barraProgresso.value = video.currentTime;
         initFinal.textContent = `${formato(video.currentTime)}/${formato(video.duration)}`;
    });

    
      barraProgresso.addEventListener('input',(e)=>{
         video.currentTime = barraProgresso.value;
      })
  
      


       

      
    screenFull.addEventListener('click',(e)=>{
      e.preventDefault();
      if(screenFull.requestFullscreen){
        players[i].requestFullscreen();
        iconScreen.classList.remove('.fa-maximize');
        iconScreen.classList.add('.fa-minimize')
      }else if(screenFull.webkitRequestFullscreen){
        players[i].webkitRequestFullscreen()
      }else if(screenFull.msrequestFullscreen){
        players[i].msrequestFullscreen();
      }

    })

      

  });

  players[i].addEventListener('mouseleave',(e)=>{
    var menuPlayer = players[i].querySelector('.menu-player');
    if(menuPlayer){
      menuPlayer.style.display = 'none'
    }
  })

  players[i].addEventListener('mousemove',(e)=>{
     var menuPlayer = players[i].querySelector('.menu-player');
    if(menuPlayer){
      menuPlayer.style.display = 'block'
    }
  })
}
