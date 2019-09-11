<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "patch_types".
 *
 * @property int $ptype_id
 * @property string $type
 *
 * @property Patches[] $patches
 */
class PatchTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patch_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			['type', 'required', 'whenClient' => "function (attribute, value) {
					if ($('#PP').val() == ' Другое') {
						return $('#PP').val() == ' Другое';
					}
					if ($('#PP').val() == 'Другое') {
						return $('#PP').val() == 'Другое';
					}
				}"
			],
			['type', 'unique', 'whenClient' => "function (attribute, value) {
					if ($('#PP').val() == ' Другое') {
						return $('#PP').val() == ' Другое';
					}
					if ($('#PP').val() == 'Другое') {
						return $('#PP').val() == 'Другое';
					}
				}", 'message' => 'Данный тип патч-панели уже существует.'
			],
            [['type'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ptype_id' => 'ID',
            'type' => 'Тип',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatches()
    {
        return $this->hasMany(Patches::className(), ['patches_type' => 'ptype_id']);
    }
}
