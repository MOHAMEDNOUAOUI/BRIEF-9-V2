const toggle = document.getElementById('toggle');
const bg  = document.querySelector('.BIG'); 
const textbg = document.querySelector('#text');
const buttons = document.getElementsByClassName('pt');
const Q = document.querySelector('#animatedDiv');
const answerbutton = document.querySelectorAll('.answser1');

toggle.onclick = function () {
    var correctionbars = document.querySelectorAll('.dom');
    toggle.classList.toggle('active');
    bg.classList.toggle('active');
    textbg.classList.toggle('active');
    for(var i=0;i<correctionbars.length;i++) {
        if(correctionbars[i].classList.contains('domer1')){
            correctionbars[i].classList.remove('domer1');
            correctionbars[i].classList.add('domer2');
        }
        else {
            correctionbars[i].classList.remove('domer2');
            correctionbars[i].classList.add('domer1');
        }
    }
}





