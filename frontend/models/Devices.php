<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "devices".
 *
 * @property int $device_id
 * @property int $case_id
 * @property int $device_type
 * @property string $device_name
 * @property string $device_link
 * @property int $port
 * @property string $Comment
 *
 * @property Cases $case
 * @property DeviceTypes $deviceType
 */
class Devices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'devices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['case_id', 'device_type', 'port'], 'integer'],
            [['Comment'], 'string'],
            [['device_name', 'device_switchn', 'device_ip'], 'string', 'max' => 45],
            [['device_link'], 'string', 'max' => 200],
            [['case_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cases::className(), 'targetAttribute' => ['case_id' => 'case_id']],
            [['device_type'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceTypes::className(), 'targetAttribute' => ['device_type' => 'dt_id']],
			[['device_type'], 'required', 'message' => 'Устройство не выбрано.'],
			[['device_name'], 'required', 'message' => 'Наименование не указано.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'device_id' => 'ID',
            'case_id' => 'ID шкафа',
            'device_type' => 'Тип устройства',
            'device_name' => 'Наименование устройства',
            'device_link' => 'Информация о устройстве',
            'port' => 'Количество портов',
            'Comment' => 'Комментарий',
			'device_switchn' => 'Название коммутатора',
			'device_ip' => 'IP адрес коммутатора',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCase()
    {
        return $this->hasOne(Cases::className(), ['case_id' => 'case_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceType()
    {
        return $this->hasOne(DeviceTypes::className(), ['dt_id' => 'device_type']);
    }
}
