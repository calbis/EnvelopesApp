<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "envelope".
 *
 * @property integer $Id
 * @property integer $AccountId
 * @property string $Name
 * @property string $Color
 * @property string $CalculationType
 * @property integer $CalculationAmount
 * @property integer $IsClosed
 * @property string $CreatedOn
 * @property integer $CreatedBy
 * @property string $ModifiedOn
 * @property integer $ModifiedBy
 * @property integer $IsDeleted
 *
 * @property Account $account
 * @property User $createdBy
 * @property User $modifiedBy
 * @property FilterEnvelope[] $filterEnvelopes
 * @property Transaction[] $transactions
 */
class Envelope extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'envelope';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AccountId', 'Name', 'CalculationType', 'CreatedOn', 'CreatedBy', 'ModifiedOn', 'ModifiedBy'], 'required'],
            [['AccountId', 'CalculationAmount', 'IsClosed', 'CreatedBy', 'ModifiedBy', 'IsDeleted'], 'integer'],
            [['CreatedOn', 'ModifiedOn'], 'safe'],
            [['Name'], 'string', 'max' => 255],
            [['Color'], 'string', 'max' => 100],
            [['CalculationType'], 'string', 'max' => 3]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'AccountId' => 'Account ID',
            'Name' => 'Name',
            'Color' => 'Color',
            'CalculationType' => 'Calculation Type',
            'CalculationAmount' => 'Calculation Amount',
            'IsClosed' => 'Is Closed',
            'CreatedOn' => 'Created On',
            'CreatedBy' => 'Created By',
            'ModifiedOn' => 'Modified On',
            'ModifiedBy' => 'Modified By',
            'IsDeleted' => 'Is Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['Id' => 'AccountId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['Id' => 'CreatedBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModifiedBy()
    {
        return $this->hasOne(User::className(), ['Id' => 'ModifiedBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilterEnvelopes()
    {
        return $this->hasMany(FilterEnvelope::className(), ['EnvelopeId' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['EnvelopeId' => 'Id']);
    }
}