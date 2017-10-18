<?php
/* @var $invoiceTypeId integer */

$this->title = 'Invoices';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/breadcrumbs', 'invoice_index_breadcrumbs.Index'), 'url' => ['index']];


if($invoiceTypeId!=='100') {
    $this->params['buttons'] = [
        ['label' => Yii::t('billing/invoice/buttons', 'invoice_buttons.index.create_invoice'), 'url' => ['create'], 'linkOptions' => ["class" => "showModalButton btn btn-sm btn-default", "title" => Yii::t('billing/invoice/titles', 'invoice_titles.create_invoice')],],
    ];
}

?>
<div class="invoice-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php $columns = [
        //  ['class' => 'kartik\grid\SerialColumn'],
        'id',
        [
            'attribute' => 'organization_from_name',
            'label' => Yii::t('billing/invoice/labels', 'invoice_index.organization_from_name')
        ],
        [
            'attribute' => 'organization_to_name',
            'label' => Yii::t('billing/invoice/labels', 'invoice_index.organization_to_name')
        ],
        'status',
        'invoice_type',
        [
            'attribute' => 'payment_terms',
            'label' => Yii::t('billing/invoice/labels', 'invoice_index.payment_terms')
        ],
        'preamble',
        'number',
        'year',
        'invoice_date',
        'competence_date',
        // 'created_at',
        // 'updated_at',
        // 'created_by',
        // 'updated_by',
        'subtotal',
        'tax',
        'total',
        ['class' => 'kartik\grid\ActionColumn'],
    ];

    require(Yii::getAlias('@stesi/backend/views/layouts/grid_layout.php'));
    ?>
</div>
