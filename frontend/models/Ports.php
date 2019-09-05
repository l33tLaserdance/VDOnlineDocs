<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ports".
 *
 * @property int $id_port
 * @property string $amount
 */
class Ports extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ports';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			['amount', 'required', 'whenClient' => "function (attribute, value) {
					if ($('#devices-device_type').val() == 2) {
						return $('#devices-device_type').val() == 2;
					}
					if ($('#devices-device_type').val() == 3) {
						return $('#devices-device_type').val() == 3;
					}
					if ($('#devices-device_type').val() == 4) {
						return $('#devices-device_type').val() == 4;
					}
				}"
			],
            [['amount'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_port' => 'Id Port',
            'amount' => 'Amount',
        ];
    }
}
