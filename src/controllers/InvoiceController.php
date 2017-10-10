<?php

namespace stesi\billing\controllers;

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

/**
 * InvoiceController implements the CRUD actions for Invoice model.
 */
class InvoiceController extends StesiController
{
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'modelClass' => InvoiceGrid::className(),
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => Invoice::className()
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => Invoice::className()
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Invoice::className(),
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
}
