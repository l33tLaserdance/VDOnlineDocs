<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "patch_panel".
 *
 * @property int $patch_id
 * @property int $device_id
 * @property string $patch_name
 * @property string $model
 * @property string $ip
 * @property int $ports
 * @property string $Comment
 *
 * @property Devices $device
 */
class PatchPanel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patch_panel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['patch_id', 'device_id', 'ports', 'functional'], 'integer'],
            [['Comment'], 'string'],
            [['patch_name', 'model', 'ip'], 'string', 'max' => 45],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Devices::className(), 'targetAttribute' => ['device_id' => 'device_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'patch_id' => 'ID записи',
            'device_id' => 'ID устройства',
            'patch_name' => 'Наименование панели',
            'model' => 'Устройство',
            'ip' => 'IP-адрес',
            'ports' => 'Порт',
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
