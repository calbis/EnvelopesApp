<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Envelope;

/**
 * EnvelopeSearch represents the model behind the search form about `app\models\Envelope`.
 */
class EnvelopeSearch extends Envelope {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Id', 'AccountId', 'CalculationAmount', 'IsClosed', 'CreatedBy', 'ModifiedBy', 'IsDeleted'], 'integer'],
            [['Name', 'Color', 'CalculationType', 'CreatedOn', 'ModifiedOn'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
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

    public function findForTransferDDL() {
        $query = Envelope::find();

        $envelopes = $query->select(["E.Id As Id", "CONCAT(A.Name, \" - \", E.Name) As Name "])
                ->from('envelope E')
                ->innerJoin('account A', 'E.AccountId = A.Id')
                ->where([
                    'A.IsDeleted' => 0,
                    'A.IsClosed' => 0,
                    'A.IsCash' => 0,
                    'E.IsClosed' => 0,
                    'E.IsDeleted' => 0,
                ])
                ->orderBy('A.Name, E.Name')
                ->limit(150)
                ->all();

        return $envelopes;
    }

    public function GetEnvelopeIdsByAccount($accountId) {
        $query = Envelope::find();
        $envelopes = $query->select('Id')
                ->where([
                    'IsDeleted' => 0,
                    'IsClosed' => 0,
                    'AccountId' => $accountId,
                ])
                ->limit(100)
                ->all();

        $envelope = null;
        $envelopeIds = [];
        foreach ($envelopes as $envelope) {
            array_push($envelopeIds, $envelope->Id);
        }

        return $envelopeIds;
    }

    public function findByAccount($accountId) {
        $query = Envelope::find();

        return $query->where(['AccountId' => $accountId, 'IsDeleted' => 0])->all();
    }

}
