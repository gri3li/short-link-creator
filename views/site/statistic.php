<?php

/* @var $this yii\web\View */
/* @var $model \app\models\Link */
/* @var $dataProvider \yii\data\ArrayDataProvider */

$this->title = 'Статистика переходов';

?>
<div class="site-statistic">
    <div class="row">
        <div class="col-lg-12">
            <?= \yii\helpers\Html::a('На гллавную', \yii\helpers\Url::home(), ['class' => 'pull-right']) ?>
            <h1><?= yii\helpers\Html::encode($this->title) ?></h1>
            <dl class="dl-horizontal bg-info">
                <dt>Ссылка</dt>
                <dd><?= $model->link ?></dd>
                <dt>Короткая ссылка</dt>
                <dd><?= \yii\helpers\Html::a($model->getShortLink(), $model->getShortLink()) ?></dd>
                <?php if ($model->end_date) : ?>
                    <dt>Актуальна до</dt>
                    <dd><?= \Yii::$app->formatter->asDatetime($model->end_date) ?></dd>
                <?php endif ?>
            </dl>
        </div>
        <div class="col-lg-12">
            <?= yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'columns'      => [
                    'created_at:datetime',
                    'useragent',
                    'country',
                    'city',
                ],
            ]) ?>
        </div>
    </div>
</div>
