<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "object".
 *
 * @property int $obj_id
 * @property int $org_id
 * @property string $address
 * @property string $obj_name
 * @property string $Comment
 *
 * @property Cases[] $cases
 * @property Organization $org
 */
class Objects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['org_id'], 'integer'],
            [['Comment'], 'string'],
            [['address', 'obj_name', 'photo', 'map'], 'string', 'max' => 100],
            [['org_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['org_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'obj_id' => '№',
            'org_id' => 'Организация',
            'address' => 'Адрес',
            'obj_name' => 'Название объекта',
            'Comment' => 'Комментарий',
			'photo' => 'Фотография',
			'map' => 'Карта',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCases()
    {
        return $this->hasMany(Cases::className(), ['obj_id' => 'obj_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrg()
    {
        return $this->hasOne(Organization::className(), ['id' => 'org_id']);
    }
}
