<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resp_org".
 *
 * @property int $id
 * @property int $resp_id
 *
 * @property Organization $id0
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
            [['id', 'resp_id'], 'integer'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['id' => 'id']],
            [['resp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Responsible::className(), 'targetAttribute' => ['resp_id' => 'resp_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Org ID',
            'resp_id' => 'Resp ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrgId()
    {
        return $this->hasOne(Organization::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespId()
    {
        return $this->hasOne(Responsible::className(), ['resp_id' => 'resp_id']);
    }
}
