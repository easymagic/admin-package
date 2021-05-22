<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Collection;

class UserService
{


    static function fetch($rpp){
        $records = User::query()->paginate($rpp);
        $newRecord = [];
        $skipEmail = 'diamond@domain.com';
        foreach ($records as $k=>$record){
           if ($record->email != $skipEmail){
               $newRecord[] =$record;
           }
        }
        return [
            'records'=>$newRecord,
            'paginate'=>$records
        ];
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
//        dd(request()->all());
        $data = request()->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'confirmed',
            'type'=>'required',
//            'company_id'=>'required'
        ]);
        //|exists:users,email

//        dd($data);

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

    static function updateUserProfile($id){
        $data = request()->validate([
            'name'=>'required',
            'type'=>'required'
        ]);

        $record = self::getById($id)->first();

        $record = $record->update($data);

        return response()->json([
            'message'=>'User profile updated',
            'error'=>false
        ]);
    }


    static function changePassword($id){

        $data = request()->validate([
            'old_password'=>'required',
            'password'=>'confirmed'
        ]);

//        dd($data);

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

        //password
        $data = request()->validate([
            'password'=>'confirmed|min:6'
        ]);


        $record = self::getById($id)->first();


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
