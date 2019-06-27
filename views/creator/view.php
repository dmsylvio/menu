<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use vendor\dmsylvio\menu\models\Model;

/* @var $this yii\web\View */
/* @var $model vendor\dmsylvio\menu\models\Model */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="menu-view box box-primary" style="padding: 15px;">

<!-- <h1><?= Html::encode($this->title) ?></h1> -->

<p>
    <?= Html::a(Yii::t('app', 'Alterar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a(Yii::t('app', 'Apagar'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => Yii::t('app', 'Tem certeza que deseja apagar este item?'),
            'method' => 'post',
        ],
    ]) ?>
</p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'attribute' => 'id_parent',
                'label' => 'Pai',
                'value' => function($model){
                    if(is_null($model->id_parent)){
                        return "";
                    }else{
                        $parent = Model::find()->where(['id' => $model->id_parent])->one();   
                        return $parent['nome'];
                    }
                }
            ],
            'nome',
            'link',
            'status:boolean',
            'new_tab:boolean',
        ],
    ]) ?>
</div>