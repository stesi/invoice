<?php

namespace stesi\invoice\controllers;

use app\actions\IndexAction;
use stesi\invoice\models\grid\InvoiceGrid;
use yii\web\Controller;

/**
 * Default controller for the `invoice` module
 */
class DefaultController extends Controller
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
        ];
    }
   /* public function actionIndex()
    {
        return $this->render('index');

    }*/
}
