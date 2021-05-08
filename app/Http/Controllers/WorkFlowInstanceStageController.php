<?php

namespace App\Http\Controllers;

use App\Models\WorkFlow;
use App\Models\WorkFlowInstanceStage;
use App\Models\WorkFlowStage;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class WorkFlowInstanceStageController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
    }

    public function show(WorkFlowInstanceStage $workFlowInstanceStage)
    {
        //
    }

    public function edit(WorkFlowInstanceStage $workFlowInstanceStage)
    {
        //
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }


}
