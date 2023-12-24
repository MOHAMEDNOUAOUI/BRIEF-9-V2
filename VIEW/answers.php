<?php
require ('../MODULES/ANSWERS.php');
$answer_controler = new ANSWERS();




if(isset($_POST['dataKey'])){
    $answers = $answer_controler->fetch_reponse_for_question($_POST['dataKey']);
    foreach($answers as $answer) {
        ?>
        <div class="answser1 col-5 bg-danger text-center py-3">
            <input type="radio" name="answer" class="answer-radio" value="<?php echo $answer->getAnswerId()?>">
                <?php echo $answer->getAnswerText()?>
            </div>
        <?php
    }
}