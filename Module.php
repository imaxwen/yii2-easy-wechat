<?php
/**
 * Project: yii2-easy-wechat.
 * Author: Max
 * Time: <17/4/1 12:46>
 */


namespace maxwen\wechat;

/**
 * wechat module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * render left menu or not
     * @var bool
     */
    public $renderMenu = true;

    /**
     * Current wechat account Id
     * @var string
     */
    public $accountSessionParam = '__wechatAccountId';

    /**
     * @var string
     */
    public $layout = 'main';

    /**
     * @var string
     */
    public $defaultRoute = 'account';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'maxwen\wechat\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
