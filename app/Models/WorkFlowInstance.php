<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkFlowInstance extends Model
{

    use HasFactory;

    protected $fillable = ['preview_url','workflow_id','module'];


    static function getFactory(){
        return new self;
    }

    static function fetch(){
        return self::getFactory()->newQuery();
    }

    static function triggerWorkFlow($data){

        $obj = self::getFactory();
        $obj = $obj->create($data);

        return [
            'message'=>'Workflow process created',
            'error'=>false,
            'data'=>$obj
        ];


    }


}
