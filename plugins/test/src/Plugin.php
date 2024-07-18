<?php

namespace harsh\crafttest;

use Craft;
use craft\base\Model;
use craft\base\Plugin as BasePlugin;
use harsh\crafttest\models\Settings;
use harsh\crafttest\services\TestService;
use harsh\crafttest\controllers\TestController;
use harsh\crafttest\controllers\CustomCommandController;
use harsh\crafttest\twigextensions\MyTwigExtension;
use yii\base\Event;
use craft\elements\Entry;
use craft\events\ModelEvent;
use craft\console\Application as ConsoleApplication;

/**
 * test plugin
 *
 * @method static Plugin getInstance()
 * @method Settings getSettings()
 * @property-read TestService $TestService
 */
class Plugin extends BasePlugin
{
    public string $schemaVersion = '1.0.0';
    public bool $hasCpSettings = true;


    public function init(): void
    {
        parent::init();

        // register service
        $this->setComponents([
            'TestService' => TestService::class,
        ]);
        // Custom TestController for using Plugins service to fetch data
        Craft::$app->controllerMap['test'] = [
            'class' => TestController::class
        ];
        
        // custom command controller for advance question
        if (Craft::$app instanceof ConsoleApplication) {
            $this->controllerNamespace = 'harsh\crafttest\console\controllers';
        }
    
        // Register custom twig extension
        Craft::$app->view->registerTwigExtension(new MyTwigExtension());
        
        // Example of registering an event
        Event::on(
            Entry::class, // The class the event is tied to
            Entry::EVENT_AFTER_SAVE, // The event type
            function (ModelEvent $event) {
                $entry = $event->sender; // The entry being saved
                if ($event->isNew) {
                    Craft::info('New entry created: ' . $entry->title, __METHOD__);
                } else {
                    Craft::info('Entry updated: ' . $entry->title, __METHOD__);
                }
            }
        );

        $this->attachEventHandlers();

    }

    protected function createSettingsModel(): ?Model
    {
        return Craft::createObject(Settings::class);
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->view->renderTemplate('_test/_settings.twig', [
            'plugin' => $this,
            'settings' => $this->getSettings(),
        ]);
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/4.x/extend/events.html to get started)
    }
}
