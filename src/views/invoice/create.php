<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model stesi\invoice\models\Invoice */

$this->title = Yii::t('invoice/invoice/titles', 'invoice_titles.create_invoice');
$this->params['breadcrumbs'][] = ['label' => Yii::t('invoice/invoice/breadcrumbs', 'invoice_labels_breadcrumbs.create.invoice'), 'url' => ["index"]];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
