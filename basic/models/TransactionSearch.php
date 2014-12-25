<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transaction;
use yii\helpers\BaseVarDumper;

/**
 * TransactionSearch represents the model behind the search form about `app\models\Transaction`.
 */
class TransactionSearch extends Transaction {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Id', 'EnvelopeId', 'UseInStats', 'IsRefund', 'CreatedBy', 'ModifiedBy', 'IsDeleted'], 'integer'],
            [['Name', 'PostedDate', 'CreatedOn', 'ModifiedOn'], 'safe'],
            [['Amount', 'Pending'], 'number'],
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
    public function search($params, $envelopeIds, $days) {
        
        $query = Transaction::find();
            $query->where([
                        'IsDeleted' => 0,
                        'EnvelopeId' => $envelopeIds,
                    ])
                    ->all();
            
        if ($days !== null) {
            $date = date('Y-m-d H:i:s', strtotime("-" . $days . " days"));
            
            $query->andWhere(['>=', 'PostedDate', $date]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['PostedDate' => SORT_DESC]]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Id' => $this->Id,
            'EnvelopeId' => $this->EnvelopeId,
            'Amount' => $this->Amount,
            'Pending' => $this->Pending,
            'UseInStats' => $this->UseInStats,
            'IsRefund' => $this->IsRefund,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name]);
        $query->andFilterWhere(['like', 'PostedDate', $this->PostedDate]);

        return $dataProvider;
    }

}
