<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\CompanyService;
use App\Traits\ResponseTraitV2;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use ResponseTraitV2;

    private $data = [];

    function loadCompany(){
      $this->data['companies'] = CompanyService::fetch()->get();
    }

    public function index()
    {
        $this->loadCompany();
        return view('company.index',$this->data);
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        return $this->resolveResponse(CompanyService::store());
    }


    public function show(Company $company)
    {
        //
    }


    public function edit(Company $company)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
        return $this->resolveResponse(CompanyService::update($id));
    }


    public function destroy($id)
    {
        //
        return $this->resolveResponse(CompanyService::delete($id));
    }

}
