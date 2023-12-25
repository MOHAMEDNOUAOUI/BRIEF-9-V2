    function load () {
        location.reload();
    }
    
    
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
                fetch_questions();
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



    // function fetch_question() {
    //     document.querySelector('.main').innerHTML = '';
        

    //     let timestamp = document.createElement('div');
    //     timestamp.classList.add('timer');
    //     container.appendChild(timestamp);

    // let count = 5;
    // timestamp.textContent = count;

    //     const timer = setInterval(function () {
    //         count--;
            
    //         if (count >= 0) {
    //             timestamp.textContent = count;
    //         }
    //         if(count===0) {
    //             clearInterval(timer);
    //             let xml = new XMLHttpRequest();

    //             xml.onload = function () {
    //                 if (this.readyState == 4 && this.status == 200) {
    //                     // container.innerHTML = xml.responseText;
    //                 }
    //             }
    //             xml.open('GET', './fetch.php');
    //             xhr.getResponseHeader("Content-type", "application/json");
    //             xml.send();
    //         }
    //     },);

    // }



    var questionOBJECT = [];

    var questioncont = document.querySelector('.question');

    function fetch_questions() {
        
        let xml = new XMLHttpRequest();

                xml.onload = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        let i = 0;
                        questionOBEJECT = JSON.parse(xml.responseText);
                        console.log(questionOBEJECT);
                        console.log(questionOBEJECT[i].question_id);
                        container.innerHTML = `<div class="cont d-flex flex-column w-100 h-100">
                        <div class="d-flex justify-content-between w-100 align-items-center" style="padding:0 8rem">
                        <div class="score">Score: ${score} </div>
                            <div class="page"> ${i+1} / ${questionOBEJECT.length}</div>
                        </div>
                        <div class="ALL d-flex flex-column w-100">
                            <div class="containerquestions d-flex flex-column justify-content-center align-items-center w-100 gap-5">
                                <div class="question w-75 text-center bg-primary text-white py-4" data-key="${questionOBEJECT[i].question_id}">
                                ${questionOBEJECT[i].question_text}
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
                                <button class="NEXT" onclick="answerid()">NEXT</button>
                            </div>
                        </div>
                    </div>
                    `;
                    }

                    sendDataKey();
                }
                xml.open('GET', './fetch.php');
                xml.getResponseHeader("Content-type", "application/json");
                xml.send();
    };

     var index = 1;
    function nextquestion () {
        if(index< 10){
            container.innerHTML = `<div class="cont d-flex flex-column w-100 h-100">
        <div class="d-flex justify-content-between w-100 align-items-center" style="padding:0 8rem">
            <div class="score">Score: ${score} </div>
            <div class="page"> ${index+1} / ${questionOBEJECT.length}</div>
        </div>
        <div class="ALL d-flex flex-column w-100">
            <div class="containerquestions d-flex flex-column justify-content-center align-items-center w-100 gap-5">
                <div class="question w-75 text-center bg-primary text-white py-4" data-key="${questionOBEJECT[index].question_id}">
                ${questionOBEJECT[index].question_text}
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
           
            <button class="NEXT" onclick="answerid()"> ${index ==9 ?"finish" :"NEXT"}</button>
            </div>
        </div>
    </div>`


    index++;
    sendDataKey();

        }
            else {
                let xml = new XMLHttpRequest();

                xml.onreadystatechange = function() {
                    if(this.status==200) {
                        container.innerHTML = this.responseText;
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

    var score = 0;
    function answerid() {
        var nextButton = document.getElementsByClassName('NEXT');
        var question = document.querySelector('.question');
        var idquestion = question.getAttribute('data-key');
        var answers = document.querySelectorAll('.answer-radio');
        var id = '';
        answers.forEach(ans => {
            if (ans.checked) {
                id = ans.value;
            }
        });
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









   



