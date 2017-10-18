<?php

namespace stesi\billing;

use stesi\core\events\MenuEvent;
use Yii;
use yii\base\BootstrapInterface;

/**
 * billing module definition class
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'stesi\billing\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'stesi\billing\commands';
        }
        else {Yii::$app->view->on(MenuEvent::EVENT_BEFORE_RENDER, [$this, 'addMenuItems']);}
    }

    /**
     * @param $menuEvent MenuEvent
     */

    public function addMenuItems($menuEvent)
    {
        require(__DIR__ . '/menu.php');
        $menuEvent->insertItems($menuItems);
//        $menuEvent->insertFirst($menu1); // equal $menuEvent->insertAt([0 => $menu1]);
//        $menuEvent->insertLast($menu2); // equal $menuEvent->insertAt(['last' => $menu1]);
    }

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            //ROTTE ALIAS PER NASCONDERE LE ROTTE DI INVOICE
            //da capire bene come scriverle per nascondere il parametro invoice_type_id da URL
           /* [
                'class' => 'yii\web\UrlRule',
                'pattern' => '/billing/invoice?invoice_type_id=1',
                'route' => '/billing/invoice/index'
            ],*/



        ], false);
    }


}
