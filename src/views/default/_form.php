<?php

use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use kartik\form\ActiveField;
use kartik\widgets\Select2;
use stesi\core\models\base\StesiModel\models\PaymentTerms;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model stesi\core\models\base\StesiModel\models\Invoice */
/* @var $form kartik\form\ActiveForm */


?>

<div class="invoice-form">
    <?= $this->render("@app/views/layouts/flash-error"); ?>

    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => true],
        'id' => 'billing-form',
        //'enableAjaxValidation' => true
    ]); ?>

    <?= FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
            [
                'attributes' => [
                    'organization_to_id' => [
                        'type' => Form::INPUT_WIDGET,
                        'widgetClass' => Select2::class,
                        'fieldConfig' => [
                            'hintType' => ActiveField::HINT_SPECIAL,
                            'hintSettings' => ['container' => '#billing-form'],
                        ],
                        'options' => [
                            'pluginOptions' => [
                                'placeholder' => Yii::t('billing/billing/labels', 'invoice_labels.form.select_customer'),
                                'minimumInputLength' => '3',
                                'ajax' => ArrayHelper::merge(require(Yii::getAlias('@app/config/modules/select2Ajax.php')), [
                                    'url' => Url::to(['organization/customer-list']),
                                ]),
                                'allowClear' => true,
                            ],
                            'initValueText' => ArrayHelper::getValue($model, 'organizationTo.name'),
                        ],

                    ],
                ]
            ],
            [
                'attributes' => [       // 1 column layout
                    'preamble' => [
                        'type' => Form::INPUT_TEXT,
                        'fieldConfig' => [
                            'hintType' => ActiveField::HINT_SPECIAL,
                            'hintSettings' => ['container' => '#billing-form'],
                        ]
                    ],
                    'number' => [
                        'type' => Form::INPUT_TEXT,
                        'fieldConfig' => [
                            'hintType' => ActiveField::HINT_SPECIAL,
                            'hintSettings' => ['container' => '#billing-form'],
                        ]
                    ]
                ],

            ],
            [
                'attributes' => [
                    'invoice_type' => [
                        'type' => Form::INPUT_DROPDOWN_LIST,
                        'fieldConfig' => [
                            'hintType' => ActiveField::HINT_SPECIAL,
                            'hintSettings' => ['container' => '#billing-form'],
                        ],
                        'items' => ['INVOICE'=>'INVOICE', 'PREINVOICE'=>'PREINVOICE'],
                    ]
                ]
            ],
            [
                'attributes' => [
                    'payment_terms_id' => [
                        'type' => Form::INPUT_WIDGET,
                        'widgetClass' => Select2::class,
                        'fieldConfig' => [
                            'hintType' => ActiveField::HINT_SPECIAL,
                            'hintSettings' => ['container' => '#billing-form'],
                        ],
                        'options' => [
                            'data'=>ArrayHelper::map(PaymentTerms::find()->all(), 'id', 'name'),
                            'pluginOptions' => [
                                'placeholder' => Yii::t('billing/billing/labels', 'invoice_labels.form.select_payment_terms'),
                                'allowClear' => true,
                            ],
                            'initValueText' => ArrayHelper::getValue($model, 'paymentTerms.name'),
                        ],

                    ],
                ]
            ],


        ],
    ]);

    echo $form->field($model, 'invoice_date', ['hintType' => \kartik\form\ActiveField::HINT_SPECIAL,
        'hintSettings' => ['container' => '#billing-form']
    ])->widget(DateControl::className(), [
        'type' => DateControl::FORMAT_DATETIME,
        'options' => ['placeholder' => 'Enter date ...']
    ]);

    echo $form->field($model, 'competence_date', ['hintType' => \kartik\form\ActiveField::HINT_SPECIAL,
        'hintSettings' => ['container' => '#billing-form']
    ])->widget(DateControl::className(), [
        'type' => DateControl::FORMAT_DATETIME,
        'options' => ['placeholder' => 'Enter date ...']
    ]);


    ?>
    <?= FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
            [
                'attributes' => [       // 1 column layout
                    'object' => [
                        'type' => Form::INPUT_TEXT,
                        'fieldConfig' => [
                            'hintType' => ActiveField::HINT_SPECIAL,
                            'hintSettings' => ['container' => '#billing-form'],
                        ]
                    ],
                ]
            ]
        ]
    ]);
    ?>

    <?php $subFormsItems = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('billing/billing/labels', 'invoice_tabs.invoice_row')),
            'content' => $this->render('_form_invoice_row', [
                'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $model->invoiceRows]),
                'form' => $form
            ])
        ],
        /*
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('billing/billing/labels', 'invoice_tabs.invoice_row')),
            'content' => $this->render('_form_required_payment', [
                'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $model->invoiceRows]),
                'form' => $form
            ])
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('billing/billing/labels', 'invoice_tabs.invoice_row')),
            'content' => $this->render('_form_received_payment', [
                'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $model->invoiceRows]),
                'form' => $form
            ])
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('billing/billing/labels', 'invoice_tabs.invoice_row')),
            'content' => $this->render('_form_attached', [
                'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $model->invoiceRows]),
                'form' => $form
            ])
        ],*/

    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $subFormsItems,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>

    <?= FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
            [
                'attributes' => [       // 1 column layout
                    'note' => [
                        'type' => Form::INPUT_TEXTAREA,
                        'fieldConfig' => [
                            'hintType' => ActiveField::HINT_SPECIAL,
                            'hintSettings' => ['container' => '#billing-form'],
                        ]
                    ],
                ]
            ]
        ]
    ]);
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app/buttons', 'form_button_create') : Yii::t('app/buttons', 'form_button_update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app/buttons', 'form_button_reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php
    ActiveForm::end();
    ?>

</div>

<?php

$script = <<<'JS'

   var form_wrapper=$(billing);

    form_wrapper.on("change",".invoice_row_qty",function(e) {
        getTotal($(this));     
    });
    form_wrapper.on("change",".invoice_row_uprice",function(e) {
        getTotal($(this));  
    }); 
    form_wrapper.on("change",".invoice_row_discount",function(e) {
        getTotal($(this)); 
    });  
    
    function getTotal(elem){
        var tr = elem.closest("tr");
        $tot= 0;
        $qty= $(".invoice_row_qty",tr).val();
        $unit_price= $(".invoice_row_uprice",tr).val();
        $discount= $(".invoice_row_discount",tr).val();
        $sub_total=($qty*$unit_price)-(($qty*$unit_price)*$discount/100);
        $('.invoice_row_subtotal',tr).val($sub_total);
    }
    
       
JS;
$this->registerJs($script);

?>
