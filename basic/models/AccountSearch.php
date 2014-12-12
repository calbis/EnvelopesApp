<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Account;

/**
 * AccountSearch represents the model behind the search form about `app\models\Account`.
 */
class AccountSearch extends Account
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'IsCash', 'IsClosed', 'CreatedBy', 'ModifiedBy', 'IsDeleted'], 'integer'],
            [['Name', 'Color', 'CreatedOn', 'ModifiedOn'], 'safe'],
            [['ExternalTotal'], 'number'],
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
        $query = Account::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Id' => $this->Id,
            'IsCash' => $this->IsCash,
            'IsClosed' => $this->IsClosed,
            'CreatedOn' => $this->CreatedOn,
            'CreatedBy' => $this->CreatedBy,
            'ModifiedOn' => $this->ModifiedOn,
            'ModifiedBy' => $this->ModifiedBy,
            'IsDeleted' => $this->IsDeleted,
            'ExternalTotal' => $this->ExternalTotal,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'Color', $this->Color]);

        return $dataProvider;
    }

    public function findForDDL() {
        $query = Account::find();
        
        $accounts = $query->select('Id, Name')
                ->where([
                    'IsDeleted' => 0,
                    'IsClosed' => 0,
                ])
                ->limit(100)
                ->all();

        return $accounts;
    }
}
