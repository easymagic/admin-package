<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name','user_id'];

    function users(){
        return $this->hasMany(User::class,'company_id');
    }

    function admin_user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
