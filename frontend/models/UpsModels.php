<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ups_models".
 *
 * @property int $id_upsmod
 * @property int $manufacturer
 * @property string $model
 *
 * @property UpsManufacturers $manufacturer
 */
class UpsModels extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ups_models';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['manufacturer', 'required', 'whenClient' => "function (attribute, value) {
					if ($('#UPS').val() == ' Другое') {
						return $('#UPS').val() == ' Другое';
					}
					if ($('#UPS').val() == 'Другое') {
						return $('#UPS').val() == 'Другое';
					}
				}"
			],
			['model', 'required', 'whenClient' => "function (attribute, value) {
					if ($('#UPS').val() == ' Другое') {
						return $('#UPS').val() == ' Другое';
					}
					if ($('#UPS').val() == 'Другое') {
						return $('#UPS').val() == 'Другое';
					}
				}"
			],
            [['model'], 'string', 'max' => 50],
			[['manufacturer'], 'integer'],
            [['manufacturer'], 'exist', 'skipOnError' => true, 'targetClass' => UpsManufacturers::className(), 'targetAttribute' => ['manufacturer' => 'id_man']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_upsmod' => 'ID',
            'manufacturer' => 'Производитель',
			'manufacturer0.upsman_name' => 'Производитель',
            'model' => 'Модель',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer0()
    {
        return $this->hasOne(UpsManufacturers::className(), ['id_man' => 'manufacturer']);
    }
}
