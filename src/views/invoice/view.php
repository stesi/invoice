<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model stesi\invoice\models\Invoice */

$this->title = $model->id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app/breadcrumbs', 'invoice_view_breadcrumbs.Index'), 'url' => ["index"]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/breadcrumbs', 'view_breadcrumbs.Id').$model->id, 'url' => ["view", "id" => $model->id]];
$this->params['buttons'] = [
    ['label' => Yii::t('invoice/invoice/buttons', 'invoice_buttons.view.update_invoice'), 'url' => ['update', "id" => $model->id], 'linkOptions' => ["class" => "showModalButton btn btn-sm btn-primary", "title" => Yii::t('invoice/invoice/titles', 'invoice_titles.update_invoice')]],
    ['label' => Yii::t('invoice/invoice/buttons', 'invoice_buttons.view.delete_invoice'), 'url' => ['delete', "id" => $model->id], 'linkOptions' => ["class" => "btn btn-sm btn btn-danger", "title" => Yii::t('invoice/invoice/titles', 'invoice_titles.delete_invoice'),
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
