<?php

namespace stesi\invoice\controllers;

use app\actions\CreateAction;
use app\actions\DeleteAction;
use app\actions\IndexAction;
use app\actions\ListAction;
use app\actions\UpdateAction;
use app\actions\ViewAction;
use stesi\core\controllers\StesiController;
use stesi\invoice\models\VatCode;
use yii\db\Query;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;

/**
 * VatCodeController implements the CRUD actions for VatCode model.
 */
class VatCodeController extends StesiController
{
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'modelClass' => VatCode::className(),
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => VatCode::className()
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => VatCode::className()
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => VatCode::className(),
            ],
            'view' => [
                'class' => ViewAction::className(),
                'modelClass' => VatCode::className(),
            ],
            'vatcode-list' => [
                'class' => ListAction::className(),
                'modelClass' => VatCode::className(),
                'description_name' => 'code',
            ]
        ];
    }

    public function actionGetVatValueById(){
        if (\Yii::$app->request->isAjax) {
            $values = array("output" => [], "selected" => "");
            if (isset($_POST['depdrop_parents'])) {

                $parents = end($_POST['depdrop_parents']);
                if (!empty($parents) && $parents !== "Loading ...") {

                    $command = (new Query())->select(['inv_vat_code.vat as id', 'inv_vat_code.vat as name'])->distinct()
                        ->from('inv_vat_code')
                        ->where(["and", ["id" => $parents]])
                        ->createCommand();
                    //  echo $command->rawSql;
                    $output = $command->queryAll();
                    $selected = "";
                    if (isset($_REQUEST['vat_id'])) {
                        $selected = $_REQUEST['vat_id'];
                    } else {
                        if (count($output) == 1) {
                            $selected = $output[0]['id'];
                        }
                    }
                    echo Json::encode(array("output" => $output, "selected" => $selected));
                    return;
                }
            }

            echo Json::encode($values);
            return;
        }
        throw new BadRequestHttpException();
    }
}
