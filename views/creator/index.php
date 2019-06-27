<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use vendor\dmsylvio\menu\models\Model;
/* @var $this yii\web\View */
/* @var $searchModel vendor\dmsylvio\menu\models\Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Menu');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index box box-primary" style="padding: 15px;">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php Pjax::begin(); ?>
    <?= $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary' => '',
        'showHeader' => true,
        'showOnEmpty' => true,
        'emptyCell'=> '-',
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'label' => '#'
            ],
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
            [
                'attribute' => 'status',
                'label' => 'Ativo?',
                'format' => 'raw',
                'value' => function($model){
                    if($model->status == true){
                        return Html::encode('Não');
                    }else{
                        return Html::encode('Sim');
                    }
                }
            ],
            'new_tab:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
