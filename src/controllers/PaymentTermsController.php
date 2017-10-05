<?php

namespace stesi\invoice\controllers;

use app\actions\CreateAction;
use app\actions\DeleteAction;
use app\actions\IndexAction;
use app\actions\ListAction;
use app\actions\UpdateAction;
use app\actions\ViewAction;
use stesi\core\controllers\StesiController;
use stesi\invoice\models\PaymentTerms;
use stesi\invoice\models\grid\PaymentTermsGrid;

/**
 * PaymentTermsController implements the CRUD actions for PaymentTerms model.
 */
class PaymentTermsController extends StesiController 
{
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'modelClass' => PaymentTermsGrid::className(),
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => PaymentTerms::className()
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => PaymentTerms::className()
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => PaymentTerms::className(),
            ],
            'view' => [
                'class' => ViewAction::className(),
                'modelClass' => PaymentTerms::className(),
            ],
            'paymentterms-list' => [
                'class' => ListAction::className(),
                'modelClass' => PaymentTerms::className(),
                'description_name' => 'name',
            ]
        ];
    }
}
