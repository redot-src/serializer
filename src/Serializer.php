<?php

namespace Redot\Serializer;

use Closure;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;

class Serializer
{
    /**
     * Serialize data to string
     */
    public static function serialize(mixed $data): string
    {
        if ($data instanceof Closure) {
            return \Opis\Closure\serialize($data);
        }

        if ($data instanceof EloquentBuilder || $data instanceof QueryBuilder) {
            return \AnourValar\EloquentSerialize\Facades\EloquentSerializeFacade::serialize($data);
        }

        return serialize($data);
    }

    /**
     * Unserialize data from string
     */
    public static function unserialize(string $data): mixed
    {
        $data = \Opis\Closure\unserialize($data);

        if ($data instanceof \AnourValar\EloquentSerialize\Package) {
            return \AnourValar\EloquentSerialize\Facades\EloquentSerializeFacade::unserialize($data);
        }

        return $data;
    }
}
