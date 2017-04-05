<?php

/* @var $this yii\web\View */
/* @var $model \app\models\Link */
/* @var $result \app\models\Link */

$this->title = 'Сокращатель ссылок';

$this->registerJsFile('/js/main.js', ['depends' => [\app\assets\DateTimePickerAsset::className()]])

?>
<div class="site-index">

    <div class="jumbotron">
        <h2>Сокращатель ссылок</h2>

        <?php if ($result) : ?>
            <dl class="dl-horizontal bg-info">
                <dt>Ссылка</dt>
                <dd><?= $result->link ?></dd>
                <dt>Короткая ссылка</dt>
                <dd><?= \yii\helpers\Html::a($result->getShortLink(), $result->getShortLink()) ?></dd>
                <dt>Статистика</dt>
                <dd><?= \yii\helpers\Html::a($result->getStatisticLink(), $result->getStatisticLink()) ?></dd>
                    <?php if ($result->saveEndData) : ?>
                         <dt>Актуальна до</dt>
                         <dd><?= \Yii::$app->formatter->asDatetime($result->end_date) ?></dd>
                    <?php endif ?>
            </dl>
        <?php endif ?>
        <br>

        <?php \yii\widgets\ActiveForm::begin() ?>

        <div class="input-group">
            <?= \yii\helpers\Html::activeTextInput($model, 'link', [
                'autofocus'   => true,
                'placeholder' => 'Ссылка',
                'class'       => 'form-control input-lg',
            ]) ?>
              <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary btn-lg">Сократить</button>
              </span>
        </div>
        <?= \yii\helpers\Html::error($model, 'link') ?>
        <div class="pull-left">
            <?= \yii\helpers\Html::activeCheckbox($model, 'saveEndData', [
                'id'    => 'ttl',
                'label' => 'Ограничить срок жизни',
            ]) ?>
        </div>

        <div id="picker-wrap" class="form-group" style="display: <?= $model->saveEndData ? 'block' : 'none' ?>">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div id="picker"></div>
                </div>
            </div>
        </div>

        <?= \yii\helpers\Html::activeHiddenInput($model, 'end_date', ['id' => 'ttl-input']) ?>

        <?php \yii\widgets\ActiveForm::end() ?>
    </div>

</div>
