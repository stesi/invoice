<?php
use app\modules\gles\models\ContractManager;
use app\modules\gles\models\HookingQuery;
use app\widgets\CreatableSelect2;
use kartik\daterange\DateRangePicker;
use kartik\form\ActiveForm;
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\JsExpression;

$subformName = 'contract_manager';
$subformId = 'tabular-form-price-list-contract-manager-wrapper';
$modelName=ContractManager::class;
$buttonAddMessage= 'Add Contract Manager';
$parentFormId='price-list-form';

if (!isset($form)) {
    $form = ActiveForm::begin();
    ActiveForm::end();
}

?>
<div class="form-group" id="<?=$subformId?>">
    <?php
    echo TabularForm::widget([
        'dataProvider' => $dataProvider,
        'form' => $form,
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributes' => [
            "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden' => true]],
            'contract_id' => [
                'type' => TabularForm::INPUT_WIDGET,

                'widgetClass' => CreatableSelect2::class,
                'options' => function ($model, $key) {
                    $inputId = 'contractmanager-contract_id-' . $key;
                    $initValueText = isset($model->contract_id)?ArrayHelper::map(\app\modules\gles\models\Contract::find()->where(['id'=>$model['contract_id']])->all(), 'id', 'name'):"";

                    return [
                        'initValueText' => $initValueText,
                        'pluginOptions' => [

                            'placeholder' => 'Select a contract...',

                            'minimumInputLength' => '1',
                            'ajax' => ArrayHelper::merge(require(Yii::getAlias('@app/config/modules/select2Ajax.php')), [
                                'url' => Url::to(['/gles/contract/contract-list-with-style'])
                            ]),
                            'create-text' => Yii::t('app', 'Not found {query}?', ['query' => '<b>{query}</b>']) . ' '
                                . Html::a(Yii::t('app', 'Create Contract'), Url::to(['/gles/contract/create-ajax']) . '?name={query}', [
                                    'title' => Yii::t('app', 'Create Contract'),
                                    'class' => 'btn btn-success btn-xs showModalButton',
                                    'data' => [
                                        'dependent-inputs' => '#' . $inputId,
                                        'modal-unique' => 'contract-create',
                                    ],
                                ]),
                            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        ],
                        'size' => Select2::SMALL,
                        'options' => [
                            'id' => $inputId,
                            'class' => 'js-dependent-input-select2-default', // default trigger action, remove for custom
                        ],
                    ];

                },
                'columnOptions'=>['width'=>'190px'],
                'contentOptions' => function ($model, $key, $index, $column) {

                    return ['style' => 'background-color:red'];
                },
            ],
            'start_end_range' => [
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => DateRangePicker::className(),
                'options' => function ($model, $key, $index, $widget) {
                    return [
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'locale' => [
                                'separator' => Yii::t('format', 'separator'),
                                'format' => Yii::t('format', 'date'),
                            ]
                        ]
                    ];
                },
            ],
            'hooking_id' => [
                'type' => TabularForm::INPUT_WIDGET,

                'widgetClass' => CreatableSelect2::class,
                'options' => function ($model, $key) {
                    $inputId = 'price-list-contractmanager-hooking_id-' . $key;
                    $initValueText = isset($model['hooking_id']) ? ArrayHelper::map((new HookingQuery())->getHookingShortList()->andWhere(['hooking.id' => $model['hooking_id']])->createCommand()->queryAll(), 'id', 'text') : "";  //isset($model->hooking_id) ? ArrayHelper::map(\app\modules\gles\models\Hooking::find()->where(['id' => $model->hooking_id])->one(), 'id', 'name') : "";
                    return [
                        'initValueText' => $initValueText,
                        'pluginOptions' => [

                            'placeholder' => 'Select a hooking...',

                            'minimumInputLength' => '1',
                            'ajax' => ArrayHelper::merge(require(Yii::getAlias('@app/config/modules/select2Ajax.php')), [
                                'url' => Url::to(['/gles/hooking/hooking-complete-list'])
                            ]),
                            'create-text' => Yii::t('app', 'Not found {query}?', ['query' => '<b>{query}</b>']) . ' '
                                . Html::a(Yii::t('app', 'Create Hooking'), Url::to(['/gles/hooking/create-ajax']) . '?name={query}', [
                                    'title' => Yii::t('app', 'Create Hooking'),
                                    'class' => 'btn btn-success btn-xs showModalButton',
                                    'data' => [
                                        'dependent-inputs' => '#' . $inputId,
                                        'modal-unique' => 'hooking-create',
                                    ],
                                ]),

                            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                            'templateResult' => new JsExpression('function (a) { 
                                                                        try{
                                                                            var a2= a.text.split(" - ");
                                                                            var customer = "<b>'.Yii::t('gles/hooking/labels', 'hooking_labels.customer_organization_name').':</b>"+a2[0]
                                                                            var supplier = "<b>'.Yii::t('gles/hooking/labels', 'hooking_labels.supplier_organization_name').':</b>"+a2[1]
                                                                            var bu_type = "<b>'.Yii::t('gles/hooking/labels', 'hooking_labels.bu_type_name').':</b>"+a2[2]
                                                                            a2 =customer+" - "+supplier+" - "+bu_type
                                                                        }catch(ex){
                                                                            var a2= a.text
                                                                        }
                                                                        return a2; }'),
                        ],
                        'size' => Select2::SMALL,
                        'options' => [
                            'id' => $inputId,
                            'class' => 'js-dependent-input-select2-default', // default trigger action, remove for custom
                        ],
                    ];

                },
                'columnOptions'=>['width'=>'350px']
            ],
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function ($model, $key) {
                    return
                        Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'class' => 'btn_del_form_row']);
                },
            ],
        ],
        'gridSettings' => require(__DIR__ . '/../../../../config/modules/gridSettingsOfTabularInput.php')
            /*[
            'panel' => [
                'heading' => false,
                'type' => GridView::TYPE_DEFAULT,
                'before' => false,
                'footer' => false,
                'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', $buttonAddMessage), [
                    'type' => 'button',
                    'class' => 'btn btn-success kv-batch-create btn-add-form-input',
                    'data' => [
                        'url' => Url::to(['add-form-input', 'subFormName' => $subformName, 'modelName' => $modelName]),
                        'wrapper' => '#'.$subformId,
                    ],
                ]),
            ]
        ]*/
    ]);
    echo "    </div>\n\n";

require(__DIR__ . '/../../../../views/layouts/appendClientValidationSubForm.php');

/*
    if (isset($appendClientValidation) && $appendClientValidation) {
        foreach ($form->attributes as $attribute) {
            $attributes = Json::htmlEncode($attribute);
            $this->registerJs("jQuery('#'.$parentFormId).yiiActiveForm('add', $attributes);");
        }
    }

*/


?>
