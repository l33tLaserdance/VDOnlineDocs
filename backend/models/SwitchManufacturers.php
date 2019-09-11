<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "switch_manufacturers".
 *
 * @property int $id_swman
 * @property string $swman_name
 *
 * @property SwitchModels[] $switchModels
 */
class SwitchManufacturers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'switch_manufacturers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['swman_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_swman' => 'ID',
            'swman_name' => 'Производитель',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSwitchModels()
    {
        return $this->hasMany(SwitchModels::className(), ['manufacturer' => 'id_swman']);
    }
}
