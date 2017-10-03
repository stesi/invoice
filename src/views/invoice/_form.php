<?php

use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use kartik\form\ActiveField;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model stesi\invoice\models\Invoice */
/* @var $form kartik\form\ActiveForm */


?>

<div class="invoice-form">
    <?= $this->render("@app/views/layouts/flash-error"); ?>

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
                                'placeholder' => Yii::t('invoice/invoice/labels', 'invoice_labels.form.select_customer'),
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
                        'items' => ['INVOICE', 'PREINVOICE'],
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
                            'pluginOptions' => [
                                'placeholder' => Yii::t('invoice/invoice/labels', 'invoice_labels.form.select_payment_terms'),
                                'minimumInputLength' => '3',
                                'ajax' => ArrayHelper::merge(require(Yii::getAlias('@app/config/modules/select2Ajax.php')), [
                                    'url' => Url::to(['payment-terms/paymentterms-list']),
                                ]),
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
                    'note' => [
                        'type' => Form::INPUT_TEXTAREA,
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
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('invoice/invoice/labels', 'invoice_tabs.invoice_row')),
            'content' => $this->render('_form_invoice_row', [
                'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $model->invoiceRows]),
                'form' => $form
            ])
        ]
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


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php
    ActiveForm::end();
    ?>

</div>
