<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ups_manufacturers".
 *
 * @property int $id_man
 * @property string $upsman_name
 *
 * @property UpsModels[] $upsModels
 */
class UpsManufacturers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ups_manufacturers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['upsman_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_man' => 'ID',
            'upsman_name' => 'Наименование производителя',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpsModels()
    {
        return $this->hasMany(UpsModels::className(), ['manufacturer' => 'id_man']);
    }
}
