<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_envelope_sum".
 *
 * @property integer $EnvelopeId
 * @property string $EnvelopeSum
 * @property string $EnvelopePending
 * @property string $StatsCost
 * @property string $TimeLeft
 * @property string $GoalDeposit
 */
class VwEnvelopeSum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_envelope_sum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EnvelopeId'], 'integer'],
            [['EnvelopeSum', 'EnvelopePending', 'StatsCost', 'TimeLeft', 'GoalDeposit'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EnvelopeId' => 'Envelope ID',
            'EnvelopeSum' => 'Envelope Sum',
            'EnvelopePending' => 'Envelope Pending',
            'StatsCost' => 'Stats Cost',
            'TimeLeft' => 'Time Left',
            'GoalDeposit' => 'Goal Deposit',
        ];
    }

    public function getEnvelope() {
        return $this->belongsTo(Envelope::className(), ['Id' => 'EnvelopeId']);
    }
}