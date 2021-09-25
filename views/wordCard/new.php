<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\game\WordCard;

/** @var WordCard $wordCard */

?>

<?php
$form = ActiveForm::begin([
    'id' => 'wordCard',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<br>
<?= $form->field($wordCard, 'word')->input('string') ?>

<?= Html::submitButton('New word', ['class' => 'btn btn-light']) ?>
<br>
<br>
<?php ActiveForm::end() ?>
