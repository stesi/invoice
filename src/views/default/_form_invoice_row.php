<?php

use app\widgets\CreatableSelect2;
use kartik\daterange\DateRangePicker;
use kartik\depdrop\DepDrop;
use kartik\form\ActiveForm;

use kartik\builder\TabularForm;
use kartik\widgets\Select2;
use stesi\invoice\models\InvoiceRow;
use stesi\invoice\models\Product;
use stesi\invoice\models\VatCode;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use yii\helpers\Url;
use yii\web\JsExpression;

$subformName = 'invoice_row';
$subformId = 'tabular-form-invoice-invoice-row-wrapper';
$modelName = InvoiceRow::class;
$buttonAddMessage = Yii::t('invoice/invoice/buttons', 'invoice_buttons.subform.add_invoice_row');
$parentFormId = 'invoice-form';

if (!isset($form)) {
    $form = ActiveForm::begin();
    ActiveForm::end();
}

?>
<div class="form-group" id="<?= $subformId ?>">
    <?php
    echo TabularForm::widget([
        'dataProvider' => $dataProvider,
        'form' => $form,
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributes' => [
            "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden' => true]],
            'product_id' => [
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => CreatableSelect2::class,
                'options' => function ($model, $key) {
                    $inputId = 'invoicerow_product_id-' . $key;
                    $initValueText = isset($model->product_id) ? ArrayHelper::map(Product::find()->where(['id' => $model['product_id']])->all(), 'id', 'code') : "";

                    return [
                        'initValueText' => $initValueText,
                        'pluginOptions' => [

                            'placeholder' => 'Select a product...',

                            'minimumInputLength' => '1',
                            'ajax' => ArrayHelper::merge(require(Yii::getAlias('@app/config/modules/select2Ajax.php')), [
                                'url' => Url::to(['/gles/product/product-code-product-type-list'])
                            ]),
                        ],
                        'size' => Select2::SMALL,
                        'options' => [
                            'id' => $inputId,
                            'class' => 'js-dependent-input-select2-default', // default trigger action, remove for custom
                        ],
                    ];

                },
            ],
            'description' => [
                'type' => TabularForm::INPUT_TEXTAREA,
            ],

            'quantity' => [
                'type' => TabularForm::INPUT_TEXT,
                'columnOptions' => [
                    'width' => '100px'
                ],
                'options' => ['class' => 'invoice_row_qty'
                ],
            ],
            'unit_price' => [
                'type' => TabularForm::INPUT_TEXT,
                'columnOptions' => [
                    'width' => '100px'
                ],
                'options' => ['class' => 'invoice_row_uprice'
                ],
            ],
            'discount' => [
                'type' => TabularForm::INPUT_TEXT,
                'columnOptions' => [
                    'width' => '100px'
                ],
                'options' => [
                    'class' => 'invoice_row_discount',
                ],
                'fieldConfig' => [
                    'addon' => [
                        'append' => ['content' => '%', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
                    ]
                ],

            ],
            'subtotal_row' => [
                'type' => TabularForm::INPUT_TEXT,
                'options' => [
                    'class' => 'invoice_row_subtotal',
                    'readOnly' => true,
                ],
            ],
            'vat_id' => [
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => Select2::class,
                'options' => function ($model, $key) {
                    $inputId = 'invoicerow_vat_id';
                    if (!isset($model['vat_id'])) $model['vat_id'] = 6; // default vat_id
                    $initValueText = ArrayHelper::map(VatCode::find()->getVatValueWithCode()->where(['id' => $model['vat_id']])->all(), 'id', 'code');
                    return [
                        'initValueText' => $initValueText,
                        'class' => 'invoice_row_vat_id',
                        'data' => ArrayHelper::map(VatCode::find()->getVatValueWithCode()->all(), 'id', 'code'),
                        'size' => Select2::SMALL,

                    ];

                },
            ],
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function ($model, $key) {
                    return
                        Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app/buttons', 'subform_button_delete'), 'class' => 'btn_del_form_row']);
                },
            ],
        ],
        'gridSettings' => require(__DIR__ . '/../../../../../config/modules/gridSettingsOfTabularInput.php')

    ]);
    echo "    </div>\n\n";

    require(__DIR__ . '/../../../../../views/layouts/appendClientValidationSubForm.php');


    ?>
