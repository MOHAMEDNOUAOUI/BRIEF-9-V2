<?php
require '../MODULES/SCORE.php';
$scoreclass = new SCORE();
$scoreclass->setUserId(session_id());
$scores = $scoreclass->get_all_user_scores();
?>
<div class="d-flex flex-column w-100 align-items-center justify-content-center">
<table class="table w-50">
<thead>
    <tr>
        <th scope="col">USERNAME</th>
        <th scope="col">SCORE</th>
    </tr>
</thead>
<tbody>
<?php

foreach($scores as $score) {
    ?>
    <tr>
        <th scope="col"><?php echo $score->getUserName()?></th>
        <th><?php echo $score->getUserScore()." POINT"?></th>
    </tr>
    <?php
 }
?>
</tbody>
</table>
<div class="d-flex flex-column">
<img src="./IMGS/PLAY.png" class="PLAY" style="width:10rem" onclick="load ()" type="submit" alt="">
<?php
if(isset($_SESSION['WRONGQUESTIONSID'])) {
    ?>
     <img src="./IMGS/CORRECTION.png" class="correction" onclick="correction()" style="width:10rem" alt="">
    <?php
}
?>
</div>
</div>

<?php

