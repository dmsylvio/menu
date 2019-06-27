<?php

namespace vendor\dmsylvio\menu\models;

use Yii;
use yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use vendor\dmsylvio\actionlog\behaviors\ActionLogBehavior;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int $id_parent
 * @property string $nome
 * @property string $link
 * @property bool $status
 * @property bool $new_tab
 *
 * @property Model $parent
 * @property Model[] $models
 */
class Model extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'status' => true
                ],
                'replaceRegularDelete' => true
            ],
            'actionlog' => [
                'class' => ActionLogBehavior::class,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_parent'], 'default', 'value' => null],
            [['id_parent'], 'integer'],
            [['nome'], 'required'],
            [['status', 'new_tab'], 'boolean'],
            [['nome', 'link'], 'string', 'max' => 255],
            [['id_parent'], 'exist', 'skipOnError' => true, 'targetClass' => Model::class, 'targetAttribute' => ['id_parent' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_parent' => Yii::t('app', 'Id Parent'),
            'nome' => Yii::t('app', 'Nome'),
            'link' => Yii::t('app', 'Link'),
            'status' => Yii::t('app', 'Status'),
            'new_tab' => Yii::t('app', 'New Tab'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Model::className(), ['id' => 'id_parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModels()
    {
        return $this->hasMany(Model::className(), ['id_parent' => 'id']);
    }
}
