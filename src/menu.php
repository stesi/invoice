<?php


$menu_invoice_invoice=[
    'label' => '<i class="fa fa-fw fa-eur"></i> ' . Yii::t('app/menu/billing', 'Invoice') . '</span>',
    'url' => ["/billing/billing"],
    'indexLabelMenu' => 'Invoice',
    "items" => [
        [
            "label" => Yii::t('app/menu/billing', 'Invoice'),
            "url" => ["/billing"]
        ],
        [
            "label" => Yii::t('app/menu/payment-terms', 'Payment Terms'),
            "url" => ["/billing/payment-terms"]
        ],
    ]
];



$menuItems = [
    'Billing.2'=>$menu_invoice_invoice
];
