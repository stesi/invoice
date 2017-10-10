<?php

namespace stesi\core\models\base\StesiModel\controllers;

use stesi\core\actions\CreateAction;
use stesi\core\actions\DeleteAction;
use stesi\core\actions\IndexAction;
use stesi\core\actions\ListAction;
use stesi\core\actions\ListActionQuery;
use stesi\core\actions\UpdateAction;
use stesi\core\actions\ViewAction;
use stesi\core\controllers\StesiController;
use stesi\core\models\base\StesiModel\models\VatCode;
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
            ],
            'vatcode-vat-with-code' => [
                'class' => ListActionQuery::className(),
                'description_name' => 'CONCAT(vat,"% - ",code)',
                'query' =>VatCode::find()
            ],
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
