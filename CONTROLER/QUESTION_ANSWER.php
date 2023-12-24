<?php
require('./ANSWERS_CONTROLER.php');
require('./QUESTIONS_CONTROLER.php');

if (isset($_POST['useranswer']) && isset($_POST['question'])) {
    $questionID = $_POST['question'];
    $answerid = $_POST['useranswer'];

    $helpers = array('GOOD JOB !!!', 'KEEP UP THE WORK', 'GO CHAMP', 'YOU GOT IT ALMOST');

    if ($answerid === '') {
        $htmlResponse = '<div>NO REPONSE</div>';
        $score = $_SESSION['score'];
        $response = array('htmlResponse' => $htmlResponse, 'score' => $score);


        $_SESSION['WRONGQUESTIONSID'][$questionID] = '';       


        echo json_encode($response);
    } else {
        $questionsclass = $QUESTION_CONTROLLER->getQuestionCLASS();
        $questionsclass->set_QestionID($questionID);
        $questionsclass->set_question_correction_by_question_id();
        $questioncorrect = $questionsclass->getCorrect_Answer(); // question ID

        // Debugging: Print the values to ensure they contain expected IDs

        $answerclass = $answer_controler->getAnswerCLASS();
        $answerclass->setQuestionID($questionID);
        $answerclass->set_response_for_question();
        $reponsetext = $answerclass->getAnswerText();

        if ($answerid == $questioncorrect) {
            $htmlResponse =
            
            '<div class="d-flex flex-column">
            <h1>CORRECT SIRR</h1>
            <h1>' . $helpers[array_rand($helpers)] . '</h1>
            </div>';

            $_SESSION['score'] += 20;
            $score = $_SESSION['score'];
            $response = array('htmlResponse' => $htmlResponse, 'score' => $score);
            echo json_encode($response);
        } else {
            $htmlResponse = '<h1>INCORRECT</h1><br>
            <h2>' . "Question ID: " . $questionID . '<br></h2>
            <h2>' . "CORRECT: " . $questioncorrect . '<br></h2>
            <h2>' . "USER_ANSWER: " . $answerid . '<br></h2>
            <h2>' . "Response: " . $reponsetext . '<br></h2>';
            $score = $_SESSION['score'];
            $response = array('htmlResponse' => $htmlResponse, 'score' => $score);
            $_SESSION['WRONGQUESTIONSID'][$questionID] = $answerid;
            echo json_encode($response);
        }
    }
}
?>
