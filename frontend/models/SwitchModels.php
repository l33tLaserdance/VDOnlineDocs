<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "switch_models".
 *
 * @property int $id_switchmod
 * @property int $manufacturer
 * @property string $model
 * @property int $ports
 * @property string $PoE
 *
 * @property SwitchManufacturers $manufacturer0
 */
class SwitchModels extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'switch_models';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['manufacturer', 'ports'], 'integer'],
            [['model'], 'string', 'max' => 50],
			['manufacturer', 'required', 'whenClient' => "function (attribute, value) {
					if ($('#SW').val() == ' \"Другое\"') {
						return $('#SW').val() == ' \"Другое\"';
					}
					if ($('#SW').val() == '\"Другое\"') {
						return $('#SW').val() == '\"Другое\"';
					}
					if ($('#SW').val() == 'Другое') {
						return $('#SW').val() == 'Другое';
					}
				}"
			],
			['model', 'required', 'whenClient' => "function (attribute, value) {
					if ($('#SW').val() == ' \"Другое\"') {
						return $('#SW').val() == ' \"Другое\"';
					}
					if ($('#SW').val() == '\"Другое\"') {
						return $('#SW').val() == '\"Другое\"';
					}
					if ($('#SW').val() == 'Другое') {
						return $('#SW').val() == 'Другое';
					}
				}"
			],
			[['model'], 'unique', 'message' => 'Такая модель уже существует'],
            ['PoE', 'string', 'max' => 5, 'whenClient' => "function (attribute, value) {
					if ($('#SW').val() == ' \"Другое\"') {
						return $('#SW').val() == ' \"Другое\"';
					}
					if ($('#SW').val() == '\"Другое\"') {
						return $('#SW').val() == '\"Другое\"';
					}
					if ($('#SW').val() == 'Другое') {
						return $('#SW').val() == 'Другое';
					}
				}"
			],
			['control', 'string', 'max' => 5, 'whenClient' => "function (attribute, value) {
					if ($('#SW').val() == ' \"Другое\"') {
						return $('#SW').val() == ' \"Другое\"';
					}
					if ($('#SW').val() == '\"Другое\"') {
						return $('#SW').val() == '\"Другое\"';
					}
					if ($('#SW').val() == 'Другое') {
						return $('#SW').val() == 'Другое';
					}
				}"
			],
            [['manufacturer'], 'exist', 'skipOnError' => true, 'targetClass' => SwitchManufacturers::className(), 'targetAttribute' => ['manufacturer' => 'id_swman']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_switchmod' => 'ID',
            'manufacturer' => 'Производитель',
            'model' => 'Модель',
            'ports' => 'Количество портов',
            'PoE' => 'PoE',
			'control' => 'Управление',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer0()
    {
        return $this->hasOne(SwitchManufacturers::className(), ['id_swman' => 'manufacturer']);
    }
}
