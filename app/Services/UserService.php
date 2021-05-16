<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{


    static function fetch($rpp){
        return User::query()->paginate($rpp);
    }


    static function getSystemAdmin(){
        return User::fetch()->where('email','diamond@domain.com');
    }

    /// create user, edit user, change-password, update-profile, blockAccount , unBlockAccout , listUsers
    ///


    static function getByEmail($email){
        $query = User::query()->where('email',$email);
        return $query;
    }

    static function getById($id){
        $query = User::query()->where('id',$id);
        return $query;
    }




    static function createUser(){
        $data = request()->validate([
            'name'=>'required',
            'email'=>'exists:users',
            'password'=>'confirmed',
            'type'=>'required',
            'company_id'=>'required'
        ]);

        $obj = User::getFactory()->create($data);

        return response()->json([
            'message'=>'New user added.',
            'error'=>false
        ]);
    }


    static function updateProfile($id){
        $data = request()->validate([
            'name'=>'required'
        ]);

        $record = self::getById($id)->first();

        $record = $record->update($data);

        return response()->json([
            'message'=>'Profile updated',
            'error'=>false
        ]);
    }

    static function changePassword($id){

        $data = request()->validate([
            'old_password'=>'required',
            'password'=>'confirmed'
        ]);

        $record = self::getById($id)->first();
        $hashedPassword = $record->password;

        if (!Hash::check($data['old_password'],$hashedPassword)){
            return response()->json([
                'message'=>'Old password does not match!',
                'error'=>true
            ]);
        }

        $record->update([
            'password'=>Hash::make($data['password'])
        ]);


        return response()->json([
            'message'=>'Password changed successfully.',
            'error'=>false
        ]);

    }


    static function changeUserPassword($id){

        $data = request()->validate([
            'password'=>'confirmed'
        ]);

        $record = self::getById($id)->first();
//        $hashedPassword = $record->password;


        $record->update([
            'password'=>Hash::make($data['password'])
        ]);


        return response()->json([
            'message'=>'User password changed successfully.',
            'error'=>false
        ]);

    }


    static function block($id){

        $record = self::getById($id)->first();
        $record->status = 0;
        $record->save();

        return response()->json([
            'message'=>'Account blocked',
            'error'=>false
        ]);

    }

    static function unblock($id){
        $record = self::getById($id)->first();
        $record->status = 1;
        $record->save();

        return response()->json([
            'message'=>'Account un-blocked',
            'error'=>false
        ]);
    }


}
