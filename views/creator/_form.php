<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use vendor\dmsylvio\menu\models\Model;

/* @var $this yii\web\View */
/* @var $model vendor\dmsylvio\menu\models\Model */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form box box-primary" style="padding: 15px;">

    <?php 
        $form = ActiveForm::begin(); 
        $template = ['template' => '<div class="row" style="width: 200px; margin-left: 0px;"> {label}</div>{input}<div class="row" style="width: 400px; margin-left: 0px;"> {error}{hint}</div>']
    ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'id_parent')->dropDownList(
                ArrayHelper::map(Model::find()->orderBy(['nome' => SORT_DESC])->all(), 'id', 'nome'),
                ['prompt' => '#'])->label('Menu')
            ?>
        </div>
        <div class="col-md-8"><?= $form->field($model, 'nome', $template)->textInput(['maxlength' => true]) ?></div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'link', $template)->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'status', $template)->dropDownList([true => 'Não', false => 'Sim'])->label('Ativo?') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'new_tab', $template)->dropDownList([true => 'Sim', false => 'Não'])->label('New Tab?') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Salvar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>