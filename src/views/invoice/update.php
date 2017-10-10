<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model stesi\billing\models\Invoice */

$this->title = Yii::t('billing/invoice/titles', 'invoice_titles.update_invoice') . $model->id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app/breadcrumbs', 'invoice_update_breadcrumbs.Index'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/breadcrumbs', 'update_breadcrumbs.Id').$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/breadcrumbs', 'update_breadcrumbs.Update');

?>
<div class="invoice-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
