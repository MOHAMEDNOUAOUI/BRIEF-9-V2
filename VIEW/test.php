<div class="cont d-flex flex-column w-100">
        <div class="ALL d-flex flex-column w-100 mt-5">
            <div class="containerquestions d-flex flex-column justify-content-center align-items-center w-100 gap-5">
                <div class="question w-75 text-center bg-primary text-white py-4" data-key="${questionOBJECT[i].question_id}">
                ${questionOBJECT[i].question_text}
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
    
    <div class="cout position-relative" style="width:100px;height:100px">
                    <img src="./IMGS/clock.png" class="w-100 h-100" alt="">
                    <div class="counter position-absolute"></div>
                  </div>