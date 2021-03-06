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
/* @var $invoice_type_id integer */

/*
if (isset($this->blocks['invoice_form_with_note_js'])) {
    echo $this->blocks['invoice_form_with_note_js'];
} else {*/
\stesi\billing\assets\InvoiceCreateAsset::register($this);
//}
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
                    'payment_terms' => [
                        'type' => Form::INPUT_WIDGET,
                        'widgetClass' => Select2::class,
                        'fieldConfig' => [
                            'hintType' => ActiveField::HINT_SPECIAL,
                            'hintSettings' => ['container' => '#invoice-form'],
                        ],
                        'options' => [
                            'data' => ArrayHelper::map(PaymentTerms::find()->all(), 'name', 'name'),
                            'pluginOptions' => [
                                'placeholder' => Yii::t('billing/invoice/labels', 'invoice_labels.form.select_payment_terms'),
                                'allowClear' => true,
                            ],
                            'initValueText' => ArrayHelper::getValue($model, 'payment_terms'),
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

    echo $form->field($model, 'invoice_type_id')->hiddenInput(['value'=>$invoice_type_id])->label(false)->hint(false);



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

    if (isset($this->blocks['invoice_form_with_note'])) {
        echo $this->blocks['invoice_form_with_note'];
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
