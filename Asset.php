<?php
/**
 * Project: yii2-easy-wechat.
 * Author: Max
 * Time: <17/4/2 22:21>
 */

namespace maxwen\wechat;

use yii;
use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    public $sourcePath = '@vendor/maxwen/yii2-easy-wechat/assets';

    public $css = [
        'css/wechat.css'
    ];

    public $js = [
        'js/wechat.js'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public function init()
    {
        $appAssetBundle = basename(Yii::getAlias('@app')). '\\assets\\AppAsset';
        if(class_exists($appAssetBundle)) {
            $this->depends[] = $appAssetBundle;
        }

        parent::init();
    }
}