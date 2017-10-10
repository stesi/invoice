<?php


$menu_billing_invoice=[
    'label' => '<i class="fa fa-fw fa-eur"></i> ' . Yii::t('app/menu/administration', 'Billing') . '</span>',
    'url' => ["/billing/invoice"],
    'indexLabelMenu' => 'Billing',
    "items" => [
        [
            "label" => Yii::t('app/menu/invoice', 'Invoice'),
            "url" => ["/billing/invoice"]
        ],
        [
            "label" => Yii::t('app/menu/payment-terms', 'Payment Terms'),
            "url" => ["/billing/payment-terms"]
        ],
    ]
];



$menuItems = [
    'Administration.2'=>$menu_billing_invoice
];
