<?php
require_once '../CONTROLER/ANSWERS_CONTROLER.php';
require_once '../CONTROLER/QUEST_controler.php';
$questionCLASS = new QUESTION();
$answerCLASS = new ANSWERS();


    if(isset($_SESSION['WRONGQUESTIONSID'])){
        foreach($_SESSION['WRONGQUESTIONSID'] as $key=>$value) {
            if($value === '') {
                $questionCLASS->set_QestionID($key);
                $questionCLASS->getQuestionById();
                echo "<br><br>QUESTION : ".$questionCLASS->get_QuestionTEXT() . "<br>YOU DIDNT CHOOSE AN ANSWER<br>";
                $correct = $answerCLASS->getCorrectAnswer($questionCLASS->getCorrect_Answer());
                echo "The Correct answer IS ==>>" .$correct;
               }
               else {
                $questionCLASS->set_QestionID($key);
                $questionCLASS->getQuestionById();
                $answerCLASS->setAnswerId($value);
                $answerCLASS->setAnswerById();
                echo "<br><br>QUESTION : ".$questionCLASS->get_QuestionTEXT() . "<br>Your Answer WAS ==>> " .$answerCLASS->getAnswerText()."<br>";
                $correct = $answerCLASS->getCorrectAnswer($questionCLASS->getCorrect_Answer());
                echo "The Correct answer IS ==>>" .$correct;
               }
              
        }
    }
    
    ?>
    <!-- <button>RESULT</button>
    <button>RECORDS</button> -->
    