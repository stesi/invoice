<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model stesi\invoice\models\PaymentTerms */

$this->title = 'Update Payment Terms: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/breadcrumbs', 'payment_terms_update_breadcrumbs.Index'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/breadcrumbs', 'update_breadcrumbs.Id').$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/breadcrumbs', 'update_breadcrumbs.Update');
?>
<div class="payment-terms-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
