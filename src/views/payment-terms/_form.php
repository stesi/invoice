<?php

use yii\helpers\Html;
use kartik\form\ActiveField;
use kartik\form\ActiveForm;
use yii\bootstrap\Alert;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model stesi\billing\models\PaymentTerms */
/* @var $form yii\widgets\ActiveForm */
?>
<?php Pjax::begin();?>
<div class="payment-terms-form">
    <?= $this->render("@app/views/layouts/flash-error"); ?>

    <?php $form = ActiveForm::begin([
    'options' => ['data-pjax' => true ],
    'id' => 'payment-terms-form',
    'fieldConfig'=>[
    'hintType' => ActiveField::HINT_SPECIAL,
    'hintSettings' => ['container' => '#payment-terms-form']
    ],
    //'enableAjaxValidation' => true
    ]); ?>

    <?= $form->field($model, 'name',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#payment-terms-form']])->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php Pjax::end();?>
