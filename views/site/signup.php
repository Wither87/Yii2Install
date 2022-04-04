<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h1>Регистрация</h1>

<?php $form = ActiveForm::begin(['class'=>'form-horisontal']) ?>
    <?= $form->field($model, 'login')->textInput(['autofocus'=>true]); ?>
    <?= $form->field($model, 'password')->passwordInput(); ?>

    <div class="form-group">
        <div class="offset-lg-1 col-lg-11">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>