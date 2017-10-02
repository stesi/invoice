<?php

namespace stesi\invoice\controllers;

use app\actions\CreateAction;
use app\actions\DeleteAction;
use app\actions\IndexAction;
use app\actions\ListAction;
use app\actions\UpdateAction;
use app\actions\ViewAction;
use app\controllers\StesiController;
use stesi\invoice\models\Invoice;
use stesi\invoice\models\grid\InvoiceGrid;

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
            'view' => [
                'class' => ViewAction::className(),
                'modelClass' => Invoice::className(),
            ],
            ' invoice-list' => [
                'class' => ListAction::className(),
                'modelClass' => Invoice::className(),
            ]
        ];
    }
}
