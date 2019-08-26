<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "organization".
 *
 * @property int $id
 * @property string $org_name
 * @property string $org_full_name
 * @property string $INN
 * @property string $Comment
 *
 * @property Contacts[] $contacts
 * @property Object[] $objects
 */
class Organization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organization';
    }
	
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Comment'], 'string'],
            [['org_name', 'org_full_name', 'org_address', 'photo'], 'string', 'max' => 100],
            [['INN'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'org_name' => 'Краткое наименование',
            'org_full_name' => 'Наименование организации',
            'INN' => 'ИНН',
			'org_address' => 'Адрес организации',
            'Comment' => 'Комментарий',
			'photo' => 'Фотография',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespOrg()
    {
        return $this->hasMany(RespOrg::className(), ['org_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Object::className(), ['org_id' => 'id']);
    }
}
