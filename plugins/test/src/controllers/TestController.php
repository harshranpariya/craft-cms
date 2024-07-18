<?php
namespace harsh\crafttest\controllers;

use craft\web\Controller;
use harsh\crafttest\Plugin;

class TestController extends Controller
{
    protected array|bool|int $allowAnonymous = true;
    public function actionIndex()
    {
        // Fetch entries using the service
        $entries = Plugin::getInstance()->TestService->getAllEntriesFromSection('card');
        // Pass the entries to the Twig index template
        return $this->renderTemplate('', ['entries' => $entries]);
    }
}
