<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use App\Traits\ResponseTraitV2;
use Illuminate\Http\Request;

class UserController extends Controller
{

    use ResponseTraitV2;

    private $data = [];

    function loadUsers(){
        $this->data['users'] = UserService::fetch(20);
    }

    public function index()
    {
        //
        $this->loadUsers();
        return view('admin-user.index',$this->data);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
        return $this->resolveResponse(UserService::createUser());
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        ///hanle password , profile etc
        ///
        $data = request()->validate([
            'action'=>'required'
        ]);

        $action = $data['action'];

        if ($action == 'change-password'){

            return $this->resolveResponse(UserService::changePassword($id));

        }


        if ($action == 'update-profile'){

            return $this->resolveResponse(UserService::updateProfile($id));

        }


        if ($action == 'update-user-profile'){

            return $this->resolveResponse(UserService::updateUserProfile($id));

        }



        if ($action == 'change-user-password'){

            return $this->resolveResponse(UserService::changeUserPassword($id));

        }

        if ($action == 'block'){

             return $this->resolveResponse(UserService::block($id));

        }

        if ($action == 'unblock'){

            return $this->resolveResponse(UserService::unblock($id));

        }




    }


    public function destroy($id)
    {
        //
        return $this->resolveResponse(response()->json([
            'message'=>'This feature is not available!',
            'error'=>true
        ]));
    }


    function dashboard(){

        return view('admin-user.dashboard',$this->data);
    }


}
