<?php
require ('../MODULES/ANSWERS.php');
$answer_controler = new ANSWERS();




if(isset($_POST['dataKey'])){
    $answers = $answer_controler->fetch_reponse_for_question($_POST['dataKey']);
    foreach($answers as $answer) {
        ?>
        <div name="answer" onclick="setdata(this,<?php echo $answer->getAnswerId()?>)"  class="btn answer-radio btn-black d-flex justify-content-center align-items-center answser1 col-5 py-4">

                <?php echo $answer->getAnswerText()?>
            </div>
        <?php
    }
}