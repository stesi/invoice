<?php

namespace stesi\billing\assets;

use app\assets\SmartAdminAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class InvoiceCreateAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/dist';
//    public $basePath = '@webroot';
//
//    public $baseUrl = '@web/smartadmin';

    public $js = [

        'invoice_create.js',

    ];

    public $depends = [
        JqueryAsset::class
    ];

}
