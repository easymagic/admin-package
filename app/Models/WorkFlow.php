<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use phpDocumentor\Reflection\Types\Self_;

class WorkFlow extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    static function getFactory(){
        return new self;
    }

    static function fetch(){
        return self::getFactory()->newQuery();
    }

    static function getByName($name){
        return self::fetch()->where('name',$name);
    }

    static function getValidation(){
        return [
            'name'=>'required'
        ];
    }

    static function createWorkFlow(){
        $data = request()->validate(self::getValidation());
        $obj = self::getFactory()->create($data);

        return [
            'message'=>'Workflow created.',
            'error'=>false
        ];
    }

    static function updateWorkFlow($id){
        $data = request()->validate(self::getValidation());
        $check = self::fetch()->where('id',$id);
        if (!$check->exists()){
            return [
                'message'=>'Invalid record!',
                'error'=>true
            ];
        }

        $record = $check->first();
        $record->update($data);
        return  [
            'message'=>'Workflow saved',
            'error'=>false
        ];

    }


    static function deleteWorkFlow($id){

        self::fetch()->where('id',$id)->delete();
        return [
            'message'=>'Workflow removed',
            'error'=>false
        ];

    }


}
