<?php

namespace stesi\billing;

use stesi\core\events\MenuEvent;
use Yii;

/**
 * billing module definition class
 */
class Module extends \yii\base\Module
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
        Yii::$app->view->on(MenuEvent::EVENT_BEFORE_RENDER, [$this, 'addMenuItems']);
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
}
