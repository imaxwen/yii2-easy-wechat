<?php
/**
 * Project: yii2-easy-wechat.
 * Author: Max
 * Time: <17/4/3 04:13>
 * @var \yii\web\View $this
 */
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url;

$this->title = '自定义菜单';
?>

<?php $this->beginBlock('widgets') ?>
<a href="" class="btn btn-danger">停用</a>
<a href="<?=Url::to(['menu/publish'])?>" class="btn btn-success">发布菜单</a>
<?php $this->endBlock();?>

<div class="row menu-console">
    <div class="col-md-4 menu-preview">
        <div class="panel panel-default">
            <div class="panel-heading"><?=$this->context->account->name; ?></div>
            <div class="panel-body"></div>
            <div class="panel-footer">
                <div class="btn-group btn-group-justified menu-btns" role="group">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default menu-item"><i class="add-icon">+</i> 添加菜单</button>
                        <div class="sub-items">
                            <button type="button" class="btn btn-default menu-subitem">子菜单1</button>
                            <button type="button" class="btn btn-default menu-subitem">子菜单2</button>
                            <button type="button" class="btn btn-default menu-subitem">子菜单3</button>
                            <button type="button" class="btn btn-default js_addMenu"> <i class="add-icon">+</i> </button>
                            <i class="arrow arrow_out"></i>
                            <i class="arrow arrow_in"></i>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="col-md-8 menu-form">
        <div class="panel panel-default">
            <div class="panel-heading">
                编辑菜单
                <div class="panel-heading-tool">
                    <a href="" class="btn btn-link">删除菜单</a>
                </div>
            </div>
            <div class="panel-body">
                <div class="text-center" id="menu-form-message" style="margin-top: 35px;">在左侧添加/选中菜单， 并设置菜单的响应内容</div>
            </div>
        </div>

    </div>
</div>

<div class="row">

</div>
