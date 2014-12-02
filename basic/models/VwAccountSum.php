<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_account_sum".
 *
 * @property integer $AccountId
 * @property string $AccountSum
 * @property string $AccountPending
 */
class VwAccountSum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_account_sum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AccountId'], 'integer'],
            [['AccountSum', 'AccountPending'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AccountId' => 'Account ID',
            'AccountSum' => 'Account Sum',
            'AccountPending' => 'Account Pending',
        ];
    }

    public function getAccount() {
        return $this->belongsTo(Account::className(), ['Id' => 'AccountId']);
    }
}

