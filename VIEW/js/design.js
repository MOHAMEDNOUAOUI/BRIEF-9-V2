const toggle = document.getElementById('toggle');
const bg  = document.querySelector('.BIG'); 
const textbg = document.querySelector('#text');
const buttons = document.getElementsByClassName('pt');
const Q = document.querySelector('#animatedDiv');
const answerbutton = document.querySelectorAll('.answser1');
toggle.onclick = function () {
    toggle.classList.toggle('active');
    bg.classList.toggle('active');
    textbg.classList.toggle('active');
    for(var i=0;i<buttons.length;i++) {
        buttons[i].classList.toggle('active');
    }
}




