<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Builder;

trait ModelTrait
{

    static function fetch():Builder{
        return self::getFactory()->newQuery();
    }

    static function getFactory():self{
        return new self;
    }

}
