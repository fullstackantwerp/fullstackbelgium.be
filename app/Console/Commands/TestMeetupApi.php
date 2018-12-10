<?php

namespace App\Console\Commands;

use App\Services\Meetup\Meetup;
use Illuminate\Console\Command;

class TestMeetupApi extends Command
{
    protected $signature = 'fullstack:test-meetup-api';

    protected $description = 'A quick way to test the Meetup API';

    public function handle()
    {
        $meetup = app(Meetup::class);

        $meetup->updateEvent('fullstackantwerp', '257096861', [
            'description' => 'this is the test description',
        ]);
    }
}
