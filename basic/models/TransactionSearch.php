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

    public function findByDate($accountId) {
        $query = Transaction::find();

        $query->select(['T.PostedDate As PostedDate', 'SUM(T.Pending) As Pending'])
                ->from('transaction T')
                ->innerJoin('envelope E', 'T.EnvelopeId = E.Id')
                ->where([
                    'E.IsDeleted' => 0,
                    'E.IsClosed' => 0,
                    'T.IsDeleted' => 0,
                    'E.AccountId' => $accountId
                ])
                ->groupBy(['T.PostedDate'])
                ->having(['>', 'COUNT(T.PostedDate)', '1'])
                ->orderBy('T.PostedDate')
                ->limit(20);

        $query->andWhere(['!=', 'T.Pending', 0]);

        return $query->all();
    }

    public function findByName($accountId) {
        $query = Transaction::find();

        $query->select(['T.Name As Name', 'SUM(T.Pending) As Pending'])
                ->from('transaction T')
                ->innerJoin('envelope E', 'T.EnvelopeId = E.Id')
                ->where([
                    'E.IsDeleted' => 0,
                    'E.IsClosed' => 0,
                    'T.IsDeleted' => 0,
                    'E.AccountId' => $accountId
                ])
                ->groupBy('T.Name')
                ->having(['>', 'COUNT(T.Name)', '1'])
                ->orderBy('T.Name')
                ->limit(20);

        $query->andWhere(['!=', 'T.Pending', 0]);

        return $query->all();
    }

    public function findForBulkPending($accountId, $column, $value) {
        $envelopeIds = EnvelopeSearch::GetEnvelopeIdsByAccount($accountId);
        $query = Transaction::find();

        $query->where([
                    'IsDeleted' => 0,
                    'EnvelopeId' => $envelopeIds,
                    $column => $value
                ])
                ->limit(20);

        $query->andWhere(['!=', 'Pending', 0]);

        return $query->all();
    }
    
    public function findByEnvelope($envelopeId) {
        $query = Transaction::find();
        
        $query->where(['EnvelopeId' => $envelopeId, 'IsDeleted' => 0]);

        return $query->all();
    }
}
