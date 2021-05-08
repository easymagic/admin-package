<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkFlowGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    static function getFactory(){
        return new self;
    }

    static function fetch(){
        return self::getFactory()->newQuery();
    }

    static function fetchById($id){
        return self::fetch()->where('id',$id);
    }


    static function getValidation(){
        return [
            'name'=>'required|unique:work_flow_groups'
        ];
    }

    static function createGroup(){
        $data = request()->validate(self::getValidation());
//        $check = self::fetch()->where('name',$data['name']);
//        if ($check->exists()){
//            return [
//                'message'=>'Group '
//            ];
//        }


        $obj = self::getFactory()->create($data);

        return [
            'message'=>'New Group Added',
            'error'=>false
        ];

    }


    static function updateGroup($id){
        $data = request()->validate(self::getValidation());
        $record = self::fetchById($id)->first();
        $record->update($data);

        return [
            'message'=>'Group updated',
            'error'=>false
        ];
    }


    static function deleteGroup($id){
        $record = self::fetchById($id)->first();
        $record->delete();

        return [
            'message'=>'Group removed',
            'error'=>false
        ];

    }


    function user_groups(){
        return $this->hasMany(WorkFlowUserGroup::class,'workflow_group_id');
    }


}
