<?php


namespace App\Traits;


use App\Models\User;
use http\Env\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait AuthTrait
{

    static function getValidationRules(){
        return [
            'email'=>'required|email',
            'password'=>'required|min:5'
        ];
    }

    static function login(){

        $data = request()->validate(self::getValidationRules());

        $check = Auth::attempt($data);



        if ($check && Auth::user()->status == 0){
//            dd('101');
            Auth::logout();
            return response()->json([
                'message'=>'Account has been blocked, please contact your administrator!',
                'error'=>true
            ]);
        }

//                dd(Auth::user()->status,$check);

        if ($check){
            return response()->json([
                'message'=>'Welcome ' . auth()->user()->name,
                'route'=>route('dashboard')
            ]);
        }

        return response()->json([
            'message'=>'Invalid login!',
            'error'=>true
        ]);

    }

    static function logout(){
       Auth::logout();
       return response()->json([
           'message'=>'Just logged out.',
           'error'=>false,
           'route'=>route('admin.login')
       ]);
    }

    static function updateProfile($id){
       $record = User::fetch()->where('id',$id)->first();
       $record->phone = request('phone');
       $record->name = request('name');
       $record->save();

       return response()->json([
           'message'=>'Profile updated.',
           'error'=>false
       ]);

    }

    static function changePassword($id){

        $record = User::fetch()->where('id',$id)->first();

        $old_password = request('old_password');
        $new_password = request('new_password');
        $confirm_password = request('confirm_password');

        if (!Hash::check($old_password,$record->password)){
            return response()->json([
                'message'=>'Old password do not match!',
                'error'=>true
            ]);
        }

        if ($new_password == $confirm_password && !empty($new_password)){

            $record->password = $confirm_password;
            $record->save();

            return response()->json([
                'message'=>'Password changed successfully.',
                'error'=>false
            ]);
        }

        return response()->json([
            'message'=>'Invalid password!',
            'error'=>true
        ]);

    }

   static function blockUser($id){
        $record = User::fetch()->where('id',$id)->first();
        $record->status = 0;
        $record->save();
        return response()->json([
            'message'=>'Selected user blocked!',
            'error'=>false
        ]);
    }

    static function unblockUser($id){
        $record = User::fetch()->where('id',$id)->first();
        $record->status = 1;
        $record->save();
        return response()->json([
            'message'=>'Selected user un-blocked!',
            'error'=>false
        ]);
    }


}