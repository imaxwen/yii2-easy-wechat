<?php
/**
 * Project: jianjiang.
 * Author: Max
 * Time: <17/4/1 12:46>
 */


namespace maxwen\easywechat;

/**
 * wechat module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'maxwen\easywechat\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
