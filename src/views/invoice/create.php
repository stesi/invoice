<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model stesi\invoice\models\Invoice */

$this->title = 'Create Invoice';
$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
