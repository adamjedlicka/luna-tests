<?php

namespace App\Luna\Resources;

use AdamJedlicka\Luna\Resource;
use AdamJedlicka\Luna\Fields\Id;
use AdamJedlicka\Luna\Fields\Text;
use AdamJedlicka\Luna\Fields\HasMany;
use AdamJedlicka\Luna\Fields\BelongsToMany;

class User extends Resource
{
    public static $model = \App\User::class;

    public static $search = [
        'id',
        'name',
        'email',
    ];

    public function title()
    {
        return $this->name;
    }

    public function fields()
    {
        return [
            Id::make('Id'),

            Text::make('Name')
                ->sortable()
                ->rules('required'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email'),

            Text::make('Password')
                ->hideFromIndex()
                ->hideFromDetail()
                ->creationRules('required'),

            HasMany::make('Posts'),

            HasMany::make('Cars', 'garage'),

            BelongsToMany::make('Roles')
                ->fields([
                    Text::make('Note'),
                ]),
        ];
    }
}
