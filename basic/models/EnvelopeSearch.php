<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Envelope;

/**
 * EnvelopeSearch represents the model behind the search form about `app\models\Envelope`.
 */
class EnvelopeSearch extends Envelope
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'AccountId', 'CalculationAmount', 'IsClosed', 'CreatedBy', 'ModifiedBy', 'IsDeleted'], 'integer'],
            [['Name', 'Color', 'CalculationType', 'CreatedOn', 'ModifiedOn'], 'safe'],
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
        $query = Envelope::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Id' => $this->Id,
            'AccountId' => $this->AccountId,
            'CalculationAmount' => $this->CalculationAmount,
            'IsClosed' => $this->IsClosed,
            'CreatedOn' => $this->CreatedOn,
            'CreatedBy' => $this->CreatedBy,
            'ModifiedOn' => $this->ModifiedOn,
            'ModifiedBy' => $this->ModifiedBy,
            'IsDeleted' => $this->IsDeleted,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'Color', $this->Color])
            ->andFilterWhere(['like', 'CalculationType', $this->CalculationType]);

        return $dataProvider;
    }

    public function findForDDL($accountId) {
        $query = Envelope::find();
        
        $envelopes = $query->select('Id, Name')
                ->where([
                    'IsDeleted' => 0,
                    'IsClosed' => 0,
                    'AccountId' => $accountId,
                ])
                ->limit(100)
                ->all();

        return $envelopes;
    }
}
