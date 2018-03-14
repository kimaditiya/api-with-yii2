<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property string $id
 * @property string $provinsi
 * @property string $kabupaten
 * @property string $kodepos
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provinsi', 'kabupaten'], 'string', 'max' => 225],
            [['kodepos'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provinsi' => 'Provinsi',
            'kabupaten' => 'Kabupaten',
            'kodepos' => 'Kodepos',
        ];
    }
}
