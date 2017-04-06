<?php
/**
 * Project: yii2-easy-wechat.
 * Author: Max
 * Time: <17/4/2 23:05>
 */

namespace maxwen\wechat\controllers;

use EasyWeChat\Foundation\Application;
use yii;
use maxwen\wechat\Module;
use yii\web\Controller;
use yii\filters\AccessControl;
use maxwen\wechat\models\Account;

/**
 * Class BaseController
 * @package maxwen\wechat\controllers
 *
 * @property int $accountId
 * @property EasyWeChat\Foundation\Application $wechat
 * @property Account $account;
 */
class BaseController extends Controller
{
    /**
     * @var Module
     */
    public $module;
    /**
     * @var Application
     */
    private static $_wechat = null;
    /**
     * @var Account
     */
    private static $_account = null;

    /**
     * @return EasyWeChat\Foundation\Application
     */
    public function getWechat()
    {
        if(is_null(self::$_wechat)) {
            Yii::$app->wechat->setConfig($this->getWechatConfig());

            self::$_wechat = Yii::$app->wechat;
        }
        return self::$_wechat;
    }

    /**
     * @return Account|mixed
     */
    public function getAccount()
    {
        if(is_null(self::$_account)) {
            self::$_account = $this->getCurrentAccount();
        }

        return self::$_account;
    }

    /**
     * @return array
     * @throws yii\base\InvalidConfigException
     */
    protected function getWechatConfig()
    {
        $accountId = $this->getAccountId();
        if($accountId) {
            $account = Account::findOne($accountId);
            $config = [
                'debug' => YII_ENV_DEV,
                'app_id' => $account->app_id,
                'secret' => $account->app_secret,
                'token'  => $account->token,
                'aes_key' => $account->encoding_aes_key,
            ];

            return $config;
        }else{
            throw new yii\base\InvalidConfigException('无法获取当前公众号信息，请先选择公众号');
        }
    }

    /**
     * @return mixed
     */
    public function getAccountId()
    {
        return Yii::$app->session->get($this->module->accountSessionParam);
    }

    /**
     * @return null|static
     */
    public function getCurrentAccount()
    {
        if($this->getAccountId()) {
            return Account::findOne($this->getAccountId());
        }

        return null;
    }

}