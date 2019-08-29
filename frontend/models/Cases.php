<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cases".
 *
 * @property int $case_id
 * @property int $obj_id
 * @property int $case_num
 * @property string $build_num
 * @property string $comm_name
 * @property string $case_name
 * @property string $switch_ip
 * @property string $placement
 * @property string $expulsion
 * @property string $links
 * @property int $order
 * @property string $photo
 * @property string $Comment
 *
 * @property Objects $obj
 * @property Devices[] $devices
 */
class Cases extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $file;
	 
    public static function tableName()
    {
        return 'cases';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['case_id', 'obj_id', 'case_num', 'order'], 'integer'],
            [['expulsion'], 'safe'],
            [['Comment'], 'string'],
			[['file'], 'file'],
            [['build_num', 'comm_name', 'case_name', 'switch_ip', 'links', 'expulsion'], 'string', 'max' => 45],
            [['placement', 'photo'], 'string', 'max' => 100],
            [['obj_id'], 'exist', 'skipOnError' => true, 'targetClass' => Objects::className(), 'targetAttribute' => ['obj_id' => 'obj_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'case_id' => 'ID шкафа',
            'obj_id' => 'ID объекта',
            'case_num' => '№ Шкафа',
            'build_num' => '№ Стр.',
            'comm_name' => 'Альт. название (по коммутатору)',
            'case_name' => 'Назв. шкафа (шифр с привязкой к стр. и этажу)',
            'switch_ip' => 'IP',
            'placement' => 'Расположение',
            'expulsion' => 'Продувка',
            'links' => 'Линки',
            'order' => 'Порядок',
			'file' => 'Фотография',
            'photo' => 'Фото',
            'Comment' => 'Комментарий',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObj()
    {
        return $this->hasOne(Objects::className(), ['obj_id' => 'obj_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevices()
    {
        return $this->hasMany(Devices::className(), ['case_id' => 'case_id']);
    }
}
