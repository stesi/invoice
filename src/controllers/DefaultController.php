<?php

namespace stesi\invoice\controllers;

use app\actions\CreateAction;
use app\actions\IndexAction;
use stesi\invoice\models\grid\InvoiceGrid;
use stesi\core\controllers\StesiController;
use app\actions\AddFormInputAction;
use app\actions\DeleteAction;
use app\actions\ListAction;
use app\actions\UpdateAction;
use app\actions\ViewAction;
use stesi\invoice\models\Invoice;


/**
 * Default controller for the `invoice` module
 */
class DefaultController extends StesiController
{
    /**
     * @return array
     */
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
            'invoice-list' => [
                'class' => ListAction::className(),
                'modelClass' => Invoice::className(),
            ]
        ];
    }
   /* public function actionIndex()
    {
        return $this->render('index');

    }*/
}
