<?php

$this->title  =  'Invoices';

$this->params['buttons'] = [
    ['label' => 'Create invoice', 'url' => ['/invoice/create'], 'linkOptions' => ["class" => "showModalButton btn btn-sm btn-default", "title" => Yii::t('app', 'Create invoice')],],
    ];

?>
<div class="invoice-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


        <?php $columns = [
          //  ['class' => 'kartik\grid\SerialColumn'],
            'id',
        ['attribute'=>'organizationFrom.name',
            'label'=>Yii::t('invoice/invoice/labels', 'invoice_index.organization_from_name')],
        ['attribute'=>'organizationTo.name',
            'label'=>Yii::t('invoice/invoice/labels', 'invoice_index.organization_to_name')],
            'status',
            'invoice_type',
        ['attribute'=>'paymentTerms.name',
            'label'=>Yii::t('invoice/invoice/labels', 'invoice_index.payment_terms_name')],

             'preamble',
             'number',
             'year',
            // 'invoice_date',
            // 'competence_date',
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
