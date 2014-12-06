<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transaction;

/**
 * TransactionSearch represents the model behind the search form about `app\models\Transaction`.
 */
class TransactionSearch extends Transaction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'EnvelopeId', 'UseInStats', 'IsRefund', 'CreatedBy', 'ModifiedBy', 'IsDeleted'], 'integer'],
            [['Name', 'PostedDate', 'CreatedOn', 'ModifiedOn'], 'safe'],
            [['Amount', 'Pending'], 'number'],
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
        $query = Transaction::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['PostedDate'=>SORT_DESC]]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        $query->andFilterWhere([
            'Id' => $this->Id,
            'EnvelopeId' => $this->EnvelopeId,
            'PostedDate' => $this->PostedDate,
            'Amount' => $this->Amount,
            'Pending' => $this->Pending,
            'UseInStats' => $this->UseInStats,
            'IsRefund' => $this->IsRefund,
            'CreatedOn' => $this->CreatedOn,
            'CreatedBy' => $this->CreatedBy,
            'ModifiedOn' => $this->ModifiedOn,
            'ModifiedBy' => $this->ModifiedBy,
            'IsDeleted' => $this->IsDeleted,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name]);

        return $dataProvider;
    }
}
