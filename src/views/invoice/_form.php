<?php

use yii\helpers\Html;
use kartik\form\ActiveField;
use kartik\form\ActiveForm;
use yii\bootstrap\Alert;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model stesi\invoice\models\Invoice */
/* @var $form yii\widgets\ActiveForm */
?>
<?php Pjax::begin();?>
<div class="invoice-form">
    <?= $this->render("@app/views/layouts/flash-error"); ?>

    <?php $form = ActiveForm::begin([
    'options' => ['data-pjax' => true ],
    'id' => 'invoice-form',
    'fieldConfig'=>[
    'hintType' => ActiveField::HINT_SPECIAL,
    'hintSettings' => ['container' => '#invoice-form']
    ],
    //'enableAjaxValidation' => true
    ]); ?>

    <?= $form->field($model, 'organization_from_id',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->textInput() ?>

    <?= $form->field($model, 'organization_to_id',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->textInput() ?>

    <?= $form->field($model, 'status',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->dropDownList([ 'DRAFT' => 'DRAFT', 'CLOSED' => 'CLOSED', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'invoice_type',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->dropDownList([ 'INVOICE' => 'INVOICE', 'PREINVOICE' => 'PREINVOICE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'preamble',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->textInput() ?>

    <?= $form->field($model, 'year',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invoice_date',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->textInput() ?>

    <?= $form->field($model, 'competence_date',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->textInput() ?>

    <?= $form->field($model, 'created_at',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->textInput() ?>

    <?= $form->field($model, 'updated_at',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->textInput() ?>

    <?= $form->field($model, 'created_by',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->textInput() ?>

    <?= $form->field($model, 'updated_by',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->textInput() ?>

    <?= $form->field($model, 'payment_terms_id',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->textInput() ?>

    <?= $form->field($model, 'note',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'subtotal',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->textInput() ?>

    <?= $form->field($model, 'tax',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->textInput() ?>

    <?= $form->field($model, 'total',['hintType' => ActiveField::HINT_SPECIAL,'hintSettings' => ['container' => '#invoice-form']])->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php Pjax::end();?>
