    function load () {
        location.reload();
    }

    function shadow() {
        var text = document.getElementById('text');
    var shadow ='';
    for(var i = 0;i<20;i++){
        shadow +=(shadow? ',':'') + i*1+'px ' +i*1+'px 0 #C0C0C0';
    }
    text.style.textShadow = shadow;
    }
    shadow();

    var progresscontainer  = document.querySelector('#topbar');
    var scorediv = document.querySelector('#score');
    var pagediv = document.querySelector('#page');
    
    
    
    window.addEventListener('beforeunload', () => {
        let XHR = new XMLHttpRequest();

        XHR.onreadystatechange = function () {
            if (this.status === 200) {
                console.log("Session deleted successfully");
            }
        }

        XHR.open('GET', '../CONTROLER/SESSION_DESTROY.php');
        XHR.send();
    });

    // first time site runs
    var container = document.querySelector('.main');
    document.querySelector('#ENTER').addEventListener('click', function () {

        let inputvalue = document.querySelector('#PLAYERNAME').value;
        let xml = new XMLHttpRequest();

        xml.onreadystatechange = function () {
            if (xml.readyState == 4 && xml.status == 200) {
                console.log(inputvalue);
                window.onbeforeunload = (event => {
                    event.preventDefault();
                })
                progresscontainer.classList.remove('d-none');
                fetch_question_first();
            }   
        };

        if (inputvalue.length >= 4) {
            xml.open('POST', '../CONTROLER/SCORE_CONTROLER.php');
            xml.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xml.send('PLAYERNAME=' + encodeURIComponent(inputvalue));
        }
        else {
            alert('Please Choose A Name with 4 letters at least');
        }

    });





    var questionOBJECT = [];

    var questioncont = document.querySelector('.question');

    function progressbar(index) {
        var progressFILL = document.querySelector('.progress-fill');
        var progressTEXT = document.querySelector('.progress-text');
        var percentage = (index * 10) + '%'; // Calculate the percentage
    
        progressFILL.style.width = percentage;
        progressTEXT.textContent = percentage;
        var parse = parseInt(percentage);
        switch(parse) {
            case 10:
                progressFILL.style.background = "RED";
                break;
            case 30:
                progressFILL.style.background = "ORANGE";
                pagediv.style.background = "ORANGE";
                break;
            case 50 :
                progressFILL.style.background = "BLUE";
                pagediv.style.background = "BLUE";
                break;
            case 70:
                progressFILL.style.background = "SpringGREEN";
                pagediv.style.background = "SpringGREEN";
                break;
            case 90:
                progressFILL.style.background = "GREEN";
                pagediv.style.background = "GREEN";
                break;
        }
        if(parse == 50) {
            document.querySelector('.progress-text').classList.remove('text-black');
            document.querySelector('.progress-text').classList.add('text-white');
            progressFILL.style.color = "red";
        }
    }


    //// FETCH FIRST WITH TIMER OF 5s
    function fetch_question_first() {
        document.querySelector('.main').innerHTML = '';
        

        let timestamp = document.createElement('div');  
        timestamp.classList.add('timer');
        container.appendChild(timestamp);

    let count = 5;
    timestamp.textContent = count;

        const timer = setInterval(function () {
            count--;
            
            if (count >= 0) {
                timestamp.textContent = count;
            }
            if(count===0) {
                clearInterval(timer);
                
                fetch_questions();

            }
        },1000);

    }

    ////

    function timer () {
        var counterdiv = document.querySelector('.counter');
        let counter = 20;
        counterdiv.textContent = counter;

        var counterintervale = setInterval(function() {
            counterdiv.textContent = counter;
            // counter--;

            if(counter <0) {
                clearInterval(counterintervale);
                answerid();
            }
        },1000)
    }




    /// THE FETCH IT SELF OF QUESTIONS
    function fetch_questions() {

        let xml = new XMLHttpRequest();

                xml.onload = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        let i = 0;
                        questionOBJECT = JSON.parse(xml.responseText);
                        console.log(questionOBJECT);
                        console.log(questionOBJECT[i].question_id);
                        scorediv.textContent = "score : "+score;
                        pagediv.textContent =  `${i+1}/${questionOBJECT.length}`;
                        container.innerHTML = `

                        <div class="cont d-flex flex-column w-100 mt-2">
        <div class="ALL d-flex flex-column w-100 mt-5">
            <div class="containerquestions d-flex flex-column justify-content-center align-items-center w-100 gap-5">
                <div id="animatedDiv" class="question text-white text-center" data-key="${questionOBJECT[i].question_id}">
                ${questionOBJECT[i].question_text}
                    <!-- Index placeholder -->
                </div>
                <div class="reponses row w-100 gap-5 align-items-center justify-content-center">
                    <!-- Answers loop placeholder -->
                    <div class="answser1 col-5 bg-danger text-center py-4">
                        
                    </div>
                    <!-- End of answers loop placeholder -->
                </div>
            </div>
            <div id="next" class="next float-right">
           
            <button class="NEXT btn btn-light" onclick="answerid()">NEXT</button>
            </div>
        </div>
    </div>
    
    <div class="cout position-absolute" style="width:100px;height:100px">
                    <img  src="./IMGS/clock.png" class="imagecout w-100 h-100" alt="">
                    <div class="counter position-absolute"></div>
                  </div>
                    `;
                    timer ();
                    progressbar(i);
                    }

                    sendDataKey();
                }
                xml.open('GET', './fetch.php');
                xml.getResponseHeader("Content-type", "application/json");
                xml.send();
    };




     var index = 1;
    function nextquestion () {
        scorediv.textContent = "score : "+score;
        pagediv.textContent =  `${index+1}/${questionOBJECT.length}`;
        if(index< 10){
            container.innerHTML = `

                        <div class="cont d-flex flex-column w-100 mt-2">
        <div class="ALL d-flex flex-column w-100 mt-5">
            <div class="containerquestions d-flex flex-column justify-content-center align-items-center w-100 gap-5">
                <div class="question w-75 text-center bg-primary text-white py-4" data-key="${questionOBJECT[index].question_id}">
                ${questionOBJECT[index].question_text}
                    <!-- Index placeholder -->
                </div>
                <div class="reponses row w-100 gap-5 align-items-center justify-content-center">
                    <!-- Answers loop placeholder -->
                    <div class="answser1 col-5 bg-danger text-center py-3">
                        
                    </div>
                    <!-- End of answers loop placeholder -->
                </div>
            </div>
            <div class="next float-right">
           
            <button class="NEXT btn btn-light" onclick="answerid()"> ${index ==9 ?"finish" :"NEXT"}</button>
            </div>
        </div>
    </div>
    
    <div class="cout position-absolute" style="width:100px;height:100px">
                    <img  src="./IMGS/clock.png" class="imagecout w-100 h-100" alt="">
                    <div class="counter position-absolute"></div>
                  </div>
                    `;
    timer ();

    progressbar(index);
    index++;
    sendDataKey();
    
        }
            else {
                let xml = new XMLHttpRequest();

                xml.onreadystatechange = function() {
                    if(this.status==200) {
                        container.innerHTML = this.responseText;
                        pagediv.classList.add('d-none');
                        scorediv.classList.add('d-none');
                        progresscontainer.classList.add('d-none');
                    }
                }

                xml.open('GET' , './endpoints.php');
                xml.send();
        }
    }




    function sendDataKey() {
            var questionElement = document.querySelector('.question');
            var reponseElement = document.querySelector('.reponses');
        if (questionElement) {
            var dataKey = questionElement.getAttribute('data-key');
    
    
            var xhr = new XMLHttpRequest();
    
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        reponseElement.innerHTML = this.responseText;
                        console.log("SUCCESS");
                    }
                }
            };
    
        
            xhr.open('POST', 'answers.php'); 
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            xhr.send('dataKey=' + encodeURIComponent(dataKey));
            
        } else {
            console.error("Element with class '.question' not found.");
        }

    }

    var id = '';

    
    // Add event listener to each answer
    var answers = document.querySelectorAll('.answser1');
