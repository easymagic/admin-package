<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use ModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    static function getSystemAdmin(){
      return self::fetch()->where('email','diamond@domain.com');
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


}
