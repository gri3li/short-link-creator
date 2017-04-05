<?php

namespace app\controllers;

use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Link;
use app\models\Statistic;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function actionIndex()
    {
        $model = new Link();
        $result = null;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->saveEndData = (int)Yii::$app->request->post($model->formName())['saveEndData'];
            if (!$model->save()) {
                throw new Exception();
            }
            $result = $model;
        }

        return $this->render('index', [
            'model'  => $model,
            'result' => $result,
        ]);
    }


    public function actionRedirect($linkId)
    {
        $model = Link::find()
            ->where('`id` = :id AND (`end_date`  IS NULL OR `end_date` > UNIX_TIMESTAMP())', [':id' => $linkId])
            ->one();

        if (!$model) {
            throw new NotFoundHttpException();
        }

        $ip = Yii::$app->request->userIP == '::1' ? '178.22.148.122' : Yii::$app->request->userIP; // для тестирования на локалхосте
        $city = Yii::$app->sypexGeo->getCity($ip);

        (new Statistic([
            'link_id'   => $model->id,
            'useragent' => Yii::$app->request->userAgent,
            'city'      => ArrayHelper::getValue($city, 'city.name_en'),
            'country'   => ArrayHelper::getValue($city, 'country.iso'),
        ]))->save();

        return $this->redirect($model->link);
    }

    public function actionStatistic($statisticUrl)
    {
        $model = Link::find()->where(['statistic_url' => $statisticUrl])->one();

        if (!$model) {
            throw new NotFoundHttpException();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $model->getStatistics(),
        ]);

        return $this->render('statistic', [
            'model'        => $model,
            'dataProvider' => $dataProvider,
        ]);
    }
}
