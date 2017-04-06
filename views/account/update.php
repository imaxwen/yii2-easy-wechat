<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model maxwen\wechat\models\Account */

$this->title = '编辑公众号: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '公众号列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '编辑公众号';
?>
<div class="account-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
