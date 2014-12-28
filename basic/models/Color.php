<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "color".
 *
 * @property string $Id
 * @property string $Name
 */
class Color extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'color';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'Name'], 'required'],
            [['Id', 'Name'], 'string', 'max' => 20],
            [['Id', 'Name'], 'unique', 'targetAttribute' => ['Id', 'Name'], 'message' => 'The combination of ID and Name has already been taken.']
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
        ];
    }
}