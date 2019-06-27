<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model vendor\dmsylvio\menu\models\Model */

$this->title = Yii::t('app', 'Atualizar menu: {name}', [
    'name' => $model->nome,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
?>
<div class="menu-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>