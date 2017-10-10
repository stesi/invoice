<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model stesi\billing\models\grid\InvoiceGrid */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-search col-md-12">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'organization_from_id') ?>

    <?= $form->field($model, 'organization_to_id') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'invoice_type') ?>

    <?php // echo $form->field($model, 'preamble') ?>

    <?php // echo $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'invoice_date') ?>

    <?php // echo $form->field($model, 'competence_date') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'payment_terms_id') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'subtotal') ?>

    <?php // echo $form->field($model, 'tax') ?>

    <?php // echo $form->field($model, 'total') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app/buttons', 'search_button_search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app/buttons', 'search_button_reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
