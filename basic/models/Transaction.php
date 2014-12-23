<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $Id
 * @property integer $EnvelopeId
 * @property string $Name
 * @property string $PostedDate
 * @property string $Amount
 * @property string $Pending
 * @property integer $UseInStats
 * @property integer $IsRefund
 * @property string $CreatedOn
 * @property integer $CreatedBy
 * @property string $ModifiedOn
 * @property integer $ModifiedBy
 * @property integer $IsDeleted
 *
 * @property Label[] $labels
 * @property User $createdBy
 * @property Envelope $envelope
 * @property User $modifiedBy
 */
class Transaction extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'transaction';
    }

    public function init() {
        parent::init();

        $currDate = date('Y-m-d H:i:s');

        $this->CreatedOn = $currDate;
        $this->ModifiedOn = $currDate;
        $this->IsDeleted = 0;
        $this->IsRefund = 0;
        $this->UseInStats = 1;        
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['EnvelopeId', 'Name', 'PostedDate', 'CreatedOn', 'CreatedBy', 'ModifiedOn', 'ModifiedBy'], 'required'],
            [['EnvelopeId', 'UseInStats', 'IsRefund', 'CreatedBy', 'ModifiedBy', 'IsDeleted'], 'integer'],
            [['PostedDate', 'CreatedOn', 'ModifiedOn'], 'safe'],
            [['Amount', 'Pending'], 'number'],
            [['Name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'Id' => 'ID',
            'EnvelopeId' => 'Envelope ID',
            'Name' => 'Name',
            'PostedDate' => 'Posted Date',
            'Amount' => 'Amount',
            'Pending' => 'Pending',
            'UseInStats' => 'Use In Stats',
            'IsRefund' => 'Is Refund',
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
    public function getLabels() {
        return $this->hasMany(Label::className(), ['TransactionId' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy() {
        return $this->hasOne(User::className(), ['Id' => 'CreatedBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnvelope() {
        return $this->hasOne(Envelope::className(), ['Id' => 'EnvelopeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModifiedBy() {
        return $this->hasOne(User::className(), ['Id' => 'ModifiedBy']);
    }

}
