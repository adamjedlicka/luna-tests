<?php

namespace App\Luna\Resources;

use AdamJedlicka\Luna\Resource;
use AdamJedlicka\Luna\Fields\Id;
use AdamJedlicka\Luna\Fields\Text;
use AdamJedlicka\Luna\Fields\BelongsTo;

class Post extends Resource
{
    public static $model = \App\Post::class;

    public static $search = [
        'id',
        'title',
    ];

    public function title()
    {
        return $this->title;
    }

    public function fields()
    {
        return [
            Id::make('Id'),

            Text::make('Title')
                ->sortable()
                ->rules('required'),

            Text::make('Body')
                ->rules('required'),

            BelongsTo::make('User')
                ->rules('required'),
        ];
    }
}
