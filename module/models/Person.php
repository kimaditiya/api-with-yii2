<?php

namespace app\models;

use Yii;
use app\models\Address;

/**
 * This is the model class for table "person".
 *
 * @property string $id
 * @property string $nama
 * @property string $address_id
 * @property string $jenis_kelamin
 * @property string $tanggal_lahir
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address_id'], 'integer'],
            [['tanggal_lahir'], 'safe'],
            [['nama'], 'string', 'max' => 225],
            [['jenis_kelamin'], 'string', 'max' => 20],
        ];
    }

    /**
    * relation table Address
    **/
    public function getAdressTbl(){
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }

    public function extraFields()
    {
        return ['adressTbl'];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'address_id' => 'Address ID',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tanggal_lahir' => 'Tanggal Lahir',
        ];
    }
}
