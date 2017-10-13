<?php

use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use kartik\form\ActiveField;
use kartik\widgets\Select2;
use stesi\billing\models\PaymentTerms;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model stesi\billing\models\Invoice */
/* @var $form kartik\form\ActiveForm */


?>

<div class="invoice-form">
    <?= $this->render("@stesi/backend/views/layouts/flash-error"); ?>

    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => true],
        'id' => 'invoice-form',
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
                            'hintSettings' => ['container' => '#invoice-form'],
                        ],
                        'options' => [
                            'pluginOptions' => [
                                'placeholder' => Yii::t('billing/invoice/labels', 'invoice_labels.form.select_customer'),
                                'minimumInputLength' => '3',
                                'ajax' => ArrayHelper::merge(require(Yii::getAlias('@app/config/modules/select2Ajax.php')), [
                                    'url' => Url::to(['organization/customer-list']),
                                ]),
                                'allowClear' => true,
                            ],
                            'initValueText' => ArrayHelper::getValue($model, 'organizationTo.name'),
                            'options' => ['id' => 'invoice_form_organization_to_id'],
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
                            'hintSettings' => ['container' => '#invoice-form'],
                        ]
                    ],
                    'number' => [
                        'type' => Form::INPUT_TEXT,
                        'fieldConfig' => [
                            'hintType' => ActiveField::HINT_SPECIAL,
                            'hintSettings' => ['container' => '#invoice-form'],
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
                            'hintSettings' => ['container' => '#invoice-form'],
                        ],
                        'items' => ['INVOICE' => 'INVOICE', 'PREINVOICE' => 'PREINVOICE'],
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
                            'hintSettings' => ['container' => '#invoice-form'],
                        ],
                        'options' => [
                            'data' => ArrayHelper::map(PaymentTerms::find()->all(), 'id', 'name'),
                            'pluginOptions' => [
                                'placeholder' => Yii::t('billing/invoice/labels', 'invoice_labels.form.select_payment_terms'),
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
        'hintSettings' => ['container' => '#invoice-form']
    ])->widget(DateControl::className(), [
        'type' => DateControl::FORMAT_DATETIME,
        'options' => ['placeholder' => 'Enter date ...']
    ]);

    echo $form->field($model, 'competence_date', ['hintType' => \kartik\form\ActiveField::HINT_SPECIAL,
        'hintSettings' => ['container' => '#invoice-form']
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
                            'hintSettings' => ['container' => '#invoice-form'],
                        ]
                    ],
                ]
            ]
        ]
    ]);
    ?>

    <?php $subFormsItems = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('billing/invoice/labels', 'invoice_tabs.invoice_row')),
            'content' => $this->render('_form_invoice_row', [
                'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $model->invoiceRows]),
                'form' => $form
            ])
        ],
        /*
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('billing/invoice/labels', 'invoice_tabs.invoice_row')),
            'content' => $this->render('_form_required_payment', [
                'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $model->invoiceRows]),
                'form' => $form
            ])
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('billing/invoice/labels', 'invoice_tabs.invoice_row')),
            'content' => $this->render('_form_received_payment', [
                'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $model->invoiceRows]),
                'form' => $form
            ])
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('billing/invoice/labels', 'invoice_tabs.invoice_row')),
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

    if (isset($this->blocks['invoice_form_with_note1'])) {
        echo $this->blocks['invoice_form_with_note1'];
    } else {
        echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                [
                    'attributes' => [       // 1 column layout
                        'note' => [
                            'type' => Form::INPUT_TEXTAREA,
                            'format' => 'html',
                            'fieldConfig' => [
                                'hintType' => ActiveField::HINT_SPECIAL,
                                'hintSettings' => ['container' => '#invoice-form'],
                            ],

                        ],
                    ]
                ]
            ]
        ]);
    }
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

 $("#invoice_form_note_automatic").val('ciao');  	

   var form_wrapper=$('.invoice-form');

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
    
    
    $("#invoice_form_organization_to_id").on("change",function(e) {

        var organization_id = $("#invoice_form_organization_to_id").val();  
       // var date=new DATE();
        
			$.ajax({
				url : "/notes/invoice/automatic-note",				
				type : "POST",				
				data : {
					organization_id: organization_id,
					date:'2017-10-13'
								
				},				
				success : function(data) {
				    var note=data.auto_note;				
				    $("#invoice-note").val(note);  					
				},
				error: function(xhr, textStatus, errorThrown){
				    alert('bad url')
                }
			});		
    });
       
JS;
$this->registerJs($script);

?>
