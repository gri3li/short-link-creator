<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\helpers\Url;

/**
 * This is the model class for table "link".
 *
 * @property string $id
 * @property string $link
 * @property string $statistic_url
 * @property integer $end_date
 * @property boolean $saveEndData
 *
 * @property Statistic[] $statistics
 */
class Link extends \yii\db\ActiveRecord
{
    public $saveEndData = false;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['link', 'required'],
            ['link', 'url'],
            ['id', 'string', 'max' => 6],
            ['statistic_url', 'string'],
            ['link', 'string', 'max' => 255],
            ['end_date', 'integer'],
            ['saveEndData', 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'link'          => 'Link',
            'statistic_url' => 'Statistic Url',
            'end_date'      => 'End Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatistics()
    {
        return $this->hasMany(Statistic::className(), ['link_id' => 'id']);
    }

    private function random($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $count = 0;
        do {
            $this->id = $this->random(6);
            echo $count;

            if ($count > 100) {
                throw new Exception();
            }
            $count++;
        } while (Link::find()->where(['id' => $this->id])->exists());

        $count = 0;
        do {
            $this->statistic_url = $this->random(6);

            if ($count > 100) {
                throw new Exception();
            }
            $count++;
        } while (Link::find()->where(['statistic_url' => $this->statistic_url])->exists());


        if (!$this->saveEndData) {
            $this->end_date = null;
        }

        return true;
    }

    public function getShortLink()
    {
        return Url::base(true) . '/' . $this->id;
    }

    public function getStatisticLink()
    {
        return Url::base(true) . '/statistic/' . $this->statistic_url;
    }
}
