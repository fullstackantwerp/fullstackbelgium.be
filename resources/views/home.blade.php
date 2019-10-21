@component('layouts.app', ['active' => 'home'])
    <section class="wrapper pb-12">
        <p class="md:w-2/3 text-2xl pb-16 md:pb-24 md:border-b">
            Organising meetups on front-end, back-end, devops and everything in between in the cities of <strong class="font-medium">Antwerp</strong> and <strong class="font-medium">Ghent</strong>.
        </p>
        <div class="flex flex-col items-end mb-12 md:mb-24" style="margin-top: -2.4rem;">
            <div class="w-full md:max-w-min-content">
                <section class="box p-6 md:flex whitespace-no-wrap">
                    <h2 class="mb-2 mr-8 font-bold">
                        Our next meetups
                    </h2>
                    <ol>
                        @foreach ($meetups as $meetup)
                            @php($nextEvent = $meetup->upcomingEvents->first())
                            @if ($nextEvent)
                                <li class="sm:flex items-center mt-4 sm:mt-0 sm:mb-1">
                                    <a href="{{ $nextEvent->meetup_com_url }}" target="_blank" rel="noopener" class="w-24 mb-2 sm:mb-0 sm:mr-2">
                                        <span class="uppercase font-medium tracking-wide text-xs text-white bg-{{ $meetup->meetup_com_id }} py-1 px-2 rounded-full">
                                            {{ str_replace('Full Stack ', '', $meetup->name) }}
                                        </span>
                                    </a>
                                    <p style="margin-top: 0.2rem">
                                        <a href="{{ $nextEvent->meetup_com_url }}" target="_blank" rel="noopener" title="View on meetup.com">
                                            @if ($nextEvent->date->startOfDay() > \Carbon\Carbon::now()->startOfDay())
                                                <time class="font-medium" datetime="{{ $nextEvent->date->format('Y-m-d') }}">{!! $nextEvent->date->format('F j<\s\up>S<\/\s\up>') !!}</time>
                                            @else
                                                <span class="font-medium">Today!</span>
                                            @endif
                                            at {{ $nextEvent->venue_name ?? 'TBA' }}
                                            <span class="inline-block w-4">
                                                {{ svg('meetup') }}
                                            </span>
                                        </a>
                                    </p>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </section>
                <p class="mr-1 mt-3 text-xs text-gray-700 text-center md:text-right">
                    Can't join any of our meetups? Hang out with us on <a class="link is-small" href="{{ url('slack') }}">Slack</a> instead!
                </p>
            </div>
        </div>
        <div class="flex items-end">
            <div class="flex-2 mr-4">
                <p class="text-xl">
                    We're always on the lookout for speakers.
                </p>
                <p class="text-gray-700">
                    First time speaker? Prepping a conference talk? All welcome,
                    <a class="link" href="{{ url('contact') }}">get in touch</a>!
                </p>
            </div>
        </div>
    </section>

    <div class="bg-white border-t md:border-b border-gray-300 pt-12 md:pt-24 pb-12 md:pb-16">
        <section class="wrapper">
            @foreach ($meetups as $meetup)
                @include('partials.meetup', ['meetup' => $meetup])
                @if (! $loop->last)
                    <hr class="h-px w-2/3 bg-gray-400 my-12 md:mt-20 md:mb-24">
                @endif
            @endforeach
        </section>
    </div>

    <section class="pb-8 md:py-24">
        <div class="wrapper text-center">
            <div class="-mx-2 mb-8 md:mb-10">
                @component('components.gallery')
                    <ul class="md:flex -mx-4 md:-mx-px">
                        <li class="flex-1 mb-4 md:mb-0 md:px-px">
                            <img class="cursor-zoom-in md:rounded-l-sm" src="{{ url('images/meetups/meetup-dummy-1.jpg') }}" alt="Full Stack Ghent 2019-02-12"
                                data-gallery-item data-src="/images/meetups/meetup-dummy-1.jpg" data-w="1024" data-h="768">
                        </li>
                        <li class="flex-1 mb-4 md:mb-0 md:px-px">
                            <img class="cursor-zoom-in" src="{{ url('images/meetups/meetup-dummy-2.jpg') }}" alt="Full Stack Ghent 2019-02-12"
                                data-gallery-item data-src="/images/meetups/meetup-dummy-2.jpg" data-w="1024" data-h="768">
                        </li>
                        <li class="flex-1 md:px-px">
                            <img class="cursor-zoom-in md:rounded-r-sm" src="{{ url('images/meetups/meetup-dummy-3.jpg') }}" alt="Full Stack Ghent 2019-02-12"
                                data-gallery-item data-src="/images/meetups/meetup-dummy-3.jpg" data-w="2048 " data-h="1536">
                        </li>
                    </ul>
                @endcomponent
            </div>
            <p class="text-2xl mb-4">
                🎉 Thanks to all <strong class="font-bold text-2xl px-2 py-1 bg-white shadow-md rounded-sm">{{ $totalAttendees }}</strong> attendees for joining last month's meetups! 🎉
            </p>
            <p class="text-gray-700">
                We're always on the lookout for speakers, sponsors and venues for our user groups.
                <br>
                <a class="link is-small" href="{{ url('contact') }}">Talk to us</a> if you want to get involved.
            </p>
        </div>
    </section>

    <section class="bg-white border-t border-b border-gray-300 py-8 md:py-16">
        <div class="wrapper">
            <h2 class="text-center font-bold mb-1">Organised by Dries &amp; Rias</h2>
            <p class="text-center text-sm text-gray-700 mb-8 md:mb-12">Come say hi at our next meetup! 👋</p>
            <ul class="flex flex-wrap justify-center">
                <li class="w-full sm:w-1/2 md:w-1/3 mb-8 md:mb-0 text-center">
                    <img class="inline-block w-24 mb-3 rounded-full border-4 border-white shadow-md" src="{{ url('images/dries.jpg') }}" alt="Headshot of Dries Vints">
                    <p>Dries Vints</p>
                    <p class="text-xs text-gray-600">
                        <a class="link is-small mr-1" href="https://twitter.com/driesvints">@driesvints</a>
                        <a class="link is-small" href="https://driesvints.com">driesvints.com</a>
                    </p>
                </li>
                <li class="w-full sm:w-1/2 md:w-1/3 px-2 text-center">
                    <img class="inline-block w-24 mb-3 rounded-full border-4 border-white shadow-md" src="{{ url('images/rias.jpg') }}" alt="Headshot of Rias Van der Veken">
                    <p>Rias Van der Veken</p>
                    <p class="text-xs text-gray-600">
                        <a class="link is-small mr-1" href="https://twitter.com/riasvdv">@riasvdv</a>
                        <a class="link is-small" href="https://rias.be">rias.be</a>
                    </p>
                </li>
            </ul>
        </div>
    </section>

    @foreach ($meetups as $meetup)
        @foreach ($meetup->upcomingEvents as $event)
            <?php
            /** @var \Illuminate\Support\Carbon $startDate */
            $startDate = $event->date;
            $startDate->setHour(19)->setMinutes(0)->setSeconds(0);
            $endDate = $startDate->copy()->setHour(22);

            $performers = [];
            if ($event->speaker_1_name) {
                $performers[] = Spatie\SchemaOrg\Schema::person()
                    ->name($event->speaker_1_name)
                    ->url("https://twitter.com/{$event->speaker_1_twitter}")
                    ->description($event->speaker_1_bio);
            }

            if ($event->speaker_2_name) {
                $performers[] = Spatie\SchemaOrg\Schema::person()
                    ->name($event->speaker_2_name)
                    ->url("https://twitter.com/{$event->speaker_2_twitter}")
                    ->description($event->speaker_2_bio);
            }

            /** @var \App\Models\Event $event */
            $socialEvent = Spatie\SchemaOrg\Schema::socialEvent()
                ->name($meetup->name)
                ->description($event->intro)
                ->performers($performers)
                ->startDate($startDate)
                ->endDate($endDate)
                ->url($event->meetup_com_url)
                ->image(Spatie\SchemaOrg\Schema::imageObject()->url(asset('/storage/'.$meetup->logo)))
                ->location(
                    Spatie\SchemaOrg\Schema::place()
                        ->name($event->venue_name)
                        ->image(Spatie\SchemaOrg\Schema::imageObject()->url(asset('/storage/'.$event->venue_logo)))
                        ->address(
                            Spatie\SchemaOrg\Schema::postalAddress()
                                ->addressCountry('Belgium')
                                ->addressLocality(str_replace('Full Stack ', '', $meetup->name))
                        )
                )
                ->doorTime($startDate)
                ->isAccessibleForFree(true)
                ->organizer([
                    Spatie\SchemaOrg\Schema::person()->name('Dries Vints')->url('https://driesvints.com'),
                    Spatie\SchemaOrg\Schema::person()->name('Rias Van der Veken')->url('https://rias.be'),
                ]);

            $sponsors = $event->sponsors->map(function (App\Models\Sponsor $sponsor) {
                return Spatie\SchemaOrg\Schema::organization()
                    ->name($sponsor->name)
                    ->image(Spatie\SchemaOrg\Schema::imageObject()->url(asset('/storage/'.$sponsor->logo)));
            });

            if (count($sponsors) > 0) {
                $socialEvent->sponsor($sponsors);
            }
            ?>
            {!! $socialEvent->toScript() !!}
        @endforeach
    @endforeach
@endcomponent
