<?php

namespace App\Nova;

use Timothyasp\Color\Color;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;

class Meetup extends Resource
{
    public static $model = \App\Models\Meetup::class;

    public static $title = 'name';

    public static $search = [
        'name',
    ];

    public function fields(Request $request)
    {
        return [
            Image::make('Logo')->disk('public')->storeAs(function (Request $request) {
                return sha1($request->logo->getClientOriginalName()) . '.' . $request->logo->getClientOriginalExtension();
            }),
            Color::make('Color')->hideFromIndex(),
            Text::make('Name')->sortable()->rules('required'),
            Text::make('Meetup.com id', 'meetup_com_id')->sortable()->rules('required'),
        ];
    }
}
