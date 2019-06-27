<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model vendor\dmsylvio\menu\models\Search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-search">
     <div class="pull-left">
        <?= Html::a(Yii::t('app', 'Novo Menu'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">
        <div class="col-sm-3 pull-right">
            <?= $form->field($model, 'nome', [
                'template' => '<div class="input-group">{input}<span class="input-group-btn">' .
                    Html::submitButton('Buscar', ['class' => 'btn btn-default']) .
                    '</span></div>',
            ])->textInput(['value' => ''])->label(false); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
