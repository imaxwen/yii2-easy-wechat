<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model maxwen\wechat\models\Account */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '公众号列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-view">

    <?php $this->beginBlock('widgets') ?>
        <?= Html::a('返回列表', ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

    <?php $this->endBlock() ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'original',
            'app_id',
            'app_secret',
            'token',
            'access_token',
            'account',
            [
                'attribute' => 'type',
                'value' => function($data){
                    return \maxwen\wechat\models\Account::getTypelist()[$data->type];
                }
            ],
            [
                'attribute' => 'ecoding_type',
                'value' => function($data){
                    return \maxwen\wechat\models\Account::getEnctypes()[$data->encoding_type];
                }
            ],
            'encoding_aes_key',
            'description',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
