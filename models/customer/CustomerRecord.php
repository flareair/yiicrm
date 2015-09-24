<?php

namespace app\models\customer;
use yii\db\ActiveRecord;

class CustomerRecord extends ActiveRecord
{
    public static function tableName()
    {
        return 'customer';
    }

    public function rules()
    {
        return [
            ['id', 'number'],
            ['name', 'required'],
            ['name', 'unique'],
            ['name', 'string', 'max' => 256],
            ['birth_date', 'date', 'format' => 'y-m-d'],
            ['notes', 'safe']
        ];
    }
}