<?php

namespace app\models;

use yii\db\ActiveRecord;

class Account extends ActiveRecord {

    public function getVwAccountSum() {
        return $this->hasOne(VwAccountSum::className(), ['AccountId' => 'Id']);
    }
}
