<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Color;

/**
 * ColorSearch represents the model behind the search form about `app\models\Color`.
 */
class ColorSearch extends Color
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'Name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Color::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'Id', $this->Id])
            ->andFilterWhere(['like', 'Name', $this->Name]);

        return $dataProvider;
    }
    
    public function findForDDL() {
        $query = Color::find();
        
        $colors = $query->select('Id, Name')
                ->orderBy('Name')
                ->all();

        return $colors;
    }
}
