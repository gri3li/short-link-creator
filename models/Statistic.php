<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "statistic".
 *
 * @property int $id
 * @property string $link_id
 * @property int $created_at
 * @property string $useragent
 * @property string $city
 * @property string $country
 *
 * @property Link $link
 */
class Statistic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statistic';
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class'              => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => null,
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link_id'], 'required'],
            [['created_at'], 'integer'],
            [['link_id'], 'string', 'max' => 6],
            [['useragent', 'city', 'country'], 'string', 'max' => 255],
            [['link_id'], 'exist', 'skipOnError' => true, 'targetClass' => Link::className(), 'targetAttribute' => ['link_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'link_id'    => 'Link ID',
            'created_at' => 'Created At',
            'useragent'  => 'Useragent',
            'city'       => 'City',
            'country'    => 'Country',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLink()
    {
        return $this->hasOne(Link::className(), ['id' => 'link_id']);
    }
}
