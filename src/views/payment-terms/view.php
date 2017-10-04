<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model stesi\invoice\models\PaymentTerms */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/breadcrumbs', 'payment_terms_view_breadcrumbs.Index'), 'url' => ["index"]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/breadcrumbs', 'view_breadcrumbs.Id').$model->id, 'url' => ["view", "id" => $model->id]];

$this->params['buttons'] = [
    ['label' => 'Update', 'url' => ['update', "id" => $model->id], 'linkOptions' => ["class" => "showModalButton btn btn-sm btn-primary", "title" => 'Update']],
    ['label' => 'Delete', 'url' => ['delete', "id" => $model->id], 'linkOptions' => ["class" => "btn btn-sm btn btn-danger", "title" => 'Delete',
    'data' => [
        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
        'method' => 'post',
    ]]]
];

?>
<div class="payment-terms-view col-md-12">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>
