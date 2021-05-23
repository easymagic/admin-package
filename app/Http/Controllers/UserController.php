<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\CompanyService;
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

    function loadCompanies(){
       $this->data['companies'] = CompanyService::fetch()->get();
    }

    public function index()
    {
        //
        $this->loadUsers();
        $this->loadCompanies();
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

        if ($action == 'logout'){

            return UserService::logout();

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

    function loadStats(){

        $this->data['users_count'] = UserService::fetchQuery()->count();
        $this->data['staff_count'] = UserService::fetchStaffs()->count();
        $this->data['admin_count'] = UserService::fetchAdmin()->count();
        $this->data['blocked_count'] = UserService::fetchBlocked()->count();
        $this->data['company_count'] = CompanyService::fetch()->count();

    }


    function dashboard(){

        $this->loadStats();

        return view('admin-user.dashboard',$this->data);
    }


}
