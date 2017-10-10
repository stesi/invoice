<?php

namespace stesi\core\models\base\StesiModel\controllers;

use stesi\core\actions\CreateAction;
use stesi\core\actions\DeleteAction;
use stesi\core\actions\IndexAction;
use stesi\core\actions\ListAction;
use stesi\core\actions\UpdateAction;
use stesi\core\actions\ViewAction;
use stesi\core\controllers\StesiController;
use stesi\core\models\base\StesiModel\models\PaymentTerms;
use stesi\core\models\base\StesiModel\models\grid\PaymentTermsGrid;

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
