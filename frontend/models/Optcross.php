<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "optcross".
 *
 * @property int $optcross_id
 * @property int $device_id
 * @property string $optcross_name
 * @property int $port
 * @property string $uplink
 * @property string $connected_to
 * @property string $Comment
 *
 * @property Devices $device
 */
class Optcross extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'optcross';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['optcross_id', 'device_id', 'port', 'functional'], 'integer'],
            [['Comment'], 'string'],
            [['optcross_name', 'uplink'], 'string', 'max' => 45],
            [['connected_to'], 'string', 'max' => 100],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Devices::className(), 'targetAttribute' => ['device_id' => 'device_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'optcross_id' => 'ID порта',
            'device_id' => 'ID устройства',
            'optcross_name' => 'Наименование',
            'port' => 'Порт',
            'uplink' => 'Uplink',
            'connected_to' => 'Куда подключен',
            'Comment' => 'Комментарий',
			'functional' => 'Функционирует',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(Devices::className(), ['device_id' => 'device_id']);
    }
}
