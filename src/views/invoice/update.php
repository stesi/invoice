<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model stesi\invoice\models\Invoice */

$this->title = Yii::t('invoice/invoice/titles', 'invoice_titles.update_invoice') . $model->id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('invoice/invoice/breadcrumbs', 'invoice_labels_breadcrumbs.update.invoice'), 'url' => ["index"]];
$this->params['breadcrumbs'][] = Yii::t('invoice/invoice/breadcrumbs', 'invoice_labels_breadcrumbs.update');
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];

?>
<div class="invoice-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
