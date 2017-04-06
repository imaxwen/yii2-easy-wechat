<?php
/**
 * Project: yii2-easy-wechat.
 * Author: Max
 * Time: <17/4/2 22:40>
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '公众号列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">
    <p class="text-right">
        <?php $this->beginBlock('widgets') ?>
        <?= Html::a('添加公众号', ['create'], ['class' => 'btn btn-success']) ?>
        <?php $this->endBlock() ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            // 'original',
            // 'app_id',
            // 'app_secret',
            // 'token',
            // 'access_token',
             'account',
             'type',
            // 'encoding_type',
            // 'encoding_aes_key',
            // 'description',
            // 'status',
            'updated_at:datetime',
            'created_at:datetime',
            [
                'label'=>'操作',
                'format'=>'raw',
                'value' => function($data){
                    $buttons = Html::a('编辑', Url::to(['update','id' => $data->id]), ['class'=> 'btn btn-xs btn-default']);
                    $buttons .= Html::a('删除', Url::to(['delete', 'id' => $data->id]), [
                            'class'=> 'btn btn-xs btn-danger',
                        'data-confirm'=>"您确定要删除此项吗？" , 'data-method'=>"post"]);
                    $buttons .= Html::a('接口配置', Url::to(['config', 'id' => $data->id]), ['class'=> 'btn btn-xs btn-info']);
                    $buttons .= Html::a('功能管理', Url::to(['change', 'id' => $data->id]), ['class'=> 'btn btn-xs btn-success']);
                    return $buttons;
                }
            ]
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>