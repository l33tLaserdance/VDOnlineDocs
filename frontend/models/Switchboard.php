<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "switchboard".
 *
 * @property int $switch_id
 * @property int $device_id
 * @property string $switch_name
 * @property string $switch_model
 * @property string $switch_ip
 * @property int $port
 * @property string $connected_to
 * @property string $model_connected_to
 * @property string $ip_connected_to
 * @property string $Comment
 *
 * @property Devices $device
 */
class Switchboard extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'switchboard';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['device_id', 'port', 'functional'], 'integer'],
            [['Comment'], 'string'],
            [['switch_name', 'switch_model', 'switch_ip', 'model_connected_to', 'ip_connected_to'], 'string', 'max' => 45],
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
            'switch_id' => 'ID записи',
            'device_id' => 'ID устройства',
            'switch_name' => 'Наименование коммутатора',
            'switch_model' => 'Модель коммутатора',
            'switch_ip' => 'IP коммутатора',
            'port' => 'Порт',
            'connected_to' => 'Куда подключён',
            'model_connected_to' => 'Модель подключенного устр-ва',
            'ip_connected_to' => 'IP подключения',
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
