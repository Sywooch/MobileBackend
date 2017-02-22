<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Смена пароля';
?>

<div class="col-lg-4"></div>
<div class="col-lg-4">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'currentPassword')->passwordInput() ?>

    <?= $form->field($user, 'newPassword')->passwordInput() ?>

    <?= $form->field($user, 'newPasswordConfirm')->passwordInput() ?>

    <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end(); ?>
</div>
<div class="col-lg-4"></div>