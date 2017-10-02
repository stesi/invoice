<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model stesi\invoice\models\PaymentTerms */

$this->title = 'Update Payment Terms: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Payment Terms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="payment-terms-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
