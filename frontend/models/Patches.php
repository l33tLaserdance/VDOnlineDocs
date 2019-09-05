<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "patches".
 *
 * @property int $id_patches
 * @property int $patches_type
 * @property int $ports
 *
 * @property PatchTypes $patchesType
 */
class Patches extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['patches_type', 'ports'], 'integer'],
            [['patches_type'], 'exist', 'skipOnError' => true, 'targetClass' => PatchTypes::className(), 'targetAttribute' => ['patches_type' => 'ptype_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_patches' => 'ID',
            'patches_type' => 'Тип патч-панели',
            'ports' => 'Количество портов',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatchesType()
    {
        return $this->hasOne(PatchTypes::className(), ['ptype_id' => 'patches_type']);
    }
}
