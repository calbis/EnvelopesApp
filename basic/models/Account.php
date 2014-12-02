<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property integer $Id
 * @property string $Name
 * @property string $Color
 * @property integer $IsCash
 * @property integer $IsClosed
 * @property string $CreatedOn
 * @property integer $CreatedBy
 * @property string $ModifiedOn
 * @property integer $ModifiedBy
 * @property integer $IsDeleted
 * @property string $ExternalTotal
 *
 * @property User $createdBy
 * @property User $modifiedBy
 * @property Envelope[] $envelopes
 * @property UserAccount[] $userAccounts
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'Color', 'IsClosed', 'CreatedOn', 'CreatedBy', 'ModifiedOn', 'ModifiedBy'], 'required'],
            [['IsCash', 'IsClosed', 'CreatedBy', 'ModifiedBy', 'IsDeleted'], 'integer'],
            [['CreatedOn', 'ModifiedOn'], 'safe'],
            [['ExternalTotal'], 'number'],
            [['Name'], 'string', 'max' => 255],
            [['Color'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Name' => 'Name',
            'Color' => 'Color',
            'IsCash' => 'Is Cash',
            'IsClosed' => 'Is Closed',
            'CreatedOn' => 'Created On',
            'CreatedBy' => 'Created By',
            'ModifiedOn' => 'Modified On',
            'ModifiedBy' => 'Modified By',
            'IsDeleted' => 'Is Deleted',
            'ExternalTotal' => 'External Total',
        ];
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
    public function getEnvelopes()
    {
        return $this->hasMany(Envelope::className(), ['AccountId' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAccounts()
    {
        return $this->hasMany(UserAccount::className(), ['AccountId' => 'Id']);
    }

    public function getVwAccountSum() {
        return $this->hasOne(VwAccountSum::className(), ['AccountId' => 'Id']);
    }
}
