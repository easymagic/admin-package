<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $fillable = ['name','company_id'];

   static function getSystemBranch(){
       return self::fetch()->where('name','Diamond-branch');
   }



}

