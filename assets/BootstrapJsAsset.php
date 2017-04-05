<?php

namespace app\assets;

use yii\web\AssetBundle;

class BootstrapJsAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap/dist/js';

    public $js = [
        'bootstrap.js',
    ];
}
