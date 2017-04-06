<?php
/**
 * Project: yii2-easy-wechat.
 * Author: Max
 * Time: <17/4/2 17:12>
 */

namespace maxwen\wechat\controllers;

use maxwen\wechat\models\Menu;
use yii;

/**
 * Class MenuController
 * @package maxwen\wechat\controllers
 */
class MenuController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPublish()
    {
        $account = $this->account;
        $menus = Menu::getPublishData($account->id);
        $menu = $this->wechat->menu;
        $res = $menu->add($menus);
        var_dump($res);
    }
}