var N = document.querySelector('.next');


function setdata(element, idd) {
    var answers = document.querySelectorAll('.answser1');
    answers.forEach((btn) => {
        if (btn !== element && btn.classList.contains('clicked')) {
            btn.classList.remove('clicked');
        }
    });

    element.classList.toggle('clicked');

    id = idd;
    console.log(id);
    return id;
}
    

    var score = 0;
    function answerid() {
        var nextButton = document.getElementsByClassName('NEXT');
        var question = document.querySelector('.question');
        var idquestion = question.getAttribute('data-key');
        var answers = document.querySelectorAll('.answser1');
        
        console.log("answer = " +id);
        console.log("question =" + idquestion);

        let xhm = new XMLHttpRequest;
    
        xhm.onload = function () {
            if (this.readyState == 4 && this.status == 200) {
                
    
                // Retrieve the score value from the JSON response
                var responseObject = JSON.parse(this.responseText);
                var htmlResponse = responseObject.htmlResponse;
                container.innerHTML = htmlResponse;
                var returnedScore = responseObject.score;
                score = returnedScore;
    
                console.log(returnedScore);
    
                setTimeout(() => {
                    nextquestion();
                }, 5000);
            }
        };
        xhm.open('POST' , '../CONTROLER/QUESTION_ANSWER.php');
        xhm.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhm.send("useranswer=" + encodeURIComponent(id) + "&question=" + encodeURIComponent(idquestion));

        id = '';
    }
    



    function scoreboard () {
        let xml = new XMLHttpRequest();

        xml.onload = function () {
            if(this.readyState == 4&& this.status==200) {
                container.innerHTML = this.responseText;
            }
        }
        xml.open('GET' , './scoreboard.php');
        xml.send();
    }



    function correction () {
        let xml = new XMLHttpRequest();

        xml.onload = function () {
            if(this.readyState == 4&& this.status==200) {
                container.innerHTML = this.responseText;
            }
        }
        xml.open('GET' , './answers.php');
        xml.send();
    }









   



