<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model maxwen\wechat\models\Account */

$this->title = '添加公众号';
$this->params['breadcrumbs'][] = ['label' => '公众号列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
