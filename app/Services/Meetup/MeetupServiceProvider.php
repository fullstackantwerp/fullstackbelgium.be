<?php

namespace App\Services\Meetup;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class MeetupServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(MeetupApi::class, function () {
            $client = new Client();
            $response = $client->post('https://secure.meetup.com/oauth2/access', [
                'form_params' => [
                    'client_id' => config('services.meetup.key'),
                    'client_secret' => config('services.meetup.secret'),
                    'grant_type' => 'refresh_token',
                    'refresh_token' => config('services.meetup.refresh_token'),
                ],
            ]);

            $jsonResponse = json_decode((string) $response->getBody()->getContents(), true);
            $token = $jsonResponse['access_token'];

            $client = new Client([
                'base_uri' => 'https://api.meetup.com/',
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => "Bearer {$token}",
                ],
            ]);

            return new MeetupApi($client);
        });
    }
}
