<?php


$menu_invoice_invoice=[
    'label' => '<i class="fa fa-fw fa-eur"></i> ' . Yii::t('app/menu/invoice', 'Invoice') . '</span>',
    'url' => ["/invoice/invoice"],
    'indexLabelMenu' => 'Invoice',
    "items" => [
        [
            "label" => Yii::t('app/menu/invoice', 'Invoice'),
            "url" => ["/invoice/invoice"]
        ],
        [
            "label" => Yii::t('app/menu/payment-terms', 'Payment Terms'),
            "url" => ["/invoice/payment-terms"]
        ],
    ]
];



$menuItems = [
    'Billing.2'=>$menu_invoice_invoice
];
