<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\field\Wordfield;

/** @var Wordfield $wordfield */

?>

<?php
$form = ActiveForm::begin([
    'id' => 'wordfield',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<br>
<?= $form->field($wordfield, 'word')->input('string') ?>

<?= Html::submitButton('New word', ['class' => 'btn btn-light']) ?>
<br>
<br>
<?php ActiveForm::end() ?>
