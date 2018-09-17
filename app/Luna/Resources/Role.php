<?php

namespace App\Luna\Resources;

use AdamJedlicka\Luna\Resource;
use AdamJedlicka\Luna\Fields\Id;
use AdamJedlicka\Luna\Fields\Text;

class Role extends Resource
{
    /**
     * Fully qualified name of the coresponding model class
     *
     * @var string
     */
    public static $model = \App\Role::class;

    public function title()
    {
        return $this->name;
    }

    /**
     * Definition of resource fields
     *
     * @return array
     */
    public function fields()
    {
        return [

            Id::make('Id')
                ->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required'),

            Text::make('Description')
                ->rules('required'),

        ];
    }
}
