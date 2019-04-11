<?php

namespace App\Services\Meetup;

use App\Models\Event;
use App\Models\Meetup;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class MeetupApi
{
    /** @var \GuzzleHttp\Client */
    protected $client;
    /** @var string */
    protected $apiKey;

    public function __construct(Client $client, string $apiKey)
    {
        $this->client = $client;

        $this->apiKey = $apiKey;
    }

    public function updateEvent(string $meetupId, string $eventId, array $updatedProperties)
    {
        Log::info("Updating meet event {$meetupId}" . print_r($updatedProperties, true));

        if (! app()->environment('production')) {
            return;
        }

        $this->client->patch("/{$meetupId}/events/{$eventId}?key={$this->apiKey}", [
            'form_params' => $updatedProperties
        ]);

        return $this;
    }

    public function getAttendees(Event $event)
    {
        $response = $this->client->get("/{$event->meetup->meetup_com_id}/events/{$event->meetup_com_event_id}?key={$this->apiKey}");
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['yes_rsvp_count'];
    }
}
