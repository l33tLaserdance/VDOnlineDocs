<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "devices".
 *
 * @property int $device_id
 * @property int $case_id
 * @property string $device_type
 * @property string $device_name
 * @property string $device_link
 * @property int $port
 * @property string $Comment
 *
 * @property Cases $case
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
            [['case_id', 'port'], 'integer'],
            [['Comment'], 'string'],
            [['device_type', 'device_name'], 'string', 'max' => 45],
            [['device_link'], 'string', 'max' => 100],
            [['case_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cases::className(), 'targetAttribute' => ['case_id' => 'case_id']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCase()
    {
        return $this->hasOne(Cases::className(), ['case_id' => 'case_id']);
    }
}
