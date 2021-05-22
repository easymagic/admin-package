<?php


namespace App\Services;


use App\Models\Company;

class CompanyService
{

    static function getById($id){
        return Company::query()->find($id);
    }

    static function store(){

        $data = request()->validate([
            'name'=>'required|min:3|unique:companies'
        ]);

        $obj = new Company;
        $obj = $obj->create($data);

        return response()->json([
            'message'=>'New company added successfully.',
            'error'=>false
        ]);

    }


    static function update($id){

        $data = request()->validate([
            'name'=>'required'
        ]);

        $obj = self::getById($id);
        $obj->update($data);

        return response()->json([
            'message'=>'Company updated successfully.',
            'error'=>false
        ]);

    }

    static function delete($id){

        $obj = self::getById($id);
        $obj->delete();

        return response()->json([
            'message'=>'Company removed successfully.',
            'error'=>false
        ]);

    }


    static function fetch(){
        $query = Company::query();
        return $query;
    }

}
