<?php


$menu_billing_invoice = [
    'label' => '<i class="fa fa-fw fa-eur"></i> ' . Yii::t('app/menu/administration', 'Billing') . '</span>',
    'url' => ["/billing/invoice"],
    'indexLabelMenu' => 'Billing',
    "items" => [
        [
            'label' => Yii::t('app/menu/administration', 'Sales'),
            'url' => ["/billing/sales"],
            'items' => [
                [
                    "label" => Yii::t('app/menu/administration', 'Customer Invoice'),
                    "url" => ["/billing/invoice?invoice_type_id=1"]
                ],
                [
                    "label" => Yii::t('app/menu/administration', 'Customer Preinvoice'),
                    "url" => ["/billing/invoice?invoice_type_id=2"]
                ],
                [
                    "label" => Yii::t('app/menu/administration', 'Customer Proforma'),
                    "url" => ["/billing/invoice?invoice_type_id=3"]
                ],
            ],
        ],
        [
            'label' => Yii::t('app/menu/administration', 'Purchase'),
            'url' => ["/billing/purchase"],
            'items' => [
                [
                    "label" => Yii::t('app/menu/administration', 'Supplier Prenvoice'),
                    "url" => ["/billing/invoice?invoice_type_id=5"]
                ],
                [
                    "label" => Yii::t('app/menu/administration', 'Supplier Invoice'),
                    "url" => ["/billing/invoice?invoice_type_id=4"]
                ],
            ],
        ],
        [
            "label" => Yii::t('app/menu/administration', 'All Documents'),
            "url" => ["/billing/invoice?invoice_type_id=100"]
        ],
        ["label" => Yii::t('app/menu/administration', 'Payment Terms'),
        "url" => ["/billing/payment-terms"]
    ],
]
];


$menuItems = [
    'Administration.2' => $menu_billing_invoice
];
