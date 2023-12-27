<?php
require_once '../CONTROLER/ANSWERS_CONTROLER.php';
require_once '../CONTROLER/QUEST_controler.php';
$questionCLASS = new QUESTION();
$answerCLASS = new ANSWERS();
?>
<div class="resultbar d-flex flex-column gap-2 px-3 py-3" style="width:80vw;height:70vh;overflow-y:scroll">
<?php
    if(isset($_SESSION['WRONGQUESTIONSID'])){
        foreach($_SESSION['WRONGQUESTIONSID'] as $key=>$value) {
            if($value === '') {
                $questionCLASS->set_QestionID($key);
                $questionCLASS->getQuestionById();
                $correct = $answerCLASS->getCorrectAnswer($questionCLASS->getCorrect_Answer());
                ?>
                    <div class="dom domer1 d-flex flex-column">
                        <h2><?php echo $questionCLASS->get_QuestionTEXT()?></h2>
                        <h4>YOU DIDNT CHOOSE AN ANSWER</h4>
                        <p>The Correct answer IS ==>> <?php echo $correct?></p>
                        <p>Explication : <?php echo $questionCLASS->getQuestionDescription()?></p>
                    </div>
                <?php
               }
               else {
                $questionCLASS->set_QestionID($key);
                $questionCLASS->getQuestionById();
                $answerCLASS->setAnswerId($value);
                $answerCLASS->setAnswerById();
                $correct = $answerCLASS->getCorrectAnswer($questionCLASS->getCorrect_Answer());
                ?>
                <div class="dom domer1 d-flex flex-column">
                        <h2><?php echo $questionCLASS->get_QuestionTEXT()?></h2>
                        <h4>Your Answer WAS ==>> <?php echo $answerCLASS->getAnswerText()?></h4>
                        <p>The Correct answer IS ==>> <?php echo $correct?></p>
                        <p>Explication : <?php echo $questionCLASS->getQuestionDescription()?></p>
                    </div>
                <?php
               }
              
        }
    }
    else {
        echo "YOU GOT IT ALL RIGHT";
    }
    ?>
    </div>
     <div class="d-flex gap-3 mt-2">
        <div type="submit" onclick="load()" style="width:8rem" class="pt btn enter btn-light">START</div>
        <div type="submit" onclick="scoreboard ()" style="width:8.5rem" class="pt btn scoreboard btn-light">SCOREBOARD</div>
        <div type="submit" onclick="endpoint()" style="width:8rem" class="pt btn enter btn-light">RESULT</div>
        </div>
    <!-- <button>RESULT</button>
    <button>RECORDS</button> -->
    