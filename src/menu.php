<?php


$menu_billing_invoice = [
    'label' => '<i class="fa fa-fw fa-eur"></i> ' . Yii::t('app/menu/administration', 'Billing') . '</span>',
    'url' => ["/billing/invoice"],
    'indexLabelMenu' => 'Billing',
    "items" => [
        [
            'label' => '<i class="fa fa-fw fa-asterisk"></i> ' . Yii::t('app/menu/administration', 'Sales'),
            'url' => ["/billing/sales"],
            'items' => [
                [
                    "label" => Yii::t('app/menu/administration', 'Customer Invoice'),
                    "url" => ["/billing/invoice?invoice_type_id=1"]
                ],
            ],
        ],
        [
            'label' => '<i class="fa fa-fw fa-asterisk"></i> ' . Yii::t('app/menu/administration', 'Purchase'),
            'url' => ["/billing/purchase"],
            'items' => [
                [
                    "label" => Yii::t('app/menu/administration', 'Supplier Invoice'),
                    "url" => ["/billing/invoice?invoice_type_id=4"]
                ],
            ],
        ],
        ["label" => Yii::t('app/menu/administration', 'Payment Terms'),
        "url" => ["/billing/payment-terms"]
    ],
]
];


$menuItems = [
    'Administration.2' => $menu_billing_invoice
];
