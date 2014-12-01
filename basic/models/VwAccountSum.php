<?php

namespace app\models;

use yii\db\ActiveRecord;

class VwAccountSum extends ActiveRecord {

    public function getAccount() {
        return $this->belongsTo(Account::className(), ['Id' => 'AccountId']);
    }
}

