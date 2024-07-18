<?php

namespace harsh\crafttest\services;

use Craft;
use yii\base\Component;
use craft\elements\Entry;
// This service takes section handle as input and select all 
// section values
class TestService extends Component
{
    public function getAllEntriesFromSection($sectionHandle)
    {
        // Fetch entries from the specified section
        $entries = Entry::find()
            ->section($sectionHandle)
            ->all();

        return $entries;
    }
}
