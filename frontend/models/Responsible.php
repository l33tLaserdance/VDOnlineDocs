<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "responsible".
 *
 * @property int $resp_id
 * @property string $resp_FIO
 * @property string $resp_phone
 * @property string $resp_email
 *
 * @property RespOrg[] $respOrgs
 */
class Responsible extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'responsible';
    }
	
	public function getRespOrg()
    {
        return $this->hasMany(RespOrg::classname(), ['resp_id' => 'resp_id']);
            //->viaTable('resp_org', ['resp_id' => 'resp_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resp_FIO'], 'string', 'max' => 100],
            [['resp_phone'], 'string', 'max' => 30],
            [['resp_email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'resp_id' => 'ID',
            'resp_FIO' => 'ФИО',
            'resp_phone' => 'Контактный телефон',
            'resp_email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespOrgs()
    {
        return $this->hasMany(RespOrg::className(), ['resp_id' => 'resp_id']);
    }
}
