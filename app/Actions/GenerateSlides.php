<?php

namespace App\Actions;

use App\Http\Controllers\Admin\GenerateSlidesController;
use Statamic\Actions\Action;
use Statamic\Entries\Entry;

class GenerateSlides extends Action
{
    protected $confirm = false;
    protected static $title = "Slides";

    public function visibleToBulk($items)
    {
        return count($items) === 1;
    }

    public function redirect($items, $values)
    {
        return redirect()->action(GenerateSlidesController::class, $items[0]->id());
    }

    public function visibleTo($item)
    {
        return $item instanceof Entry && $item->collection('events');
    }
}
