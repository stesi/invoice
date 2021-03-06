<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model stesi\billing\models\Invoice */
/* @var $invoice_type_id integer */

$this->title = Yii::t('billing/invoice/titles', 'invoice_titles.create_invoice');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/breadcrumbs', 'invoice_create_breadcrumbs.Index'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-create">


    <?= $this->render('_form', [
        'model' => $model,
        'invoice_type_id'=>$invoice_type_id
    ]) ?>

</div>
