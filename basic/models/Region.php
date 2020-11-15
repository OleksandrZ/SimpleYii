<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property int $Id
 * @property string $Name
 * @property int $CountryId
 *
 * @property City[] $cities
 * @property Country $country
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name', 'CountryId'], 'required'],
            [['CountryId'], 'integer'],
            [['Name'], 'string', 'max' => 50],
            [['CountryId'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['CountryId' => 'Id']],
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
            'CountryId' => 'Country ID',
        ];
    }

    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['RegionId' => 'Id']);
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['Id' => 'CountryId']);
    }
}
