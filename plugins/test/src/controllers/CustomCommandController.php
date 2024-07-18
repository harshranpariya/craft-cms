<?php
namespace harsh\crafttest\console\controllers;

use yii\console\Controller;
use yii\console\ExitCode;

class CustomCommandController extends Controller
{
    public function actionIndex()
    {
        echo "Hello, this is my console command!\n";
        return ExitCode::OK;
    }
}