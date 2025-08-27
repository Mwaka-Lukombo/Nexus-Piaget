
// const sidebar = document.querySelector('.sidebar'),
//       toggle = document.querySelector('.toggle_button'),
//       body = document.querySelector('body'),
//       btnSwicth = document.querySelector('.buttonSwitch'),
//       open = document.querySelector('.open'),
//       selectedIcon = document.querySelector('.dark-content');



// toggle.addEventListener('click',function(e){
//     e.preventDefault();
//     sidebar.classList.toggle('open')
// })


// selectedIcon.addEventListener('click',function(e){
//     e.preventDefault();
//    body.classList.toggle('dark');
// })



// alter("Aqui vai a nossa apicacao")


const sidebar = document.querySelector('.sidebar'),
      toggle = document.querySelector('.toggle_button'),
      body = document.querySelector('body'),
      btnSwicth = document.querySelector('.buttonSwitch'),
      open = document.querySelector('.open'),
      selectedIcon = document.querySelector('.dark-content');
      let btnOpen = document.querySelector('.fixed_sidebar');



function setCookie(name, value, days) {
    const expires = new Date(Date.now() + days * 864e5).toUTCString();
    document.cookie = `${name}=${encodeURIComponent(value)}; expires=${expires}; path=/`;
}

function getCookie(name) {
    return document.cookie.split('; ').reduce((r, v) => {
        const parts = v.split('=');
        return parts[0] === name ? decodeURIComponent(parts[1]) : r;
    }, '');
}

function deleteCookie(name) {
    setCookie(name, '', -1);
}


toggle.addEventListener('click', function(e) {
    e.preventDefault();
    sidebar.classList.toggle('open');
});


selectedIcon.addEventListener('click', function(e) {
    e.preventDefault();
    body.classList.toggle('dark');

    if (body.classList.contains('dark')) {
        setCookie('modo_escuro', 'ativado', 7); 
    } else {
        deleteCookie('modo_escuro');
    }
});

// Carregar o modo escuro automaticamente se o cookie existir
window.addEventListener('DOMContentLoaded', () => {
    if (getCookie('modo_escuro') === 'ativado') {
        body.classList.add('dark');
    }
});
