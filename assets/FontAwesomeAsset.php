<?php

namespace app\assets;

use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{
    // dirty dirty bug!!!!!!!
    public $sourcePath = '@bower/fontawesome';
    public $css = [
        'css/font-awesome.css',
    ];
    public $publishOptions = [
        'only' => [
            'fonts/',
            'css/',
        ]
    ];
}