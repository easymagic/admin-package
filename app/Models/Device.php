<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $fillable = ['company_id','MiddlewareSerialNumber','status'];

    static function getValidation(){
        return [
            'company_id'=>'required',
            'MiddlewareSerialNumber'=>'required'
        ];
    }

    static function registerDevice(){
       $data = request()->validate(self::getValidation());
       $obj = self::getFactory();
       $obj = $obj->create($data);

       return response()->json([
           'message'=>'Device registered successfully',
           'error'=>false
       ]);
    }

    static function getDevice($id){
        return self::fetch()->where('id',$id);
    }

    static function updateDevice($id){
        $obj = self::getDevice($id)->first();
        $data = request()->validate(self::getValidation());
        $obj->update($data);

        return response()->json([
            'message'=>'Device updated successfully',
            'error'=>false
        ]);

    }

    static function removeDevice($id){
        self::getDevice($id)->delete();
        return response()->json([
            'message'=>'Device removed successfully',
            'error'=>false
        ]);
    }




}
