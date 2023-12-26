<?php
require ('../MODULES/ANSWERS.php');
$answer_controler = new ANSWERS();




if(isset($_POST['dataKey'])){
    $answers = $answer_controler->fetch_reponse_for_question($_POST['dataKey']);
    foreach($answers as $answer) {
        ?>
        <div name="answer" onclick="setdata (<?php echo $answer->getAnswerId()?>)"  class="btn answer-radio btn-black answser1 col-5 bg-danger  py-3">

                <?php echo $answer->getAnswerText()?>
            </div>
        <?php
    }
}