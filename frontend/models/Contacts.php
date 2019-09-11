<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Contacts".
 *
 * @property int $contact_id
 * @property int $org_id
 * @property string $FIO
 * @property string $Phone
 * @property string $Email
 * @property string $Positon
 * @property string $Comment
 *
 * @property Organization $org
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['org_id'], 'integer'],
            [['Comment'], 'string'],
            [['FIO', 'Positon'], 'string', 'max' => 100],
            [['Phone'], 'string', 'max' => 30],
			[['Phone'], 'match', 'pattern' => '/^\+7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/', 'message' => 'Телефон указан некорректно'],
            [['Email'], 'string', 'max' => 255],
			[['Email'], 'email', 'message' => 'Введите корректный email.'],
            [['org_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['org_id' => 'id']],
			[['org_id'], 'required', 'message' => 'Выберите организацию'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'contact_id' => 'ID контакта',
            'org_id' => 'Организация',
            'FIO' => 'ФИО',
            'Phone' => 'Телефон',
            'Email' => 'Email',
            'Positon' => 'Должность',
            'Comment' => 'Комментарий',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrg()
    {
        return $this->hasOne(Organization::className(), ['id' => 'org_id']);
    }
}
