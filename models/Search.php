<?php

namespace vendor\dmsylvio\menu\models;

use yii\data\ActiveDataProvider;
use vendor\dmsylvio\menu\models\Model;

/**
 * Search represents the model behind the search form of `vendor\dmsylvio\menu\models\Model`.
 */
class Search extends Model
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_parent'], 'integer'],
            [['nome', 'link'], 'safe'],
            [['status', 'new_tab'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Model::find()->orderBy(['id' => SORT_ASC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_parent' => $this->id_parent,
            'status' => $this->status,
            'new_tab' => $this->new_tab,
        ]);

        $query->andFilterWhere(['ilike', 'nome', $this->nome])
            ->andFilterWhere(['ilike', 'link', $this->link]);

        return $dataProvider;
    }
}
