<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $Id
 * @property string $Name
 * @property int $RegionId
 *
 * @property Region $region
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name', 'RegionId'], 'required'],
            [['RegionId'], 'integer'],
            [['Name'], 'string', 'max' => 50],
            [['RegionId'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['RegionId' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Name' => 'Name',
            'RegionId' => 'Region ID',
        ];
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['Id' => 'RegionId']);
    }
}
