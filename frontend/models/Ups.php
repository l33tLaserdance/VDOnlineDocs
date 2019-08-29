<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ups".
 *
 * @property int $ups_id
 * @property int $device_id
 * @property string $ups_model
 * @property string $max_time
 * @property string $battery_exchange
 * @property string $Comment
 * @property string $upscol
 *
 * @property Devices $device
 */
class Ups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['device_id'], 'integer'],
            //[['battery_exchange'], 'safe'],
            [['Comment'], 'string'],
            [['ups_model'], 'string', 'max' => 100],
            [['max_time', 'upscol', 'battery_exchange'], 'string', 'max' => 45],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Devices::className(), 'targetAttribute' => ['device_id' => 'device_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ups_id' => 'ID ИБП',
            'device_id' => 'ID как устройства',
            'ups_model' => 'Модель ИБП',
            'max_time' => 'Работа от аккумулятора',
            'battery_exchange' => 'Дата замены аккумулятора',
            'Comment' => 'Комментарий',
            'upscol' => 'Что за колонка?',
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
