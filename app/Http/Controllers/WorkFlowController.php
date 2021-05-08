<?php

namespace App\Http\Controllers;

use App\Models\WorkFlow;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class WorkFlowController extends Controller
{

    use ResponseTrait;


    function loadWorkflow(){
        $this->data['workflows'] = WorkFlow::fetch()->get();
    }


    public function index()
    {
        $this->loadWorkflow();
        return view('workflow.index',$this->data);
    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        return $this->resolveResponse(WorkFlow::createWorkFlow());
    }

    public function show(WorkFlow $workFlow)
    {
        //
    }

    public function edit(WorkFlow $workFlow)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
        return $this->resolveResponse(WorkFlow::updateWorkFlow($id));
    }

    public function destroy($id)
    {
       return $this->resolveResponse(WorkFlow::deleteWorkFlow($id));
    }

}
