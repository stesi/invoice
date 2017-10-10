<?php

$this->title = 'Invoices';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/breadcrumbs', 'invoice_index_breadcrumbs.Index'), 'url' => ['index']];

$this->params['buttons'] = [
    ['label' => Yii::t('billing/billing/buttons', 'invoice_buttons.index.create_invoice'), 'url' => ['create'], 'linkOptions' => ["class" => "showModalButton btn btn-sm btn-default", "title" => Yii::t('billing/billing/titles', 'invoice_titles.create_invoice')],],
];

?>
<div class="invoice-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php $columns = [
        //  ['class' => 'kartik\grid\SerialColumn'],
        'id',
        [
            'attribute' => 'organization_from_name',
            'label' => Yii::t('billing/billing/labels', 'invoice_index.organization_from_name')
        ],
        [
            'attribute' => 'organization_to_name',
            'label' => Yii::t('billing/billing/labels', 'invoice_index.organization_to_name')
        ],
        'status',
        'invoice_type',
        [
            'attribute' => 'payment_terms_name',
            'label' => Yii::t('billing/billing/labels', 'invoice_index.payment_terms_name')
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

    require(Yii::getAlias('@app/views/layouts/grid_layout.php'));
    ?>
</div>
