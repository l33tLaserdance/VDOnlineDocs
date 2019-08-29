<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "device_types".
 *
 * @property int $dt_id
 * @property string $dt_name
 *
 * @property Devices[] $devices
 */
class DeviceTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'device_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dt_id'], 'required'],
            [['dt_id'], 'integer'],
            [['dt_name'], 'string', 'max' => 45],
            [['dt_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dt_id' => 'Dt ID',
            'dt_name' => 'Dt Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevices()
    {
        return $this->hasMany(Devices::className(), ['device_type' => 'dt_id']);
    }
}
