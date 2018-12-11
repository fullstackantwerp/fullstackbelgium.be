<?php

namespace App\Models;

use App\Actions\SendTweetAction;
use App\Actions\UpdateMeetupComEventAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $dates = [
        'date',
        'tweet_sent_at',
    ];

    protected $attributes = [
        'schedule' => '19:00 Doors' . PHP_EOL . '20:00 Talks'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function(Event $event) {
            if (empty($event->meetup_com_event_id)) {
                return;
            }

            app(UpdateMeetupComEventAction::class)->execute($event);
        });
    }

    public function meetup(): BelongsTo
    {
        return $this->belongsTo(Meetup::class);
    }

    public function scopeShouldBeTweeted(Builder $query)
    {
        return $query
            ->whereNull('tweet_sent_at')
            ->whereBetween('date', [now(), now()->addWeeks(2)])
            ->whereNotNull('tweet');
    }

    public function sendAnnouncementTweet()
    {
        app(SendTweetAction::class)->execute($this->tweet);

        $this->tweet_sent_at = now();
        $this->save();

        return $this;
    }

    public function generateMeetupComDescription(): string
    {
        $html =  view('admin.generate-meetup-com-description', ['event' => $this]);

        return strip_tags($html, '<br><p>');
    }

    public function getMeetupComUrlAttribute(): string
    {
        return "https://meetup.com/{$this->meetup->meetup_com_id}/events/{$this->meetup_com_event_id}";
    }
}
