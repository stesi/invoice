<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model stesi\invoice\models\Invoice */

$this->title = $model->id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('invoice/invoice/labels', 'invoice_labels_breadcrumbs.view.invoice'), 'url' => ["index"]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('invoice/invoice/labels', 'invoice_labels_breadcrumbs.view'), 'url' => ["view", "id" => $model->id]];

$this->params['buttons'] = [
    ['label' => 'Update', 'url' => ['update', "id" => $model->id], 'linkOptions' => ["class" => "showModalButton btn btn-sm btn-primary", "title" => 'Update']],
    ['label' => 'Delete', 'url' => ['delete', "id" => $model->id], 'linkOptions' => ["class" => "btn btn-sm btn btn-danger", "title" => 'Delete',
    'data' => [
        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
        'method' => 'post',
    ]]]
];

?>
<div class="invoice-view col-md-12">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'organization_from_id',
            'organization_to_id',
            'status',
            'invoice_type',
            'preamble',
            'number',
            'year',
            'invoice_date',
            'competence_date',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'payment_terms_id',
            'note:ntext',
            'subtotal',
            'tax',
            'total',
        ],
    ]) ?>

</div>
