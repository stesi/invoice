<?php

namespace stesi\billing\controllers;

use stesi\core\services\StesiTools;
use stesi\core\actions\AddFormInputAction;
use stesi\core\actions\CreateAction;
use stesi\core\actions\DeleteAction;
use stesi\core\actions\IndexAction;
use stesi\core\actions\ListAction;
use stesi\core\actions\UpdateAction;
use stesi\core\actions\ViewAction;
use stesi\core\controllers\StesiController;
use stesi\billing\models\Invoice;
use stesi\billing\models\grid\InvoiceGrid;
use Yii;

/**
 * InvoiceController implements the CRUD actions for Invoice model.
 */
class InvoiceController extends StesiController
{

    public function actions()
    {
        return [
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => Invoice::className(),
                'additionalParams' => [
                    'invoice_type_id'=>StesiTools::getValueFromSession("invoice_type_id")
                ]
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => Invoice::className()
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Invoice::className(),
                'redirectAfter'=>'index',
            ],
            'add-form-input' => [
                'class' => AddFormInputAction::className(),
            ],
            'view' => [
                'class' => ViewAction::className(),
                'modelClass' => Invoice::className(),
            ],
            'billing-list' => [
                'class' => ListAction::className(),
                'modelClass' => Invoice::className(),
            ]
        ];
    }


    public function actionIndex()
    {

        $searchModel = new InvoiceGrid();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $params = Yii::$app->request->queryParams;
        $invoiceTypeId = StesiTools::getValueFromSession("invoice_type_id");

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'invoiceTypeId'=>$invoiceTypeId
        ]);
    }
}
