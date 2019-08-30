<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "resp_org".
 *
 * @property int $id
 * @property int $org_id
 * @property int $resp_id
 *
 * @property Organization $org
 * @property Responsible $resp
 */
class RespOrg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resp_org';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'org_id', 'resp_id'], 'integer'],
            [['org_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['org_id' => 'id']],
            [['resp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Responsible::className(), 'targetAttribute' => ['resp_id' => 'resp_id']],
			[['org_id'], 'required', 'message' => 'Выберите организацию'],
			[['resp_id'], 'required', 'message' => 'Выберите ответственного'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID записи',
            'org_id' => 'Организация',
            'resp_id' => 'Ответственный',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrg()
    {
        return $this->hasOne(Organization::className(), ['id' => 'org_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResp()
    {
        return $this->hasOne(Responsible::className(), ['resp_id' => 'resp_id']);
    }
}
