<?php
/**
 * Project: yii2-easy-wechat.
 * Author: Max
 * Time: <17/4/2 22:23>
 *
 * @var \yii\web\View $this
 */

use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;

$this->title = $this->title ? : '微信公众号管理';

maxwen\wechat\Asset::register($this);
\rmrevin\yii\fontawesome\AssetBundle::register($this);

/** @var \maxwen\wechat\controllers\BaseController $controller */
$controller = $this->context;
$renderMenu = $controller->module->renderMenu;

?>

<?php $this->beginContent(Yii::$app->getLayoutPath() . '/' . Yii::$app->layout . '.php') ?>

<div class="container-fluid">
    <div class="row wechat-wrapper table-row">
        <?php if ($renderMenu): ?>
        <aside class="col-md-2 navigation">
            <ul class="nav-menu">
                <?php if ($controller->getAccountId()): ?>
                    <li><span class="item-icon"><?=FA::icon('th-large') ?></span>功能
                        <ul>
                            <li class="active"><a href="<?= Url::to(['menu/index']) ?>">自定义菜单</a></li>
                            <li><a href="<?= Url::to(['menu/index']) ?>">自动回复</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li><span class="item-icon"><?=FA::icon('wechat') ?></span>公众号管理
                        <ul>
                            <li class="active"><a href="<?= Url::to(['account/index']) ?>">公众号列表</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

            </ul>

        </aside>
        <?php endif; ?>
        <section class="col-md-<?=$renderMenu ? '10' : '12' ?> console-area">
            <div class="console-header">
                <span class="console-title"><?=$this->title; ?></span>
                <div class="console-widgets">
                    <?php if ($controller->account): ?>
                        <div class="dropdown dropdown-menu-right">
                            <button class="btn btn-default dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?=FA::icon('wechat') ?> <?=$controller->account->name; ?>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="<?=Url::to(['account/create']) ?>">添加公众号</a></li>
                                <li><a href="<?=Url::to(['account/index']) ?>">公众号管理</a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?= $this->blocks['widgets'] ?>
                </div>
            </div>
            <div class="console-content">
                <?=$content?>
            </div>
        </section>
</div>

<?php $this->endContent() ?>
