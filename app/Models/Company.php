<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $fillable = ['name','user_id'];


    static function getSystemCompany(){
        return self::fetch()->where('name','Diamond');
    }
}
