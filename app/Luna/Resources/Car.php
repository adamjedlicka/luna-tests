<?php

namespace App\Luna\Resources;

use AdamJedlicka\Luna\Resource;
use AdamJedlicka\Luna\Fields\Id;
use AdamJedlicka\Luna\Fields\Text;
use AdamJedlicka\Luna\Fields\BelongsTo;

class Car extends Resource
{
    public static $model = \App\Car::class;

    public static $search = [
        'id',
        'brand',
        'model',
        'color',
    ];

    public function title()
    {
        return $this->color . ' ' . $this->brand . ' ' . $this->model . ' kterou vlastní ' . Resources::forModel($this->owner)->title();
    }

    public function fields()
    {
        return [
            Id::make('Id'),

            Text::make('Brand')
                ->sortable()
                ->rules('required'),

            Text::make('Model')
                ->sortable()
                ->rules('required'),

            Text::make('Color')
                ->sortable(),

            Text::make('Description')
                ->hideFromIndex(),

            BelongsTo::make('Owner')
                ->rules('required'),
        ];
    }
}
