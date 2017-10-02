<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model stesi\invoice\models\PaymentTerms */

$this->title = 'Create Payment Terms';
$this->params['breadcrumbs'][] = ['label' => 'Payment Terms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-terms-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
