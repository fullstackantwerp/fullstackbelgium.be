<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;

class GenerateSlidesController
{
    public function __invoke(Event $event)
    {
        $event->load('sponsors');

        return view('admin.generate-slides', compact('event'));
    }
}
