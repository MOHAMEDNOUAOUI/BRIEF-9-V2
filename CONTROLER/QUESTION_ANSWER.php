<?php
require('./ANSWERS_CONTROLER.php');
require('./QUEST_CONTROLER.php');

if (isset($_POST['useranswer']) && isset($_POST['question'])) {
    $questionID = $_POST['question'];
    $answerid = $_POST['useranswer'];

    $helpers = array('GOOD JOB !!!', 'KEEP UP THE WORK', 'GO CHAMP', 'YOU GOT IT ALMOST');

    if ($answerid === '') {
        $htmlResponse = '<div class="bg-white text-center" style="width:100vw;font-size:3rem">NO REPONSE</div>';
        $score = $_SESSION['score'];
        $response = array('htmlResponse' => $htmlResponse, 'score' => $score);


        $_SESSION['WRONGQUESTIONSID'][$questionID] = '';       


        echo json_encode($response);
    } else {
        $questionsclass = $QUESTION_CONTROLLER->getQuestionCLASS();
        $questionsclass->set_QestionID($questionID);
        $questionsclass->set_question_correction_by_question_id();
        $questioncorrect = $questionsclass->getCorrect_Answer(); // question ID
        $questionsclass->getQuestionById();

        // Debugging: Print the values to ensure they contain expected IDs

        $answerclass = $answer_controler->getAnswerCLASS(); // ANSWER CLASS
        $answerclass->setQuestionID($questionID); // SET QUESTION ID
        $answerclass->setAnswerId($answerid); // SET ANSWER ID
        // $answerclass->set_response_for_question();
        // $reponsetext = $answerclass->getAnswerText(); // reponse par id

        $correctanswer = $answerclass->getCorrectAnswer($questioncorrect); // CORRECT REPONSE
        $answerclass->setAnswerById();

        if ($answerid == $questioncorrect) {
            $htmlResponse =
            
            '<div id="correct" class="d-flex flex-column text-center justify-content-center align-items-center">
            <h1>CORRECT SIRR <span>+20</span></h1>
            <h1>' . $helpers[array_rand($helpers)] . '</h1>
            </div>';

            $_SESSION['score'] += 20;
            $score = $_SESSION['score'];
            $response = array('htmlResponse' => $htmlResponse, 'score' => $score);
            echo json_encode($response);
        } else {
            $htmlResponse = '<div class="text-center d-flex flex-column gap-3" style="width:100vw;background:white">
            <h1>INCORRECT</h1>
            <h2>' . "YOUR ANSWER WAS : " . $answerclass->getAnswerText() . '</h2>
            <h2>' . "CORRECT ANSWER : " . $correctanswer . '</h2>
            </div>';
            $score = $_SESSION['score'];
            $response = array('htmlResponse' => $htmlResponse, 'score' => $score);
            $_SESSION['WRONGQUESTIONSID'][$questionID] = $answerid;
            echo json_encode($response);
        }
    }
}
?>

